<?php

declare(strict_types=1);

namespace App\Tests\Bundle;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Reusable bundles should follow the official Symfony best practices.
 *
 * @see https://symfony.com/doc/7.4/bundles/best_practices.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class BundleTest extends KernelTestCase
{
    /**
     * @return iterable<string, array{string, class-string, string}>
     */
    public static function classProvider(): iterable
    {
        // AbstractBundle extends Bundle, so either base class passes.
        yield 'bundle' => ['Acme\BlogBundle\AcmeBlogBundle', Bundle::class, 'Missing AcmeBlogBundle: the class that turns a directory into a Symfony bundle'];
        yield 'extension' => ['Acme\BlogBundle\DependencyInjection\AcmeBlogExtension', Extension::class, 'Missing the service container extension class'];
        yield 'command' => ['Acme\BlogBundle\Command\TopicCommand', Command::class, 'Missing the TopicCommand class'];
        yield 'controller' => ['Acme\BlogBundle\Controller\TopicController', AbstractController::class, 'Missing the TopicController class'];
    }

    /**
     * Create a reusable bundle.
     */
    #[DataProvider('classProvider')]
    public function testInstances(string $class, string $parentClass, string $message): void
    {
        static::assertTrue(class_exists($class), $message);
        static::assertTrue(
            is_subclass_of($class, $parentClass) || (Command::class === $parentClass && self::isInvokableCommand($class)),
            "{$class} must extend {$parentClass}",
        );
    }

    /**
     * Resource directories, in the modern bundle structure: the PHP classes in
     * src/ and the resources at the root of the bundle, which is what
     * getPath() must return.
     */
    public function testResourcesDirectoriesAreCreated(): void
    {
        $bundle = self::bootKernel()->getBundles()['AcmeBlogBundle'] ?? null;

        static::assertNotNull($bundle, 'Register AcmeBlogBundle in config/bundles.php first');

        $path = $bundle->getPath();

        static::assertDirectoryExists($path . '/src', 'The PHP classes of the bundle go in its src/ directory');
        static::assertDirectoryExists($path . '/config', 'You must create the config directory');
        static::assertDirectoryExists($path . '/public', 'You must create the public directory');
        static::assertDirectoryExists($path . '/translations', 'You must create the translations directory');
    }

    /**
     * Add bundle to kernel.
     */
    public function testBundleIsAdded(): void
    {
        $bundles = self::bootKernel()->getBundles();

        static::assertArrayHasKey('AcmeBlogBundle', $bundles, 'Register AcmeBlogBundle in config/bundles.php');
        static::assertSame('Acme\BlogBundle\AcmeBlogBundle', $bundles['AcmeBlogBundle']::class);
    }

    /**
     * Since Symfony 7.3 a command may also be an invokable class instead of a
     * subclass of Command: the #[AsCommand] attribute and an __invoke() method.
     *
     * @param class-string $class
     */
    private static function isInvokableCommand(string $class): bool
    {
        return [] !== (new \ReflectionClass($class))->getAttributes(AsCommand::class)
            && method_exists($class, '__invoke');
    }
}
