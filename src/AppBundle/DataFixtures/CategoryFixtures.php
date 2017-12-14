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
            "Cartons",
            "Canapé",
            "Siège",
            "Tables",
            "Luminaires",
            "Décoration",
            "Meubles",
            "High Tech",
            "Electroménager",
            "Extérieur",
            "Loisirs",
            "Rangements",
            "Literie",
        ];

        foreach ($categories as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}