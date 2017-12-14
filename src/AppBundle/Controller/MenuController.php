<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 14/12/17
 * Time: 14:08
 */

namespace AppBundle\Controller;

use AppBundle\Entity\MoveOut;
use AppBundle\Entity\MoveOutRoom;
use AppBundle\Entity\Room;
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

}
