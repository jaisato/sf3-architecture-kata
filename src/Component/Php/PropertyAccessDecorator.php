<?php

declare(strict_types=1);

namespace App\Component\Php;

use Symfony\Component\PropertyAccess\PropertyAccess;
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
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    /**
     * Read element from array.
     *
     * @param array<mixed> $array
     */
    public function readFromArray(array $array, string $element): mixed
    {
        // An array index goes between brackets; "name" alone would be a property.
        return $this->accessor->getValue($array, "[{$element}]");
    }

    /**
     * Read attribute from object.
     */
    public function readFromObject(object $object, string $attribute): mixed
    {
        return $this->accessor->getValue($object, $attribute);
    }

    /**
     * Set element of array.
     *
     * @param array<mixed> $array
     */
    public function writeToArray(array &$array, string $element, mixed $value): void
    {
        $this->accessor->setValue($array, "[{$element}]", $value);
    }

    /**
     * Set attribute of object.
     */
    public function writeToObject(object $object, string $attribute, mixed $value): void
    {
        $this->accessor->setValue($object, $attribute, $value);
    }

    /**
     * Check if attribute/element is writable.
     *
     * @param object|array<mixed> $item
     */
    public function isWritable(object|array $item, string $attribute): bool
    {
        return $this->accessor->isWritable($item, \is_array($item) ? "[{$attribute}]" : $attribute);
    }

    /**
     * Check if attribute/element is readable.
     *
     * @param object|array<mixed> $item
     */
    public function isReadable(object|array $item, string $attribute): bool
    {
        return $this->accessor->isReadable($item, \is_array($item) ? "[{$attribute}]" : $attribute);
    }
}
