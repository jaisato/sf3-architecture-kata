<?php
declare(strict_types=1);

namespace Component\Php;

use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\Type;

/**
 * @link http://symfony.com/doc/current/components/property_info.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Component\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class PropertyInfoExtractorDecorator
{
    /** @var PropertyInfoExtractor */
    private $propertyInfoExtractor;

    public function __construct()
    {
        // TODO
    }

    /**
     * First line of the property phpdoc.
     *
     * @param string $class
     * @param string $property
     * @return mixed|null|string
     */
    public function getShortDescriptionOfAProperty(string $class, string $property)
    {
        // TODO
    }

    /**
     * All property phpdoc.
     *
     * @param string $class
     * @param string $property
     * @return mixed|null|string
     */
    public function getLongDescriptionOfAProperty(string $class, string $property)
    {
        // TODO
    }

    /**
     * Returns all public properties from a class.
     *
     * @param string $class
     * @return array
     */
    public function getPublicPropertiesFromClass(string $class)
    {
        // TODO
    }

    /**
     * Provide extensive data type information for a property
     *
     * @param string $class
     * @param string $property
     * @return Type[]
     */
    public function getPropertyInfoFromClass(string $class, string $property)
    {
        // TODO
    }

    /**
     * Checks if property is readable
     *
     * @param string $class
     * @param string $property
     * @return bool
     */
    public function isPropertyReadable(string $class, string $property)
    {
        // TODO
    }

    /**
     * Checks if property is writable
     *
     * @param string $class
     * @param string $property
     * @return bool
     */
    public function isPropertyWritable(string $class, string $property)
    {
        // TODO
    }
}
