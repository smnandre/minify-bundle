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

namespace Sensiolabs\MinifyBundle\EventListener;

use Sensiolabs\MinifyBundle\Minifier\MinifierInstallerInterface;
use Symfony\Component\AssetMapper\Event\PreAssetsCompileEvent;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Checks the minify binary is installed before compiling assets.
 *
 * @author Simon André <smn.andre@gmail.com>
 *
 * @internal
 */
final class PreAssetsCompileEventListener
{
    public function __construct(
        private readonly MinifierInstallerInterface $minifyInstaller,
    ) {
    }

    public function __invoke(PreAssetsCompileEvent $event): void
    {
        if ($this->minifyInstaller->isInstalled()) {
            $event->getOutput()->writeln('Minify binary already installed.', OutputInterface::VERBOSITY_DEBUG);

            return;
        }

        $this->minifyInstaller->install();
        $event->getOutput()->writeln('Minify binary installed.', OutputInterface::VERBOSITY_NORMAL);
    }
}
