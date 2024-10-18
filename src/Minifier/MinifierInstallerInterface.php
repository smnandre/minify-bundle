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

namespace Sensiolabs\MinifyBundle\Minifier;

/**
 * @author Simon André <smn.andre@gmail.com>
 */
interface MinifierInstallerInterface
{
    public const VERSION_LATEST = 'latest';

    /**
     * Install the binary.
     *
     * @param string $version The version to install (default to latest)
     * @param bool   $force   Whether to force the installation
     */
    public function install(string $version = self::VERSION_LATEST, bool $force = false): void;

    /**
     * @return bool Whether the binary is installed
     */
    public function isInstalled(): bool;

    /**
     * @return string The path to the installed binary
     */
    public function getInstallBinaryPath(): string;
}
