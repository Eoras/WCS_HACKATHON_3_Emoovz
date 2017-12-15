<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 14/12/17
 * Time: 14:08
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\MoveOut;
use AppBundle\Entity\MoveOutRoom;
use AppBundle\Entity\MoveOutRoomObject;
use AppBundle\Entity\Object;
use AppBundle\Entity\Room;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class MenuController extends Controller
{
    /**
     * Lists all room entities.
     *
     * @Route("/user-room/{id}", name="user_room_index")
     * @Method("GET")
     */
    public function userRoomAction(MoveOut $moveOut)
    {

        $moveOutRooms = $moveOut->getMoveOutRooms();
        $deleteProjectForms = [];
        foreach ($moveOutRooms as $moveOutRoom) {
            $deleteForm = $this->createMoveOutRoomDeleteForm($moveOutRoom);
            $deleteProjectForms[$moveOutRoom->getId()] = $deleteForm->createView();
        }


        return $this->render('menu.html.twig', array(
            'moveOutRooms' => $moveOutRooms,
            'delete_forms' => $deleteProjectForms,
            'moveOut' => $moveOut,
            /*'myObjects' => $myObjects,*/
        ));
    }


    /**
     * Deletes a room entity.
     *

     * @Route("/move_out_room_delete/{id}", name="move_out_room_delete")
     * @Method("DELETE")
     */
    public function deleteMoveOutRoomAction(Request $request, MoveOutRoom $moveOutRoom)
    {
        $form = $this->createMoveOutRoomDeleteForm($moveOutRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($moveOutRoom);
            $em->flush();
        }

        return $this->redirectToRoute('room_index');
    }

    /**
     * Creates a form to delete a moveOut entity.
     *
     * @param MoveOutRoom $moveOutRoom The moveOutRoom entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createMoveOutRoomDeleteForm(MoveOutRoom $moveOutRoom)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('move_out_room_delete', array('id' => $moveOutRoom->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * Lists all room entities.
     *
     * @Route("/user-object/{id}", name="user_object_index")
     * @Method("GET")
     */
    public function userCategoryAction(MoveOutRoom $moveOutRoom)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Category')->findAll();
        $objects = $em->getRepository('AppBundle:Object')->findAll();

        return $this->render('category/index.html.twig', array(
            'moveOutRoom' => $moveOutRoom,
            'categories' => $categories,
            'objects' => $objects,
        ));
    }

    /**
     * Lists all room entities.
     *
     * @Route("/user-object/{moveOutRoom}/category/{category}", name="user_object_category_index")
     * @Method("GET")
     */
    public function userObjectAction(MoveOutRoom $moveOutRoom, Category $category)
    {
        $em = $this->getDoctrine()->getManager();

        $objects = $em->getRepository('AppBundle:Object')->findByCategory($category->getId());

        return $this->render('object/index.html.twig', array(
            'objects' => $objects,
            'moveOutRoom' => $moveOutRoom,
            'category' => $category,
        ));
    }

    /**
     * Creates a new object entity.
     *
     * @Route("/new/{moveOutRoom}/{object}", name="object_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, MoveOutRoom $moveOutRoom, Object $object)
    {
        $myObject = new MoveOutRoomObject();
        $myObject->setMoveOutRoom($moveOutRoom);
        $myObject->setObject($object);

        $em = $this->getDoctrine()->getManager();
            $em->persist($myObject);
            $em->flush();


        return $this->redirectToRoute('user_object_category_index', array(
            'moveOutRoom' => $moveOutRoom->getId(),
            'category' => $object->getCategory()->getId(),
        ));
    }

    /**
     * Deletes a room entity.
     *
     * @Route("/move_out_room_object_delete/{id}", name="move_out_room_object_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteMoveOutRoomObjectAction(MoveOutRoomObject $moveOutRoomObject)
    {
        $moveOutRoomId = $moveOutRoomObject->getMoveOutRoom()->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($moveOutRoomObject);
            $em->flush();


        return $this->redirectToRoute('user_object_index', ['id'=> $moveOutRoomId]);
    }
}
