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

namespace Sensiolabs\MinifyBundle\AssetMapper;

use Sensiolabs\MinifyBundle\Exception\RuntimeException;
use Sensiolabs\MinifyBundle\Minifier\MinifierInterface;
use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\AssetMapper\Compiler\AssetCompilerInterface;
use Symfony\Component\AssetMapper\MappedAsset;

/**
 * @author Simon André <smn.andre@gmail.com>
 */
final class MinifierCompiler implements AssetCompilerInterface
{
    /**
     * @param MinifierInterface $minify
     * @param list<string> $extensions
     * @param list<string> $ignorePaths
     */
    public function __construct(
        private readonly MinifierInterface $minify,
        private readonly array $extensions = ['css', 'js'],
        private readonly array $ignorePaths = [],
        private readonly bool $ignoreVendor = true,
    ) {
    }

    public function supports(MappedAsset $asset): bool
    {
        if (!in_array($asset->publicExtension, $this->extensions, true)) {
            return false;
        }

        if ($this->ignoreVendor && $asset->isVendor) {
            return false;
        }

        foreach ($this->ignorePaths as $ignorePath) {
            if (fnmatch($ignorePath, $asset->sourcePath)) {
                return false;
            }
        }

        return true;
    }

    public function compile(string $content, MappedAsset $asset, AssetMapperInterface $assetMapper): string
    {
        $type = match($extension = $asset->publicExtension) {
            'css', 'scss' => 'css',
            'js' => 'js',
            default => throw new RuntimeException(sprintf('Invalid type "%s".', $extension))
        };

        return $this->minify->minify($content, $type);
    }
}
