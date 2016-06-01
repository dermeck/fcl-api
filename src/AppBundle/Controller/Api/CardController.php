<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Card;
use Symfony\Component\HttpFoundation\Response;

/**
 * Card controller.
 *
 */
class CardController extends Controller
{
    /**
     * Lists all Card entities.
     *
     * @Route("/api/cards", name="api_card_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        // TODO
        return new Response("Jep!");
    }

    /**
     * Creates a new Card entity.
     *
     * @Route("/api/cards", name="api_card_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request)
    {
        $body = $request->getContent();
        $data = json_decode($body, true); //'true' => get an array, not object

        $em = $this->getDoctrine()->getManager();

        // create object ...
        $card = new Card();
        $card->setName($data['name']);
        $card->setAnswer($data['answer']);
        $card->setQuestion($data['question']);
        $card->setHint($data['hint']);
        $card->setPosition(0); // for future use
        $card->setCourse($em->getRepository('AppBundle:Course')->find($data['course']));

        // ... and save it
        $em->persist($card);
        $em->flush();

        // header, body, stats code
        return new Response($body);
    }

    /**
     * Finds and displays a Card entity.
     *
     * @Route("/{id}", name="api_card_show")
     * @Method("GET")
     */
    public function showAction(Card $card)
    {
        // TODO
    }

    /**
     * Displays a form to edit an existing Card entity.
     *
     * @Route("/{id}/edit", name="api_card_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Card $card)
    {
        // TODO
    }

    /**
     * Deletes a Card entity.
     *
     * @Route("/{id}", name="api_card_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Card $card)
    {
        // TODO
    }

    /**
     * Creates a form to delete a Card entity.
     *
     * @param Card $card The Card entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Card $card)
    {
        // TODO
    }
}
