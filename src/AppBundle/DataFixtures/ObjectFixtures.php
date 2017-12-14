<?php
/**
 * Created by PhpStorm.
 * User: eoras
 * Date: 14/12/17
 * Time: 11:23
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Category;
use AppBundle\Entity\Object;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ObjectFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $objects = [
            0 => ["Grand carton (55 x 35 x 30 cm", "Petit carton (35 x 27,5 x 30 cm)"],
            1 => ["Canapé 2 places", "Canapé 3 places", "Canapé d'angle"],
            2 => ["Chaise", "Pouf", "Tabouret", "Fauteuil"],
            3 => ["Guéridon / Table d'appoint", "Table 2-4 personnes", "Table 6-8 personnes", "Table monastère en chêne", "Table Pliante", "Table Ronde"],
            4 => ["Halogène", "Lampe à abat-jour", "Lustre"],
            5 => ["Aquarium", "Miroir", "Tableau / Cadre", "Tapis"],
            6 => ["Armoire 1 porte", "Armoire 2 Portes", "Armoire 3 Portes", "Armoire 4 portes / dressing", "Bar", "Bibliothèque", "Bibliothèque Lourde", "Buffet 2 corps", "Buffet bas"],
            7 => ["Chaine Hi-Fi / Home cinema", "Enceinte HI/FI", "Ordinateur", "Petite imprimante", "Photocopieur bureau", "TV"],
            8 => ["Aspirateur", "Cave à vin", "Climatiseur", "Congélateur", "Cuisinière", "Four", "Four micro-onde", "Frigo Américain", "Hotte"],
            9 => ["Barbecue", "Brouette", "Caisse à outils", "Chaise longue", "Chaise longue", "Chaise PVC/extérieur"],
            10 => ["Arbre à chats", "Babyfoot", "Balancelle", "Banc/appareil musculation", "Billard", "Canne à pêche", "Flipper", "Guitare"],
            11 => ["Bac de rangement (50 x 60 x 40 cm maximum)", "Coffre / Malle / Cantine", "Pack 10 bouteilles", "Penderie 50cm linéaire", "Poubelle"],
            12 => ["Chauffeuse", "Lit 1 place", "Lit 2 places", "Lit bébé", "Lit Mezzanine"]
        ];

        $categories = $manager->getRepository(Category::class)->findAll();

        foreach ($categories as $categoryKey => $category) {
            foreach ($objects[$categoryKey] as $objectName) {
                $object = new Object();
                $object->setName($objectName);
                $object->setCategory($category);
                $manager->persist($object);
            }
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}