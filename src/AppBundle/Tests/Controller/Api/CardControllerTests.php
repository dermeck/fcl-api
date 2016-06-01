<?php

namespace AppBundle\Tests\Controller\Api;
use GuzzleHttp\Client;

class CardControllerTests extends \PHPUnit_Framework_TestCase
{
    // call via cli "vendor/bin/phpunit src/AppBundle/Tests/Controller/Api/CardControllerTests.php"

    public function testGet(){
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
            'default' => [
                'exceptions' => false,
            ]
        ]);
//        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', '/api/cards');
        echo $res->getStatusCode();
        echo "\n\n";
        echo $res->getHeaderLine('content-type');
        echo "\n\n";
        echo $res->getBody();

        echo "\n\n";
        
        $this->assertEquals(200, $res->getStatusCode());

//        $this->assertTrue($res->hasHeader('Location'));

        // valid json...
    }

}