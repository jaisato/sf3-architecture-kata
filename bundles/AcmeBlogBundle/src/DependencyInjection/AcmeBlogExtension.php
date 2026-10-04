<?php

declare(strict_types=1);

namespace Acme\BlogBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * Exercise 3: the extension Symfony finds by naming convention (bundle name
 * without "Bundle", plus "Extension", in the DependencyInjection namespace).
 * Since exercise 5 the bundle uses CustomExtension instead.
 */
final class AcmeBlogExtension extends Extension
{
    /**
     * @param array<array<mixed>> $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        (new PhpFileLoader($container, new FileLocator(\dirname(__DIR__, 2) . '/config')))->load('services.php');
    }
}
