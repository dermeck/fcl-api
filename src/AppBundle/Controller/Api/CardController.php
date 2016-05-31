<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Card;
use AppBundle\Form\CardType;
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
     * @Route("/new", name="api_card_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        // TODO
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
