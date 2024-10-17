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

namespace Sensiolabs\MinifyBundle\Tests\EventListener;

use PHPUnit\Framework\Attributes\CoversClass;
use Sensiolabs\MinifyBundle\EventListener\PreAssetsCompileEventListener;
use PHPUnit\Framework\TestCase;
use Sensiolabs\MinifyBundle\Minifier\MinifierInstallerInterface;
use Symfony\Component\AssetMapper\Event\PreAssetsCompileEvent;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\Output;

#[CoversClass(PreAssetsCompileEventListener::class)]
class PreAssetsCompileEventListenerTest extends TestCase
{
    public function testItInstallMinifier(): void
    {
        $installer = $this->createMock(MinifierInstallerInterface::class);
        $installer->expects($this->once())
            ->method('isInstalled')
            ->willReturn(false);
        $installer->expects($this->once())
            ->method('install')
            ->with('latest', false);

        $listener = new PreAssetsCompileEventListener($installer);

        $output = $this->createMock(NullOutput::class);
        $output->expects($this->once())
            ->method('writeln')
            ->with('Minify binary installed.', Output::VERBOSITY_NORMAL);

        $event = new PreAssetsCompileEvent($output);

        $listener($event);

        $this->assertFalse($event->isPropagationStopped());
    }

    public function testItInstallWhenMinifierIsAlreadyInstalled(): void
    {
        $installer = $this->createMock(MinifierInstallerInterface::class);
        $installer->expects($this->once())
            ->method('isInstalled')
            ->willReturn(true);
        $installer->expects($this->never())
            ->method('install');

        $listener = new PreAssetsCompileEventListener($installer);

        $output = $this->createMock(NullOutput::class);
        $output->expects($this->once())
            ->method('writeln')
            ->with('Minify binary already installed.', Output::VERBOSITY_DEBUG);

        $event = new PreAssetsCompileEvent($output);

        $listener($event);

        $this->assertFalse($event->isPropagationStopped());
    }
}
