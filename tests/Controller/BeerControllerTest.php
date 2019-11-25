<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BeerControllerTest extends WebTestCase
{

    public function shouldReturnBeersByFood()
    {
        $client = static::createClient();
        $client->request('GET', '/beer?food=orange');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function shouldNotReturnBeersByFood()
    {
        $client = static::createClient();
        $client->request('GET', '/beer?food=123123112123');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
