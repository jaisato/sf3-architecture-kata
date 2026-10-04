<?php

declare(strict_types=1);

namespace App\Tests\Php;

use App\Component\Php\PropertyAccessDecorator;
use App\Tests\Php\Fixtures\Person;
use PHPUnit\Framework\TestCase;

/**
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class PropertyAccessTest extends TestCase
{
    private Person $object;

    /** @var array<mixed> */
    private array $array;

    private PropertyAccessDecorator $propertyAccess;

    protected function setUp(): void
    {
        $this->array = ['name' => 'Gile'];
        $this->object = new Person();

        $this->propertyAccess = new PropertyAccessDecorator();
    }

    public function testReadingFromArray(): void
    {
        self::assertSame(
            'Gile',
            $this->propertyAccess->readFromArray($this->array, 'name'),
            'Missing readFromArray implementation',
        );
    }

    public function testReadingFromObject(): void
    {
        self::assertSame(
            'Gile',
            $this->propertyAccess->readFromObject($this->object, 'name'),
            'Missing readFromObject implementation',
        );

        self::assertSame(
            'Les Rambles 1',
            $this->propertyAccess->readFromObject($this->object, 'address'),
            'Missing readFromObject implementation',
        );
    }

    public function testWriteToObject(): void
    {
        $this->propertyAccess->writeToObject($this->object, 'name', 'Mario');
        // "set_address" is camelized to setAddress(), a "jQuery style" setter.
        $this->propertyAccess->writeToObject($this->object, 'set_address', 'Catalonia');

        self::assertSame(
            'Mario',
            $this->object->name,
            'Missing writeToObject implementation',
        );

        self::assertSame(
            'Catalonia',
            $this->object->getAddress(),
            'Missing writeToObject implementation',
        );
    }

    public function testWriteToArray(): void
    {
        $this->propertyAccess->writeToArray($this->array, 'name', 'Mario');

        self::assertSame(
            'Mario',
            $this->array['name'],
            'Missing writeToArray implementation',
        );
    }
}
