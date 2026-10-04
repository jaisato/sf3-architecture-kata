<?php

declare(strict_types=1);

namespace App\Component\Php;

use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Intl\Languages;

/**
 * Since Symfony 4.3 the Intl component is a set of classes, one per kind of
 * data: Currencies, Languages, Locales, Countries, Timezones... The old
 * Intl::getCurrencyBundle() and friends are gone.
 *
 * @see https://symfony.com/doc/7.4/components/intl.html
 * @see Currencies
 * @see Languages
 * @see Countries
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class IntlDecorator
{
    public function getCurrencySymbol(string $currency, ?string $displayLocale = null): string
    {
        return Currencies::getSymbol($currency, $displayLocale);
    }

    public function getCurrencyName(string $currency, ?string $displayLocale = null): string
    {
        return Currencies::getName($currency, $displayLocale);
    }

    public function getLocaleName(string $locale): string
    {
        return Languages::getName($locale);
    }

    public function getCountryName(string $country): string
    {
        return Countries::getName($country);
    }
}
