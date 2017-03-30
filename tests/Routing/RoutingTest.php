<?php
declare(strict_types=1);

namespace Tests\Routing;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Routing
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class RoutingTest extends WebTestCase
{
    public function testGetRoute()
    {
        $client = static::createClient();

        $client->request('GET', '/topics');

        static::assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPostRoute()
    {
        $client = static::createClient();

        $client->request('POST', '/topics');

        static::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
