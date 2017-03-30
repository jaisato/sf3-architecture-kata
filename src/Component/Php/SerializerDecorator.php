<?php
declare(strict_types=1);

namespace Component\Php;

use Symfony\Component\Serializer\Serializer;

/**
 * ################################################################################
 * / !!! IMPORTANT !!!!!!!!                                                       /
 * / YOU HAVE TO PREPARE Component\Php\Serializer\Car in order to pass unit tests  /
 * ################################################################################
 *
 * @link http://symfony.com/doc/current/components/serializer.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Component\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class SerializerDecorator
{
    /** @var  Serializer */
    private $serializer;

    public function __construct()
    {
        // TODO
    }


    /**
     * Serialize a object to json.
     *
     * @param $object
     * @return string
     */
    public function serializeToJson($object)
    {
        // TODO
    }

    /**
     * Serialize a json to xml
     *
     * @param $object
     * @return string
     */
    public function serializeToXml($object)
    {
        // TODO
    }

    /**
     * Deserialize a xml to a specific class.
     *
     * @param string $class
     * @param string $xml
     *
     * @return object
     */
    public function deserializeFromXml(string $class, string $xml)
    {
        // TODO
    }
}
