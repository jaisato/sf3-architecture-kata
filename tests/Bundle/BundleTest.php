<?php
declare(strict_types=1);

namespace Tests\Bundle;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Reused bundles should follow the official SF best practices.
 *
 * @link http://symfony.com/doc/current/bundles/best_practices.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Bundle
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class BundleTest extends KernelTestCase
{
    public function classProvider(): array
    {
        return [
            ['Acme\BlogBundle\AcmeBlogBundle', Bundle::class, 'Missing BlogBundle: This is the class that transforms a plain directory into a Symfony bundle'],
            ['Acme\BlogBundle\DependencyInjection\AcmeBlogExtension', Extension::class, 'Missing Service Container Extension class'],
            ['Acme\BlogBundle\Command\TopicCommand', Command::class, 'Missing TopicCommand class'],
            ['Acme\BlogBundle\Controller\TopicController', Controller::class, 'Missing Topic Controller class'],
        ];
    }

    /**
     * Create a reusable bundle.
     *
     * @dataProvider classProvider
     *
     * @param string $class
     * @param string $parentClass
     * @param string $message
     */
    public function testInstances(string $class, string $parentClass, string $message)
    {
        static::assertTrue(class_exists($class), $message);
        static::assertTrue(is_subclass_of($class, $parentClass), "{$class} must inherit from {$parentClass}");
    }

    /**
     * Add resources directories.
     */
    public function testResourcesDirectoriesAreCreated()
    {
        static::assertTrue(is_dir(__DIR__ . '/../../src/Acme/BlogBundle/Resources'), 'You must to create the Resources directory');
        static::assertTrue(is_dir(__DIR__ . '/../../src/Acme/BlogBundle/Resources/config'), 'You must to create the config directory');
        static::assertTrue(is_dir(__DIR__ . '/../../src/Acme/BlogBundle/Resources/public'), 'You must to create the public directory');
        static::assertTrue(is_dir(__DIR__ . '/../../src/Acme/BlogBundle/Resources/translations'), 'You must to create the translations directory');
    }

    /**
     * Add bundle to kernel.
     */
    public function testBundleIsAdded()
    {
        static::bootKernel();

        $bundles = static::$kernel->getBundles();

        static::assertTrue(array_key_exists('AcmeBlogBundle', $bundles));
        static::assertInstanceOf('Acme\BlogBundle\AcmeBlogBundle', $bundles['AcmeBlogBundle']);
    }
}
