<?php

declare(strict_types=1);

namespace App\Tests\Smoke;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * What CI checks on master, where the five exercises fail on purpose until
 * they are solved: the application itself boots and routes.
 */
final class KernelTest extends KernelTestCase
{
    public function testTheKernelBoots(): void
    {
        $kernel = self::bootKernel();

        static::assertSame('test', $kernel->getEnvironment());
        static::assertArrayHasKey('FrameworkBundle', $kernel->getBundles());
    }

    public function testTheRoutesLoad(): void
    {
        self::bootKernel();

        $router = static::getContainer()->get('router');

        // Matching loads every routing file and #[Route] attribute, so a broken
        // one fails here. "/" is not one of the kata's routes.
        $this->expectException(ResourceNotFoundException::class);
        $router->match('/');
    }
}
