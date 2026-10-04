<?php

declare(strict_types=1);

namespace App\Component\Php;

use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\TypeInfo\Type;

/**
 * Since Symfony 7.1 the type of a property is described by the TypeInfo
 * component: PropertyInfoExtractor::getType() returns a single
 * Symfony\Component\TypeInfo\Type, and the old getTypes(), which returned a
 * list of PropertyInfo\Type, is deprecated.
 *
 * @see https://symfony.com/doc/7.4/components/property_info.html
 * @see https://symfony.com/doc/7.4/components/type_info.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class PropertyInfoExtractorDecorator
{
    private PropertyInfoExtractor $propertyInfoExtractor;

    public function __construct()
    {
        // TODO
    }

    /**
     * First line of the property phpdoc.
     *
     * @param class-string $class
     */
    public function getShortDescriptionOfAProperty(string $class, string $property): ?string
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * All property phpdoc.
     *
     * @param class-string $class
     */
    public function getLongDescriptionOfAProperty(string $class, string $property): ?string
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Returns all public properties from a class.
     *
     * @param class-string $class
     *
     * @return list<string>
     */
    public function getPublicPropertiesFromClass(string $class): array
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Provide extensive data type information for a property.
     *
     * @param class-string $class
     */
    public function getPropertyInfoFromClass(string $class, string $property): ?Type
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Checks if property is readable.
     *
     * @param class-string $class
     */
    public function isPropertyReadable(string $class, string $property): bool
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Checks if property is writable.
     *
     * @param class-string $class
     */
    public function isPropertyWritable(string $class, string $property): bool
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }
}
