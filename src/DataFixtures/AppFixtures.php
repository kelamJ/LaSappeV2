<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $cat1 = new Categorie();
        $cat1->setNom('Adidas')
            ->setDescription('Vêtements de la marque Adidas');
        $manager->persist($cat1);

        $cat2 = new Categorie();
        $cat2->setNom('Nike')
            ->setDescription('Vêtements de la marque Nike');
        $manager->persist($cat2);

        $cat3 = new Categorie();
        $cat3->setNom('New Balance')
            ->setDescription('Vêtements de la marque New Balance');
        $manager->persist($cat3);

        $cat4 = new Categorie();
        $cat4->setNom('The North Face')
            ->setDescription('Vêtements de la marque The North Face');
        $manager->persist($cat4);

        $cat5 = new Categorie();
        $cat5->setNom('Pull & Bear')
            ->setDescription('Vêtements de la marque Pull & Bear');
        $manager->persist($cat5);

        $cat6 = new Categorie();
        $cat6->setNom('Calvin Klein')
            ->setDescription('Vêtements de la marque Calvin Klein');
        $manager->persist($cat6);
        $manager->flush();
    }
}
