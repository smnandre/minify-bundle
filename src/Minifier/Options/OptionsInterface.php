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
interface OptionsInterface
{
    /**
     * @return MinifierInterface::TYPE_*
     */
    public function getType(): string;

    /**
     * @return list<string>
     */
    public function toCliArgs(): array;
}
