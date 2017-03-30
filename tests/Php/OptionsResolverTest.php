<?php
declare(strict_types=1);

namespace Tests\Php;

use Component\Php\OptionsResolverDecorator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class OptionsResolverTest extends KernelTestCase
{
    /** @var  OptionsResolverDecorator */
    private $optionsResolver;

    public function setUp()
    {
        $this->optionsResolver = new OptionsResolverDecorator();
    }

    public function testRequiredFields()
    {
        self::assertTrue(
            $this->optionsResolver->optionsResolver->isRequired('host'),
            'You must set option "host" as required"'
        );

        self::assertTrue(
            $this->optionsResolver->optionsResolver->isRequired('company'),
            'You must set option "company" as required"'
        );
    }

    public function testOptionalFields()
    {
        self::assertTrue(
            $this->optionsResolver->optionsResolver->isRequired('port'),
            'You must set option "port" as optional"'
        );

        self::assertTrue(
            $this->optionsResolver->optionsResolver->isRequired('company'),
            'You must set option "port" as optional"'
        );
    }

    public function testDefaultValues()
    {
        self::assertTrue(
            $this->optionsResolver->optionsResolver->isDefined('name'),
            'You must set the default value "Jhon Snow" for option "name"'
        );

        self::assertEquals(
            'Jhon Snow',
            $this->optionsResolver->getOption('name'),
            'You must set the default value "Jhon Snow" for option "name"'
        );
    }
}
