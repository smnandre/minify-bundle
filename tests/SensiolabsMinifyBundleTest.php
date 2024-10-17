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

namespace Sensiolabs\MinifyBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use Sensiolabs\MinifyBundle\Minifier\MinifierInterface;
use Sensiolabs\MinifyBundle\Minify;
use Sensiolabs\MinifyBundle\SensiolabsMinifyBundle;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

#[CoversClass(SensiolabsMinifyBundle::class)]
class SensiolabsMinifyBundleTest extends KernelTestCase
{
    public function testMinifierInterface(): void
    {
        $this->assertFalse(self::getContainer()->has(Minify::class));
        $this->assertTrue(self::getContainer()->has(MinifierInterface::class));
    }
}
