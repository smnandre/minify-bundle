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

namespace Sensiolabs\MinifyBundle\Tests\Minifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Sensiolabs\MinifyBundle\Minifier\MinifierInterface;
use Sensiolabs\MinifyBundle\Minifier\TraceableMinifier;

#[CoversClass(TraceableMinifier::class)]
class TraceableMinifierTest extends TestCase
{
    public function testMinifyLogsDebugMessages(): void
    {
        $minifier = $this->createMock(MinifierInterface::class);
        $minifier->method('minify')->willReturn('minified content');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->exactly(2))->method('debug');

        $traceableMinifier = new TraceableMinifier($minifier, $logger);
        $traceableMinifier->minify('input content', 'css');
    }

    public function testMinifyLogsInfoMessage(): void
    {
        $minifier = $this->createMock(MinifierInterface::class);
        $minifier->method('minify')->willReturn('minified content');

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())->method('info');

        $traceableMinifier = new TraceableMinifier($minifier, $logger);
        $traceableMinifier->minify('input content', 'css');
    }

    public function testMinifyReturnsMinifiedContent(): void
    {
        $minifier = $this->createMock(MinifierInterface::class);
        $minifier->method('minify')->willReturn('minified content');

        $traceableMinifier = new TraceableMinifier($minifier);
        $this->assertSame('minified content', $traceableMinifier->minify('input content', 'css'));
    }

    public function testMinifyHandlesEmptyInput(): void
    {
        $minifier = $this->createMock(MinifierInterface::class);
        $minifier->method('minify')->willReturn('');

        $traceableMinifier = new TraceableMinifier($minifier);
        $this->assertSame('', $traceableMinifier->minify('', 'css'));
    }

    public function testMinifyHandlesExceptionFromMinifier(): void
    {
        $this->expectException(\RuntimeException::class);

        $minifier = $this->createMock(MinifierInterface::class);
        $minifier->method('minify')->willThrowException(new \RuntimeException('Minify error'));

        $traceableMinifier = new TraceableMinifier($minifier);
        $traceableMinifier->minify('input content', 'css');
    }
}
