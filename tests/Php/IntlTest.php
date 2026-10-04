<?php

declare(strict_types=1);

namespace App\Tests\Php;

use App\Component\Php\IntlDecorator;
use PHPUnit\Framework\TestCase;

/**
 * The names come in English because phpunit.dist.xml sets intl.default_locale.
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class IntlTest extends TestCase
{
    private IntlDecorator $intl;

    protected function setUp(): void
    {
        $this->intl = new IntlDecorator();
    }

    public function testGetCurrencyName(): void
    {
        static::assertSame('Euro', $this->intl->getCurrencyName('EUR'));
    }

    public function testGetCurrency(): void
    {
        static::assertSame('€', $this->intl->getCurrencySymbol('EUR'));
    }

    public function testGetLocaleName(): void
    {
        static::assertSame('Spanish', $this->intl->getLocaleName('es'));
    }

    public function testGetCountryName(): void
    {
        static::assertSame('Spain', $this->intl->getCountryName('ES'));
    }
}
