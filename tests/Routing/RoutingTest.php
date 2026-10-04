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

        static::assertResponseStatusCodeSame(200, verbose: false);
    }

    /**
     * Any 2xx: a POST that creates a topic may answer 201 Created. The 2017
     * kata asked for exactly 200 here too.
     */
    public function testPostRoute(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        $client->request('POST', '/topics');

        static::assertResponseIsSuccessful(verbose: false);
    }
}
