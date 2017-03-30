<?php
declare(strict_types=1);

namespace Tests\Php;

use Component\Php\SerializerDecorator;
use Component\Php\Serializer\Car;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @link http://symfony.com/doc/current/components/serializer.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class SerializerTest extends KernelTestCase
{
    /** @var  SerializerDecorator */
    private $serializerDecorator;

    protected function setUp()
    {
        $this->serializerDecorator = new SerializerDecorator();
    }

    public function testDeserializeAXml()
    {
        $xml = '<?xml version="1.0"?>
            <response>
                <name>TroncoMovil</name>
                <year>1200 AC</year>
                <price>12500 stones</price>
            </response>';

        $car = $this->serializerDecorator->deserializeFromXml(Car::class, $xml);

        static::assertAttributeEquals(
            'TroncoMovil',
            'name',
            $car,
            'you must to implemente deserializeFromXml'
        );

        static::assertAttributeEquals(
            '1200 AC',
            'year',
            $car,
            'you must to implemente deserializeFromXml'
        );

        static::assertAttributeEquals(
            '12500 stones',
            'price',
            $car,
            'you must to implemente deserializeFromXml'
        );
    }

    public function testSerializeACarToJson()
    {
        $car = new Car();

        $car->setName('TroncoMovil');
        $car->setPrice('12500 stones');
        $car->setYear('1200 AC');

        self::assertJsonStringEqualsJsonString(
            '{"name":"TroncoMovil","year":"1200 AC","price":"12500 stones"}',
            $this->serializerDecorator->serializeToJson($car),
            'You must to implement json serializer and Car class'
        );
    }

    public function testSerializeACarToXml()
    {
        $car = new Car();

        $car->setName('TroncoMovil');
        $car->setPrice('12500 stones');
        $car->setYear('1200 AC');

        self::assertXmlStringEqualsXmlString(
            '<?xml version="1.0"?>
                        <response>
                            <name>TroncoMovil</name>
                            <year>1200 AC</year>
                            <price>12500 stones</price>
                        </response>',
            $this->serializerDecorator->serializeToXml($car),
            'You must to implement json serializer and Car class'
        );
    }
}
