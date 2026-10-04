<?php

declare(strict_types=1);

namespace App\Component\Php;

use Symfony\Component\Serializer\SerializerInterface;

/**
 * ################################################################################
 * / !!! IMPORTANT !!!!!!!!                                                       /
 * / YOU HAVE TO PREPARE App\Component\Php\Serializer\Car to pass the unit tests  /
 * ################################################################################
 *
 * @see https://symfony.com/doc/7.4/components/serializer.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class SerializerDecorator
{
    private SerializerInterface $serializer;

    public function __construct()
    {
        // TODO
    }

    /**
     * Serialize an object to JSON.
     */
    public function serializeToJson(object $object): string
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Serialize an object to XML.
     */
    public function serializeToXml(object $object): string
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Deserialize an XML document into an object of the given class.
     *
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    public function deserializeFromXml(string $class, string $xml): object
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }
}
