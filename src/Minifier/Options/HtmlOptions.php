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

namespace Sensiolabs\MinifyBundle\Minifier\Options;

use Sensiolabs\MinifyBundle\Minifier\MinifierInterface;

/**
 * @author Hugo Alliaume <hugo@alliau.me>
 */
final class HtmlOptions implements OptionsInterface
{
    /**
     * @param bool $keepDocumentTags preserve html, head and body tags
     */
    public function __construct(
        public readonly bool $keepDocumentTags = false,
    ) {
    }

    public function getType(): string
    {
        return MinifierInterface::TYPE_HTML;
    }

    public function toCliArgs(): array
    {
        $args = [];
        if ($this->keepDocumentTags) {
            $args[] = '--html-keep-document-tags';
        }

        return $args;
    }
}
