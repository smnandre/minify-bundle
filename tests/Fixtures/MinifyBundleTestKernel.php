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

namespace Sensiolabs\MinifyBundle\Tests\Fixtures;

use Sensiolabs\MinifyBundle\SensiolabsMinifyBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;

class MinifyBundleTestKernel extends Kernel
{
    use MicroKernelTrait;

    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new SensiolabsMinifyBundle(),
            new class () extends Bundle {
                public function shutdown(): void
                {
                    restore_exception_handler();
                }
            }
        ];
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->loadFromExtension('framework', [
            'secret' => 'foo',
            'test' => true,
            'http_method_override' => true,
            'handle_all_throwables' => true,
            'php_errors' => [
                'log' => true,
            ],
            'asset_mapper' => [
                'paths' => [
                    __DIR__.'/assets',
                ],
            ],
        ]);
    }

    public function getCacheDir(): string
    {
        return $this->getProjectDir().'/var/cache/'.$this->environment;
    }

    public function getBuildDir(): string
    {
        return $this->getProjectDir().'/var/build/'.$this->environment;
    }

    public function getProjectDir(): string
    {
        return __DIR__;
    }
}
