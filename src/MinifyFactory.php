<?php

declare(strict_types=1);

/*
 * This file is part of the SensioLabs MinifyBundle package.
 *
 * (c) Simon André - Sensiolabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sensiolabs\MinifyBundle;

use Sensiolabs\MinifyBundle\Exception\BinaryNotFoundException;
use Sensiolabs\MinifyBundle\Exception\LogicException;
use Sensiolabs\MinifyBundle\Minifier\MinifierFactoryInterface;
use Sensiolabs\MinifyBundle\Minifier\MinifierInstallerInterface;
use Symfony\Component\Process\ExecutableFinder;

/**
 * @implements MinifierFactoryInterface<Minify>
 *
 * @author Simon André <smn.andre@gmail.com>
 */
final class MinifyFactory implements MinifierFactoryInterface
{
    private const BINARY_PATH_AUTO = 'auto';

    public function __construct(
        private readonly string|bool $binaryPath = self::BINARY_PATH_AUTO,
        private readonly ?MinifierInstallerInterface $installer = null,
    ) {
    }

    public function create(): Minify
    {
        if ($binaryPath = $this->getBinaryPath()) {
            return new Minify($binaryPath);
        }

        throw new BinaryNotFoundException('The minify binary cannot not be found.');
    }

    private function getBinaryPath(): ?string
    {
        if (false !== $this->binaryPath) {
            if ('auto' === $this->binaryPath || true === $this->binaryPath) {
                if ($path = (new ExecutableFinder())->find('minify')) {
                    return $path;
                }
            } elseif (file_exists($this->binaryPath)) {
                return $this->binaryPath;
            }
        }

        if (null === $this->installer) {
            throw new LogicException('The minify binary path is not set and no installer is provided.');
        }

        if (!$this->installer->isInstalled()) {
            $this->installer->install();
        }

        $path = $this->installer->getInstallBinaryPath();

        return file_exists($path) ? $path : null;
    }
}
