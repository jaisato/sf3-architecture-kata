<?php

declare(strict_types=1);

namespace App\Component\Php;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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
        // ObjectNormalizer reads through getters and public properties and
        // writes through setters: that is what Car has to offer.
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder(), new XmlEncoder()]);
    }

    /**
     * Serialize an object to JSON.
     */
    public function serializeToJson(object $object): string
    {
        return $this->serializer->serialize($object, 'json');
    }

    /**
     * Serialize an object to XML.
     */
    public function serializeToXml(object $object): string
    {
        return $this->serializer->serialize($object, 'xml');
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
        $object = $this->serializer->deserialize($xml, $class, 'xml');

        if (!$object instanceof $class) {
            throw new \UnexpectedValueException(\sprintf('Expected an instance of %s.', $class));
        }

        return $object;
    }
}
