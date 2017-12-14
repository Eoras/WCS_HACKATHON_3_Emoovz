<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 14/12/17
 * Time: 14:08
 */

namespace AppBundle\Controller;

use AppBundle\Entity\MoveOut;
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
        $menuRooms = $moveOut->getRooms();

        return $this->render('menu.html.twig', array(
            'menuRooms' => $menuRooms,
            'moveOut' => $moveOut,
        ));
    }
}
