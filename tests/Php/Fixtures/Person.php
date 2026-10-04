<?php

declare(strict_types=1);

namespace App\Tests\Php\Fixtures;

/**
 * A public property and a private one behind a getter and a setter.
 */
final class Person
{
    public string $name = 'Gile';

    private string $address = 'Les Rambles 1';

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
}
