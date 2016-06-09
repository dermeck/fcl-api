<?php

namespace AppBundle\Tests\Controller\Api;
use AppBundle\Entity\Card;
use AppBundle\Entity\Course;
use AppBundle\Test\ApiTestCase;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;

class CardControllerTests extends ApiTestCase
{
    // call via cli "vendor/bin/phpunit src/AppBundle/Tests/Controller/Api/CardControllerTests.php"
    private $testCourseId;
    private $testCardId;

    public function setup()
    {
        parent::setup();

        // setup test data
        /** @var EntityManager $em */
        $em = $this->getService('doctrine')->getManager();
        $course = new Course();
        $course->setName("TestCourse");
        $em->persist($course);
        $em->flush();
        $this->testCourseId = $course->getId();

        $card = new Card();
        $card->setName('TestCard');
        $card->setQuestion('question');
        $card->setAnswer('answer');
        $card->setCourse($course);
        $card->setHint('hint');
        $card->setPosition('0');
        $em->persist($card);
        $em->flush();

        $card = new Card();
        $card->setName('TestCard2');
        $card->setQuestion('question2');
        $card->setAnswer('answer2');
        $card->setCourse($course);
        $card->setHint('hint2‚');
        $card->setPosition('0');
        $em->persist($card);
        $em->flush();

        $this->testCardId = $card->getId();
    }

    public function testGetSingle(){
        /** @var ResponseInterface $response */
        $response = $this->client->get('api/cards/' . $this->testCardId);
//        echo $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());

        $this->asserter()->assertResponsePropertiesExist($response, array(
            'question',
            'answer',
            'name',
            'hint',
            'position'
        ));

        $this->asserter()->assertResponsePropertyEquals($response, 'question', 'question2');
    }

    public function testGetCollection(){

        /** @var ResponseInterface $response */
        $response = $this->client->get('api/cards');
//        echo $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());

        $this->asserter()->assertResponsePropertyIsArray($response, 'cards');

        // there should be 2 cards
        $this->asserter()->assertResponsePropertyCount($response, 'cards', 2);
    }

    public function testPost(){
        $data = [
            'name' => 'test',
            'question' => 'question',
            'answer' => 'answer',
            'hint' => 'hint',
            'course' => $this->testCourseId
        ];

        /** @var ResponseInterface $response */
        $response = $this->client->post('api/cards', [
            'body' => json_encode($data)
        ]);

        $this->asserter()->assertResponsePropertiesExist($response, array(
            'question',
            'answer',
            'name',
            'hint',
            'position'
        ));

        $this->asserter()->assertResponsePropertyEquals($response, 'question', 'question');

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
    }
}