<?php
declare(strict_types=1);

namespace Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\DependencyInjection
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class ServiceTest extends KernelTestCase
{
    public function testGenericServiceIsLoaded()
    {
        static::bootKernel();

        $container = static::$kernel->getContainer();

        static::assertTrue($container->has('acme.blog.topic_manager'), 'acme.blog.topic_manager must be loaded in container');
    }

    public function testCustomExtensionIsCreated()
    {
        static::bootKernel();

        $bundles = static::$kernel->getBundles();

        static::assertTrue(array_key_exists('AcmeBlogBundle', $bundles), 'Bundle must be loaded');

        $extension = $bundles['AcmeBlogBundle']->getContainerExtension();

        static::assertNotNull($extension, 'Extension must be created');
        static::assertEquals('Acme\BlogBundle\DependencyInjection\CustomExtension', get_class($extension), 'Custom extension must be loaded');
    }
}
