<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Object;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Object controller.
 *
 * @Route("object")
 */
class ObjectController extends Controller
{
    /**
     * Lists all object entities.
     *
     * @Route("/", name="object_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $objects = $em->getRepository('AppBundle:Object')->findAll();

        return $this->render('object/index.html.twig', array(
            'objects' => $objects,
        ));
    }

    /**
     * Creates a new object entity.
     *
     * @Route("/new", name="object_new1")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $object = new Object();
        $form = $this->createForm('AppBundle\Form\ObjectType', $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();

            return $this->redirectToRoute('object_show', array('id' => $object->getId()));
        }

        return $this->render('object/new.html.twig', array(
            'object' => $object,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a object entity.
     *
     * @Route("/{id}", name="object_show")
     * @Method("GET")
     */
    public function showAction(Object $object)
    {
        $deleteForm = $this->createDeleteForm($object);

        return $this->render('object/show.html.twig', array(
            'object' => $object,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing object entity.
     *
     * @Route("/{id}/edit", name="object_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Object $object)
    {
        $deleteForm = $this->createDeleteForm($object);
        $editForm = $this->createForm('AppBundle\Form\ObjectType', $object);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('object_edit', array('id' => $object->getId()));
        }

        return $this->render('object/edit.html.twig', array(
            'object' => $object,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a object entity.
     *
     * @Route("/{id}", name="object_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Object $object)
    {
        $form = $this->createDeleteForm($object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($object);
            $em->flush();
        }

        return $this->redirectToRoute('object_index');
    }

    /**
     * Creates a form to delete a object entity.
     *
     * @param Object $object The object entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Object $object)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('object_delete', array('id' => $object->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
