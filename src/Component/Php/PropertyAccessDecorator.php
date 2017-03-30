<?php
declare(strict_types=1);

namespace Component\Php;

/**
 * @link http://symfony.com/doc/current/components/property_access.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Component\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class PropertyAccessDecorator
{
    /** @var \Symfony\Component\PropertyAccess\PropertyAccessor */
    private $accessor;

    public function __construct()
    {
    }

    /**
     * Read element from array
     *
     * @param array $array
     * @param string $element
     * @return mixed
     */
    public function readFromArray(array $array, string $element)
    {
        // TODO
    }

    /**
     * Read attribute from object
     *
     * @param object $object
     * @param string $attribute
     * @return mixed
     */
    public function readFromObject($object, string $attribute)
    {
        // TODO
    }

    /**
     * Set element of attribute.
     * @param array $array
     * @param string $element
     * @param $value
     */
    public function writeToArray(array &$array, string $element, $value)
    {
        // TODO
    }

    /**
     * Set attribute of object.
     *
     * @param object $object
     * @param string $attribute
     * @param $value
     */
    public function writeToObject(&$object, string $attribute, $value)
    {
        // TODO
    }

    /**
     * Check if attribute/element is writable
     * @param $item
     * @param string $attribute
     */
    public function isWritable($item, string $attribute)
    {
        // TODO
    }

    /**
     * Check if attribute/element is readable
     * @param $item
     * @param string $attribute
     */
    public function isReadable($item, string $attribute)
    {
        // TODO
    }
}
