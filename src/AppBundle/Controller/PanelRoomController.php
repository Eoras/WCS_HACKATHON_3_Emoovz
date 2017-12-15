<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MoveOut;
use AppBundle\Entity\PanelRoom;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Panelroom controller.
 *
 * @Route("panelroom")
 */
class PanelRoomController extends Controller
{
    /**
     * Lists all panelRoom entities.
     *
     * @Route("/", name="panelroom_index")
     * @Method("GET")
     */
    public function indexAction(MoveOut $moveOut)
    {
        $em = $this->getDoctrine()->getManager();

        $panelRooms = $em->getRepository('AppBundle:PanelRoom')->findAll();

        return $this->render('panelroom/index.html.twig', array(
            'panelRooms' => $panelRooms,
            'moveOut' => $moveOut,
        ));
    }

    /**
     * Creates a new panelRoom entity.
     *
     * @Route("/new", name="panelroom_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $panelRoom = new Panelroom();
        $form = $this->createForm('AppBundle\Form\PanelRoomType', $panelRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($panelRoom);
            $em->flush();

            return $this->redirectToRoute('panelroom_show', array('id' => $panelRoom->getId()));
        }

        return $this->render('panelroom/new.html.twig', array(
            'panelRoom' => $panelRoom,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a panelRoom entity.
     *
     * @Route("/{id}", name="panelroom_show")
     * @Method("GET")
     */
    public function showAction(PanelRoom $panelRoom)
    {
        $deleteForm = $this->createDeleteForm($panelRoom);

        return $this->render('panelroom/show.html.twig', array(
            'panelRoom' => $panelRoom,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing panelRoom entity.
     *
     * @Route("/{id}/edit", name="panelroom_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PanelRoom $panelRoom)
    {
        $deleteForm = $this->createDeleteForm($panelRoom);
        $editForm = $this->createForm('AppBundle\Form\PanelRoomType', $panelRoom);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panelroom_edit', array('id' => $panelRoom->getId()));
        }

        return $this->render('panelroom/edit.html.twig', array(
            'panelRoom' => $panelRoom,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a panelRoom entity.
     *
     * @Route("/{id}", name="panelroom_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PanelRoom $panelRoom)
    {
        $form = $this->createDeleteForm($panelRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($panelRoom);
            $em->flush();
        }

        return $this->redirectToRoute('panelroom_index');
    }

    /**
     * Creates a form to delete a panelRoom entity.
     *
     * @param PanelRoom $panelRoom The panelRoom entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PanelRoom $panelRoom)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('panelroom_delete', array('id' => $panelRoom->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
