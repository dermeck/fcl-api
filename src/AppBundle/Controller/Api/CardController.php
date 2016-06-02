<?php

namespace AppBundle\Controller\Api;

use AppBundle\Form\CardType;
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

        // update with data
        $data['position'] = 0;
        $courseId = $data['course'];
        $data['course'] = $em->getRepository('AppBundle:Course')->find($courseId);
        $form = $this->createForm(CardType::class, $card);
        $form->submit($data);

        // ... and save it
        $em->persist($card);
        $em->flush();
        
        $location = $this->generateUrl('api_card_show', [
            'id' => $card->getId()
        ]);

        $response = new Response($body, 201);
        $response->headers->set('Location', $location);

        return $response;
    }

    /**
     * Finds and returns a single Card entity.
     *
     * @Route("/api/cards/{id}", name="api_card_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        // query for card
        $card = $this->getDoctrine()
            ->getRepository('AppBundle:Card')
            ->find($id);

        if(!$card) {
            throw $this->createNotFoundException('Card with id: ' . $id . " not found.");
        }

        // serialize card object
        $data = [
            'name' => $card->getName(),
            'question' => $card->getQuestion(),
            'answer' => $card->getAnswer(),
            'hint' => $card->getHint(),
            'position' => $card->getPosition(),
            'course' => $card->getCourse()->getId()
        ];

        $response = new Response(json_encode($data, 200));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
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
