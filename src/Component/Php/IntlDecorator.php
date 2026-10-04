<?php

declare(strict_types=1);

namespace App\Component\Php;

/**
 * Since Symfony 4.3 the Intl component is a set of classes, one per kind of
 * data: Currencies, Languages, Locales, Countries, Timezones... The old
 * Intl::getCurrencyBundle() and friends are gone.
 *
 * @see https://symfony.com/doc/7.4/components/intl.html
 * @see \Symfony\Component\Intl\Currencies
 * @see \Symfony\Component\Intl\Languages
 * @see \Symfony\Component\Intl\Countries
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class IntlDecorator
{
    public function getCurrencySymbol(string $currency, ?string $displayLocale = null): string
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    public function getCurrencyName(string $currency, ?string $displayLocale = null): string
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    public function getLocaleName(string $locale): string
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    public function getCountryName(string $country): string
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }
}
