<?php

declare(strict_types=1);

namespace App\Tests\Php;

use App\Component\Php\PropertyInfoExtractorDecorator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\TypeInfo\Type\ObjectType;

/**
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class PropertyInfoTest extends TestCase
{
    /**
     * Property info extractor
     *
     * something: other
     */
    private PropertyInfoExtractorDecorator $propertyInfo;

    public ?string $something = null;

    protected function setUp(): void
    {
        $this->propertyInfo = new PropertyInfoExtractorDecorator();
    }

    public function testGetPublicProperties(): void
    {
        static::assertSame(
            [],
            $this->propertyInfo->getPublicPropertiesFromClass(PropertyInfoExtractorDecorator::class),
            'You must implement getPublicPropertiesFromClass',
        );

        static::assertSame(
            ['something'],
            $this->propertyInfo->getPublicPropertiesFromClass(self::class),
            'You must implement getPublicPropertiesFromClass',
        );
    }

    public function testGetInformationAboutProperty(): void
    {
        $type = $this->propertyInfo->getPropertyInfoFromClass(PropertyInfoExtractorDecorator::class, 'propertyInfoExtractor');

        // An object type: neither a builtin nor a collection (CollectionType
        // wraps a generic array or iterable type).
        static::assertInstanceOf(ObjectType::class, $type, 'You must implement getPropertyInfoFromClass');
        static::assertSame(PropertyInfoExtractor::class, $type->getClassName(), 'You must implement getPropertyInfoFromClass');
        static::assertFalse($type->isNullable(), 'You must implement getPropertyInfoFromClass');
    }

    public function testGettingShortDescriptionClass(): void
    {
        static::assertSame(
            'Property info extractor',
            $this->propertyInfo->getShortDescriptionOfAProperty(self::class, 'propertyInfo'),
            'You must implement getShortDescriptionOfAProperty',
        );
    }

    public function testGettingLongDescriptionClass(): void
    {
        static::assertSame(
            'something: other',
            $this->propertyInfo->getLongDescriptionOfAProperty(self::class, 'propertyInfo'),
            'You must implement getLongDescriptionOfAProperty',
        );
    }

    public function testCheckingIfPropertyIsReadable(): void
    {
        static::assertFalse(
            $this->propertyInfo->isPropertyReadable(self::class, 'propertyInfo'),
            'You must implement isPropertyReadable',
        );

        static::assertTrue(
            $this->propertyInfo->isPropertyReadable(self::class, 'something'),
            'You must implement isPropertyReadable',
        );
    }

    public function testCheckingIfPropertyIsWritable(): void
    {
        static::assertFalse(
            $this->propertyInfo->isPropertyWritable(self::class, 'propertyInfo'),
            'You must implement isPropertyWritable',
        );

        static::assertTrue(
            $this->propertyInfo->isPropertyWritable(self::class, 'something'),
            'You must implement isPropertyWritable',
        );
    }
}
