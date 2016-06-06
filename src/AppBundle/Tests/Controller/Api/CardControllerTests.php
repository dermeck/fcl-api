<?php

namespace AppBundle\Tests\Controller\Api;
use AppBundle\Test\ApiTestCase;
use GuzzleHttp\Client;

class CardControllerTests extends ApiTestCase
{
    // call via cli "vendor/bin/phpunit src/AppBundle/Tests/Controller/Api/CardControllerTests.php"

    public function testGetSingle(){
        $response = $this->client->get('/api/cards/1');
        echo $response->getBody();
        
        $this->assertEquals(200, $response->getStatusCode());
        // valid json...
    }

    public function testGetCollection(){
        $response = $this->client->get('/api/cards');
        echo $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        // valid json...
    }

    public function testPost(){
        $data = [
            'name' => ' ',
            'question' => 'question',
            'answer' => 'answer',
            'hint' => 'hint',
            'course' => '2'
        ];
        
        $response = $this->client->post('/api/cards', [
            'body' => json_encode($data)
        ]);

//        echo 'response: ';
//        echo $response->getBody();
//
//        $headers = $response->getHeaders();
//        foreach ($headers as $key => $val) {
//            echo "\n";
//            echo $key . ': ' . $val[0];
//        }

        $this->assertEquals(201, $response->getStatusCode());

        $this->assertTrue($response->hasHeader('Location'));

        // valid json...
        $finishedData = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('question', $finishedData);

    }
}