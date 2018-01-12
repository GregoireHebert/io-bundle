<?php

namespace Gheb\IOBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class IOExtension
 * @author  Grégoire Hébert <gregoire@opo.fr>
 * @package Gheb\IOBundle\DependencyInjection
 */
class IOExtension extends Extension
{
    /**
     * load services
     *
     * @param array            $config
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $config, ContainerBuilder $container): void
    {
        $locator = new FileLocator(__DIR__.'/../Resources/Config');
        $loader = new YamlFileLoader($container, $locator);
        $loader->load('IO.yml');
    }
}
