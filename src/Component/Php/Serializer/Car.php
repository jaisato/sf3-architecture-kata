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

    // The serializer needs a getter for every private property it reads. The
    // getters also fix the order of the attributes, since ObjectNormalizer
    // lists the getters before the public properties: name, year, price.
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): void
    {
        $this->year = $year;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }
}
