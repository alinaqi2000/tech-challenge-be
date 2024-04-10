<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testClientRequest(): void
    {
        $client = static::createClient();

        $client->request('POST', '/', [], [], [], json_encode([
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('test@example.com', $responseData["user"]['email']);
    }
}
