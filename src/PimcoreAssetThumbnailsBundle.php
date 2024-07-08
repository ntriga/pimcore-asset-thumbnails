<?php

namespace Ntriga\PimcoreAssetThumbnails;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PimcoreAssetThumbnailsBundle extends Bundle
{
     public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../config'));
        $loader->load('services.yaml');
        $loader->load('config.yaml');
    }
}