<?php

declare(strict_types=1);

namespace App\Component\Php;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * @see https://symfony.com/doc/7.4/components/property_access.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class PropertyAccessDecorator
{
    private PropertyAccessorInterface $accessor;

    public function __construct()
    {
        // TODO
    }

    /**
     * Read element from array.
     *
     * @param array<mixed> $array
     */
    public function readFromArray(array $array, string $element): mixed
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Read attribute from object.
     */
    public function readFromObject(object $object, string $attribute): mixed
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Set element of array.
     *
     * @param array<mixed> $array
     */
    public function writeToArray(array &$array, string $element, mixed $value): void
    {
        // TODO
    }

    /**
     * Set attribute of object.
     */
    public function writeToObject(object $object, string $attribute, mixed $value): void
    {
        // TODO
    }

    /**
     * Check if attribute/element is writable.
     *
     * @param object|array<mixed> $item
     */
    public function isWritable(object|array $item, string $attribute): bool
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Check if attribute/element is readable.
     *
     * @param object|array<mixed> $item
     */
    public function isReadable(object|array $item, string $attribute): bool
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }
}
