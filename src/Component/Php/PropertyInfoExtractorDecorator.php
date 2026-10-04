<?php

declare(strict_types=1);

namespace App\Component\Php;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
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
        $reflectionExtractor = new ReflectionExtractor();
        $phpDocExtractor = new PhpDocExtractor();

        $this->propertyInfoExtractor = new PropertyInfoExtractor(
            listExtractors: [$reflectionExtractor],
            typeExtractors: [$phpDocExtractor, $reflectionExtractor],
            descriptionExtractors: [$phpDocExtractor],
            accessExtractors: [$reflectionExtractor],
            initializableExtractors: [$reflectionExtractor],
        );
    }

    /**
     * First line of the property phpdoc.
     *
     * @param class-string $class
     */
    public function getShortDescriptionOfAProperty(string $class, string $property): ?string
    {
        return $this->propertyInfoExtractor->getShortDescription($class, $property);
    }

    /**
     * All property phpdoc.
     *
     * @param class-string $class
     */
    public function getLongDescriptionOfAProperty(string $class, string $property): ?string
    {
        return $this->propertyInfoExtractor->getLongDescription($class, $property);
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
        // ReflectionExtractor also lists the "properties" behind accessors and
        // mutators (getName() gives "name"). Without prefixes, only the public
        // properties are left.
        $publicPropertiesOnly = new ReflectionExtractor(mutatorPrefixes: [], accessorPrefixes: [], arrayMutatorPrefixes: []);

        return array_values($publicPropertiesOnly->getProperties($class) ?? []);
    }

    /**
     * Provide extensive data type information for a property.
     *
     * @param class-string $class
     */
    public function getPropertyInfoFromClass(string $class, string $property): ?Type
    {
        return $this->propertyInfoExtractor->getType($class, $property);
    }

    /**
     * Checks if property is readable.
     *
     * @param class-string $class
     */
    public function isPropertyReadable(string $class, string $property): bool
    {
        return true === $this->propertyInfoExtractor->isReadable($class, $property);
    }

    /**
     * Checks if property is writable.
     *
     * @param class-string $class
     */
    public function isPropertyWritable(string $class, string $property): bool
    {
        return true === $this->propertyInfoExtractor->isWritable($class, $property);
    }
}
