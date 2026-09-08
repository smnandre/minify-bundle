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

namespace Sensiolabs\MinifyBundle\Tests\Minifier\Options;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Sensiolabs\MinifyBundle\Minifier\MinifierInterface;
use Sensiolabs\MinifyBundle\Minifier\Options\HtmlOptions;

#[CoversClass(HtmlOptions::class)]
class HtmlOptionsTest extends TestCase
{
    public function testGetTypeReturnsHtml(): void
    {
        $this->assertSame(MinifierInterface::TYPE_HTML, (new HtmlOptions())->getType());
    }

    public function testToCliArgsIsEmptyByDefault(): void
    {
        $this->assertSame([], (new HtmlOptions())->toCliArgs());
    }

    public function testToCliArgsIncludesKeepDocumentTagsFlag(): void
    {
        $this->assertSame(
            ['--html-keep-document-tags'],
            (new HtmlOptions(keepDocumentTags: true))->toCliArgs(),
        );
    }
}
