<?php

declare(strict_types=1);

namespace App\Tests\Php;

use App\Component\Php\OptionsResolverDecorator;
use PHPUnit\Framework\TestCase;

/**
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class OptionsResolverTest extends TestCase
{
    private OptionsResolverDecorator $optionsResolver;

    protected function setUp(): void
    {
        $this->optionsResolver = new OptionsResolverDecorator();
    }

    public function testRequiredFields(): void
    {
        self::assertTrue(
            $this->optionsResolver->optionsResolver->isRequired('host'),
            'You must set option "host" as required',
        );

        self::assertTrue(
            $this->optionsResolver->optionsResolver->isRequired('company'),
            'You must set option "company" as required',
        );
    }

    public function testOptionalFields(): void
    {
        // isRequired() is also false for an option that was never declared, so
        // on its own it passes against an empty resolver: "port" has to exist.
        self::assertTrue(
            $this->optionsResolver->optionsResolver->isDefined('port'),
            'You must set option "port" as optional',
        );

        self::assertFalse(
            $this->optionsResolver->optionsResolver->isRequired('port'),
            'You must set option "port" as optional',
        );
    }

    public function testDefaultValues(): void
    {
        self::assertTrue(
            $this->optionsResolver->optionsResolver->isDefined('name'),
            'You must set the default value "Jhon Snow" for option "name"',
        );

        // The default is filled in when the options are resolved.
        $this->optionsResolver->setOptions(['host' => 'localhost', 'company' => 'Acme']);

        self::assertSame(
            'Jhon Snow',
            $this->optionsResolver->getOption('name'),
            'You must set the default value "Jhon Snow" for option "name"',
        );
    }
}
