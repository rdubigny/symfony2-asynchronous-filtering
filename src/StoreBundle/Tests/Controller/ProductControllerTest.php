<?php

namespace StoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');
    }

    public function testListpartial()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'list-partial');
    }

}
