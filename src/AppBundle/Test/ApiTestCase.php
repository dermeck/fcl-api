<?php

namespace AppBundle\Test;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApiTestCase extends KernelTestCase
{
    private static $staticClient;

    private $responseAsserter;

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

        // make service container available
        self::bootKernel();
    }

    public function setup()
    {
        // put client on non-static property
        $this->client = self::$staticClient;

        $this->purgeDatabase();
    }

    public function tearDown()
    {
        // do nothing, override parent function
        // this prevent kernel shutdown
    }

    private function purgeDatabase()
    {
        $em = $this->getService('doctrine')->getManager();
        $purger = new ORMPurger($em);
//        $purger->setPurgeMode(2); // truncate => auto increment starts from 0
        $purger->purge();
    }

    protected function getService($id)
    {
        return self::$kernel->getContainer()->get($id);
    }

    protected function asserter()
    {
        if($this->responseAsserter === null){
            $this->responseAsserter = new ResponseAsserter();
        }

        return $this->responseAsserter;
    }
}