<?php

namespace AppBundle\Test;

use GuzzleHttp\Client;

class ApiTestCase extends \PHPUnit_Framework_TestCase
{
    private static $staticClient;

    /**
     * @var Client
     */
    protected $client;

    public static function setUpBeforeClass()
    {
        // make sure the client is created just once
        self::$staticClient = new Client([
            'base_uri' => 'http://localhost:8000',
            'default' => [
                'exceptions' => false,
            ]
        ]);
    }

    public function setup()
    {
        // put client on non-static property
        $this->client = self::$staticClient;
    }

}