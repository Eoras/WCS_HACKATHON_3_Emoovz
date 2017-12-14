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
            "Entrée",
            "Chambre",
            "Cuisine",
            "Salon",
            "Salle à manger",
            "Salle de Bain",
            "Toilettes",
            "Garage",
            "Cave",
            "Autre",
        ];

        foreach ($rooms as $name) {
            $room = new Room();
            $room->setName($name);
            $manager->persist($room);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}