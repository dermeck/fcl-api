<?php

namespace AppBundle\Tests\Controller\Api;
use GuzzleHttp\Client;

class CardControllerTests extends \PHPUnit_Framework_TestCase
{
    // call via cli "vendor/bin/phpunit src/AppBundle/Tests/Controller/Api/CardControllerTests.php"

    public function testGetSingle(){
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
            'default' => [
                'exceptions' => false,
            ]
        ]);

        $response = $client->get('/api/cards/1');
        echo $response->getBody();


        $this->assertEquals(200, $response->getStatusCode());
        // valid json...
    }

    public function testGetCollection(){
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
            'default' => [
                'exceptions' => false,
            ]
        ]);

        $response = $client->get('/api/cards');
        echo $response->getBody();


        $this->assertEquals(200, $response->getStatusCode());
        // valid json...
    }

//    public function testGet404(){
//        $client = new Client([
//            'base_uri' => 'http://localhost:8000',
//            'default' => [
//                'exceptions' => false,
//            ]
//        ]);
//
//        $response = $client->get('/api/cards/11');
//
//        $this->assertEquals(404, $response->getStatusCode());
//    }

    public function testPost(){
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
            'default' => [
                'exceptions' => false,
            ]
        ]);
        
        $data = [
            'name' => ' ',
            'question' => 'question',
            'answer' => 'answer',
            'hint' => 'hint',
            'course' => '2'
        ];
        
        $response = $client->post('/api/cards', [
            'body' => json_encode($data)
        ]);

        echo 'response: ';
        echo $response->getBody();

//        echo "\n\n";
//        echo $response->getHeaders()['Location'][0];
        $headers = $response->getHeaders();
        foreach ($headers as $key => $val) {
            echo "\n";
            echo $key . ': ' . $val[0];
        }

        $this->assertEquals(201, $response->getStatusCode());

        $this->assertTrue($response->hasHeader('Location'));

        // valid json...

    }
}