<?php
declare(strict_types=1);

namespace Tests\Php;

use Component\Php\PropertyInfoExtractorDecorator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class PropertyInfoTest extends KernelTestCase
{
    /**
     * Property info extractor
     *
     * something: other
     *
     * @var PropertyInfoExtractorDecorator
     */
    private $propertyInfo;

    public $something;

    protected function setUp()
    {
        $this->propertyInfo = new PropertyInfoExtractorDecorator();
    }

    public function testGetPublicProperties()
    {
        $properties = $this->propertyInfo->getPublicPropertiesFromClass(PropertyInfoExtractorDecorator::class);

        static::assertEquals(
            [],
            $properties,
            'You must to implement getPropertiesFromClass'
        );
    }

    public function testGetInformationAboutProperty()
    {
        $information = $this->propertyInfo->getPropertyInfoFromClass(PropertyInfoExtractorDecorator::class, 'propertyInfoExtractor');

        static::assertEquals(
            PropertyInfoExtractor::class,
            $information[0]->getClassName(),
            'You must to implement getPropertyInfoFromClass'
        );

        static::assertEquals(
            false,
            $information[0]->isNullable(),
            'You must to implement getPropertyInfoFromClass'
        );

        static::assertEquals(
            false,
            $information[0]->isCollection(),
            'You must to implement getPropertyInfoFromClass'
        );
    }

    public function testGettingShortDescriptionClass()
    {
        $description = $this->propertyInfo->getShortDescriptionOfAProperty(static::class, 'propertyInfo');

        static::assertEquals(
            'Property info extractor',
            $description,
            'You must to implement getShortDescriptionOfAProperty'
        );
    }

    public function testGettingLongDescriptionClass()
    {
        $description = $this->propertyInfo->getLongDescriptionOfAProperty(static::class, 'propertyInfo');

        static::assertEquals(
            'something: other',
            $description,
            'You must to implement getLongDescriptionOfAProperty'
        );
    }

    public function testCheckingIfPropertyIsReadable()
    {
        static::assertFalse(
            $this->propertyInfo->isPropertyReadable(static::class, 'propertyInfo'),
            'You must to implement isPropertyReadable'
        );

        static::assertTrue(
            $this->propertyInfo->isPropertyReadable(static::class, 'something'),
            'You must to implement isPropertyReadable'
        );
    }

    public function testCheckingIfPropertyIsWritable()
    {
        static::assertFalse(
            $this->propertyInfo->isPropertyWritable(static::class, 'propertyInfo'),
            'You must to implement isPropertyWritable'
        );

        static::assertTrue(
            $this->propertyInfo->isPropertyWritable(static::class, 'something'),
            'You must to implement isPropertyWritable'
        );
    }
}
