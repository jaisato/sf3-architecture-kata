<?php

declare(strict_types=1);

namespace Acme\BlogBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * Exercise 5: an extension whose name does not follow the convention, which
 * is why AcmeBlogBundle::createContainerExtension() has to name it.
 */
final class CustomExtension extends Extension
{
    /**
     * @param array<array<mixed>> $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        (new PhpFileLoader($container, new FileLocator(\dirname(__DIR__, 2) . '/config')))->load('services.php');
    }

    /**
     * The alias is the key of the bundle's configuration (acme_blog: in
     * config/packages/). Derived from the class name it would be "custom",
     * and Bundle::getContainerExtension() expects "acme_blog".
     */
    public function getAlias(): string
    {
        return 'acme_blog';
    }
}
