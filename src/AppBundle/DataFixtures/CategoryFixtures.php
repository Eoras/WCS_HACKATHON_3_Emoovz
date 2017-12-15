<?php
/**
 * Created by PhpStorm.
 * User: eoras
 * Date: 14/12/17
 * Time: 11:23
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $categories = [
            0 => ["Carton", "carton.jpg"],
            1 => ["Canapé", "canape.jpg"],
            2 => ["Siège", "sieges.jpg"],
            3 => ["Table", "table.jpg"],
            4 => ["Luminaire", "luminaire.jpg"],
            5 => ["Décoration", "deco.jpg"],
            6 => ["Meuble", "meuble.jpg"],
            7 => ["High Tech", "tele.jpg"],
            8 => ["Electroménager", "electro.jpg"],
            9 => ["Extérieur", "exterieur.jpg"],
            10 => ["Loisirs", "loisirs.jpg"],
            11 => ["Rangement", "rangement.jpg"],
            12 => ["Literie", "literie.jpg"],
        ];

        foreach ($categories as $categoryTab) {
            $category = new Category();
            $category->setName($categoryTab[0]);
            $category->setPictureName($categoryTab[1]);
            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}