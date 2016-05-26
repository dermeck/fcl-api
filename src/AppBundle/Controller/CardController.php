<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Card;
use AppBundle\Form\CardType;

/**
 * Card controller.
 *
 * @Route("/card")
 */
class CardController extends Controller
{
    /**
     * Lists all Card entities.
     *
     * @Route("/", name="card_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cards = $em->getRepository('AppBundle:Card')->findAll();

        return $this->render('card/index.html.twig', array(
            'cards' => $cards,
        ));
    }

    /**
     * Creates a new Card entity.
     *
     * @Route("/new", name="card_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $card = new Card();
        $form = $this->createForm('AppBundle\Form\CardType', $card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($card);
            $em->flush();

            return $this->redirectToRoute('card_show', array('id' => $card->getId()));
        }

        return $this->render('card/new.html.twig', array(
            'card' => $card,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Card entity.
     *
     * @Route("/{id}", name="card_show")
     * @Method("GET")
     */
    public function showAction(Card $card)
    {
        $deleteForm = $this->createDeleteForm($card);

        return $this->render('card/show.html.twig', array(
            'card' => $card,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Card entity.
     *
     * @Route("/{id}/edit", name="card_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Card $card)
    {
        $deleteForm = $this->createDeleteForm($card);
        $editForm = $this->createForm('AppBundle\Form\CardType', $card);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($card);
            $em->flush();

            return $this->redirectToRoute('card_edit', array('id' => $card->getId()));
        }

        return $this->render('card/edit.html.twig', array(
            'card' => $card,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Card entity.
     *
     * @Route("/{id}", name="card_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Card $card)
    {
        $form = $this->createDeleteForm($card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($card);
            $em->flush();
        }

        return $this->redirectToRoute('card_index');
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
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('card_delete', array('id' => $card->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
