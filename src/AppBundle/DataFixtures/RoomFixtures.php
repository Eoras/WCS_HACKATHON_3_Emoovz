<?php
/**
 * Created by PhpStorm.
 * User: eoras
 * Date: 14/12/17
 * Time: 11:23
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RoomFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $rooms = [
            0 => ["Entrée", "entree.jpg"],
            1 => ["Chambre", "chambre.jpg"],
            2 => ["Cuisine", "cuisine.jpg"],
            3 => ["Salon", "salon.jpg"],
            4 => ["Salle à manger", "salle_a_manger.jpg"],
            5 => ["Salle de Bain", "salle_de_bain.jpg"],
            6 => ["Toilettes", "toilettes.jpg"],
            7 => ["Garage", "garage.jpg"],
            8 => ["Cave", "cave.jpg"],
            9 => ["Autre", "autre.jpg"],
        ];

        foreach ($rooms as $roomTab) {
            $room = new Room();
            $room->setName($roomTab[0]);
            $room->setPictureName($roomTab[1]);
            $manager->persist($room);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}