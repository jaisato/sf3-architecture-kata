<?php

declare(strict_types=1);

namespace App\Component\Php\Serializer;

/**
 * @see https://symfony.com/doc/7.4/components/serializer.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class Car
{
    public ?string $name = null;

    private ?string $year = null;

    private ?string $price = null;

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setYear(?string $year): void
    {
        $this->year = $year;
    }

    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }
}
