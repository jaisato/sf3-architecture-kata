<?php

declare(strict_types=1);

namespace App\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class ServiceTest extends KernelTestCase
{
    public function testGenericServiceIsLoaded(): void
    {
        self::bootKernel();

        // Services are private by default. static::getContainer() is the test
        // container, which also reaches the private services that survive the
        // compilation: a private service nobody uses is removed from it.
        static::assertTrue(
            static::getContainer()->has('acme.blog.topic_manager'),
            'acme.blog.topic_manager must be loaded in the container',
        );
    }

    public function testCustomExtensionIsCreated(): void
    {
        $bundles = self::bootKernel()->getBundles();

        static::assertArrayHasKey('AcmeBlogBundle', $bundles, 'Bundle must be loaded');

        $extension = $bundles['AcmeBlogBundle']->getContainerExtension();

        static::assertNotNull($extension, 'Extension must be created');
        static::assertSame('Acme\BlogBundle\DependencyInjection\CustomExtension', $extension::class, 'Custom extension must be loaded');
    }
}
