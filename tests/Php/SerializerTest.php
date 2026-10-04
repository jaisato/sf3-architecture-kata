<?php

declare(strict_types=1);

namespace App\Tests\Php;

use App\Component\Php\Serializer\Car;
use App\Component\Php\SerializerDecorator;
use PHPUnit\Framework\TestCase;

/**
 * @see https://symfony.com/doc/7.4/components/serializer.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class SerializerTest extends TestCase
{
    private SerializerDecorator $serializerDecorator;

    protected function setUp(): void
    {
        $this->serializerDecorator = new SerializerDecorator();
    }

    public function testDeserializeAXml(): void
    {
        $xml = '<?xml version="1.0"?>
            <response>
                <name>TroncoMovil</name>
                <year>1200 AC</year>
                <price>12500 stones</price>
            </response>';

        $car = $this->serializerDecorator->deserializeFromXml(Car::class, $xml);

        // assertAttributeEquals() is gone since PHPUnit 9; assertEquals()
        // compares objects property by property, private ones included.
        static::assertEquals(self::car(), $car, 'You must implement deserializeFromXml');
    }

    public function testSerializeACarToJson(): void
    {
        self::assertJsonStringEqualsJsonString(
            '{"name":"TroncoMovil","year":"1200 AC","price":"12500 stones"}',
            $this->serializerDecorator->serializeToJson(self::car()),
            'You must implement the JSON serializer and the Car class',
        );
    }

    public function testSerializeACarToXml(): void
    {
        self::assertXmlStringEqualsXmlString(
            '<?xml version="1.0"?>
                        <response>
                            <name>TroncoMovil</name>
                            <year>1200 AC</year>
                            <price>12500 stones</price>
                        </response>',
            $this->serializerDecorator->serializeToXml(self::car()),
            'You must implement the XML serializer and the Car class',
        );
    }

    private static function car(): Car
    {
        $car = new Car();
        $car->setName('TroncoMovil');
        $car->setYear('1200 AC');
        $car->setPrice('12500 stones');

        return $car;
    }
}
