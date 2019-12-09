<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BeerControllerTest extends WebTestCase
{
    /** @test */
    public function shouldReturnBeerDetailById()
    {
        $client = static::createClient();
        $client->request('GET', 'api/beer/detail?id=1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /** @test */
    public function shouldReturnBeersByFood()
    {
        $client = static::createClient();
        $client->request('GET', 'api/beer?food=orange');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /** @test */
    public function shouldNotReturnBeerDetailById()
    {
        $client = static::createClient();
        $client->request('GET', 'api/beer/detail?id=asdasd');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    /** @test */
    public function shouldNotReturnBeersByFood()
    {
        $client = static::createClient();
        $client->request('GET', 'api/beer?food=123123112123');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
