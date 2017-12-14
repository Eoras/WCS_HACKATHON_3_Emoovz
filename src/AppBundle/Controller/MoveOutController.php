<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MoveOut;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Moveout controller.
 *
 * @Route("moveout")
 */
class MoveOutController extends Controller
{
    /**
     * Lists all moveOut entities.
     *
     * @Route("/", name="moveout_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $moveOuts = $em->getRepository('AppBundle:MoveOut')->findAll();

        return $this->render('moveout/index.html.twig', array(
            'moveOuts' => $moveOuts,
        ));
    }

    /**
     * Creates a new moveOut entity.
     *
     * @Route("/new", name="moveout_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, SessionInterface $session)
    {
        $moveOut = new Moveout();
        $form = $this->createForm('AppBundle\Form\MoveOutType', $moveOut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($moveOut);
            $em->flush();

            $session->set('moveOut', $moveOut);

            return $this->redirectToRoute('moveout_show', array('id' => $moveOut->getId()));
        }

        return $this->render('moveout/newMoveOut.html.twig', array(
            'moveOut' => $moveOut,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a moveOut entity.
     *
     * @Route("/{id}", name="moveout_show")
     * @Method("GET")
     */
    public function showAction(MoveOut $moveOut)
    {
        $deleteForm = $this->createDeleteForm($moveOut);

        return $this->render('moveout/old.show.html.twig', array(
            'moveOut' => $moveOut,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing moveOut entity.
     *
     * @Route("/{id}/edit", name="moveout_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MoveOut $moveOut)
    {
        $deleteForm = $this->createDeleteForm($moveOut);
        $editForm = $this->createForm('AppBundle\Form\MoveOutType', $moveOut);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('moveout_edit', array('id' => $moveOut->getId()));
        }

        return $this->render('moveout/edit.html.twig', array(
            'moveOut' => $moveOut,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a moveOut entity.
     *
     * @Route("/{id}", name="moveout_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MoveOut $moveOut)
    {
        $form = $this->createDeleteForm($moveOut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($moveOut);
            $em->flush();
        }

        return $this->redirectToRoute('moveout_index');
    }

    /**
     * Creates a form to delete a moveOut entity.
     *
     * @param MoveOut $moveOut The moveOut entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MoveOut $moveOut)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('moveout_delete', array('id' => $moveOut->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
