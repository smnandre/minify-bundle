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

use Sensiolabs\MinifyBundle\Exception\RuntimeException;
use Sensiolabs\MinifyBundle\Minifier\MinifierInterface;
use Symfony\Component\Process\Process;

/**
 * @author Simon André <smn.andre@gmail.com>
 */
final class Minify implements MinifierInterface
{
    public function __construct(
        private readonly string $binaryPath,
    ) {
    }

    public function minify(string $input, string $type): string
    {
        $process = new Process([$this->binaryPath, '--type',  $type]);
        $process->setInput($input);

        try {
            $process->run();
        } catch (\Throwable $e) {
            throw new RuntimeException('Error during minify command: '.$e->getMessage(), 0, $e);
        }

        if (!$process->isSuccessful()) {
            throw new RuntimeException(sprintf('Minify error %s: "%s".', $process->getExitCode(), $process->getExitCodeText()));
        }

        return $process->getOutput();
    }
}
