<?php
declare(strict_types=1);

namespace Tests\Php;

use Component\Php\IntlDecorator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class IntlTest extends KernelTestCase
{
    /** @var IntlDecorator */
    private $intl;

    public function setUp()
    {
        $this->intl= new IntlDecorator();
    }

    public function testGetCurrencyName()
    {
        static::assertEquals('Euro', $this->intl->getCurrencySymbol('EUR'));
    }

    public function testGetCurrency()
    {
        static::assertEquals('€', $this->intl->getCurrencySymbol('EUR'));
    }

    public function testGetLocaleName()
    {
        static::assertEquals('Spanish', $this->intl->getLocaleName('es'));
    }

    public function testGetCountryName()
    {
        static::assertEquals('Spain', $this->intl->getCountryName('ES'));
    }
}
