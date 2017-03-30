<?php
declare(strict_types=1);

namespace Tests\Php;

use Component\Php\PropertyAccessDecorator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class PropertyAccessTest extends KernelTestCase
{
    /** @var object */
    private $object;

    /** @var array */
    private $array;

    /** @var PropertyAccessDecorator */
    private $propertyAccess;

    protected function setUp()
    {
        $this->array = ['name' => 'Gile'];
        $this->object = new class {
            public $name = 'Gile';
            private $address = 'Les Rambles 1';

            public function getAddress()
            {
                return $this->address;
            }

            public function setAddress(string $address)
            {
                $this->address = $address;
            }
        };


        $this->propertyAccess = new PropertyAccessDecorator();
    }

    public function testReadingFromArray()
    {
        self::assertEquals(
            'Gile',
            $this->propertyAccess->readFromArray($this->array, 'name'),
            'Missing readFromArray implementation'
        );
    }

    public function testReadingFromObject()
    {
        self::assertEquals(
            'Gile',
            $this->propertyAccess->readFromObject($this->object, 'name'),
            'Missing readFromObject implementation'
        );

        self::assertEquals(
            'Les Rambles 1',
            $this->propertyAccess->readFromObject($this->object, 'address'),
            'Missing readFromObject implementation'
        );
    }

    public function testWriteToObject()
    {
        $this->propertyAccess->writeToObject($this->object, 'name', 'Mario');
        $this->propertyAccess->writeToObject($this->object, 'set_address', 'Catalonia');

        self::assertEquals(
            'Mario',
           $this->object->name,
            'Missing writeToObject implementation'
        );

        self::assertEquals(
            'Catalonia',
            $this->object->getAddress(),
            'Missing writeToObject implementation'
        );
    }

    public function testWriteToArray()
    {
        $this->propertyAccess->writeToArray($this->array, 'name', 'Mario');

        self::assertEquals(
            'Mario',
            $this->array['name'],
            'Missing writeToArray implementation'
        );
    }
}
