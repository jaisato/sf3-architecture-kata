<?php
declare(strict_types=1);

namespace Component\Php\Serializer;

/**
 * http://symfony.com/doc/current/components/serializer.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Php\Serializer
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class Car
{
    public $name;

    private $year;

    private $price;

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}
