<?php

declare(strict_types=1);

namespace Acme\BlogBundle;

use Acme\BlogBundle\DependencyInjection\CustomExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Exercise 3: a reusable bundle with the modern directory structure, the PHP
 * classes in src/ and config/, public/ and translations/ at its root.
 */
final class AcmeBlogBundle extends Bundle
{
    /**
     * Bundle assumes the classes sit at the root of the bundle (the Symfony 4
     * structure); AbstractBundle would already return the parent of src/.
     */
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    /**
     * Exercise 5: by convention Symfony would load DependencyInjection\AcmeBlogExtension;
     * the bundle names the extension it wants instead.
     */
    protected function createContainerExtension(): ExtensionInterface
    {
        return new CustomExtension();
    }
}
