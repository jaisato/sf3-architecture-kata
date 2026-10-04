<?php

declare(strict_types=1);

namespace App\Tests\Routing;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class RoutingTest extends WebTestCase
{
    public function testGetRoute(): void
    {
        $client = static::createClient();
        // A missing route then fails the test with the router's own message
        // ("No route found for ...") instead of an error page.
        $client->catchExceptions(false);

        $client->request('GET', '/topics');

        static::assertResponseIsSuccessful(verbose: false);
    }

    public function testPostRoute(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        $client->request('POST', '/topics');

        static::assertResponseIsSuccessful(verbose: false);
    }
}
