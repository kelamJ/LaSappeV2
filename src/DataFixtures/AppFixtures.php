<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
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
        $cat6->setNom('Lacoste')
            ->setDescription('Vêtements de la marque Lacoste');
        $manager->persist($cat6);

        $pro1 = new Produit();
        $pro1->setNom('T-Shirt Adidas')
            ->setDescription('T-shirt a col rond avec différentes palette de couleur')
            ->setStock(5)
            ->setPrix(15)
            ->setImage("tshirtA.png")
            ->setIsActive(true);
        $manager->persist($pro1);

        $pro2 = new Produit();
        $pro2->setNom('T-Shirt Nike')
            ->setDescription('T-shirt a col rond avec différentes palette de couleur')
            ->setStock(5)
            ->setPrix(20)
            ->setImage("tshirtN.png")
            ->setIsActive(true);
        $manager->persist($pro2);

        $pro3 = new Produit();
        $pro3->setNom('T-Shirt New Balance')
            ->setDescription('T-shirt a col rond avec différentes palette de couleur')
            ->setStock(5)
            ->setPrix(10)
            ->setImage("tshirtNb.png")
            ->setIsActive(true);
        $manager->persist($pro3);

        $pro4 = new Produit();
        $pro4->setNom('T-Shirt The North Face')
            ->setDescription('T-shirt a col rond avec différentes palette de couleur')
            ->setStock(5)
            ->setPrix(25)
            ->setImage("tshirtTnf.png")
            ->setIsActive(true);
        $manager->persist($pro4);

        $pro5 = new Produit();
        $pro5->setNom('Pantalon Pull & Bear')
            ->setDescription('Pantalon en jean large résistant')
            ->setStock(5)
            ->setPrix(40)
            ->setImage("pantPb.png")
            ->setIsActive(true);
        $manager->persist($pro5);

        $pro6 = new Produit();
        $pro6->setNom('Veste Calvin Klein')
            ->setDescription('Veste en jean entièrement imprimée de logos')
            ->setStock(5)
            ->setPrix(80)
            ->setImage("vesteCK.png")
            ->setIsActive(true);
        $manager->persist($pro6);

        $pro7 = new Produit();
        $pro7->setNom('Bas de survêtement Nike')
            ->setDescription('Bas de survêtement en coton comfortable')
            ->setStock(5)
            ->setPrix(50)
            ->setImage("basN.png")
            ->setIsActive(true);
        $manager->persist($pro7);

        $pro8 = new Produit();
        $pro8->setNom('Bas de survêtement Adidas')
            ->setDescription('Bas de survêtement en coton comfortable')
            ->setStock(10)
            ->setPrix(40)
            ->setImage("basA.png")
            ->setIsActive(true);
        $manager->persist($pro8);

        $pro9 = new Produit();
        $pro9->setNom('Veste New Balance')
            ->setDescription('Veste polaire en coton')
            ->setStock(5)
            ->setPrix(70)
            ->setImage("vesteNb.png")
            ->setIsActive(true);
        $manager->persist($pro9);

        $pro10 = new Produit();
        $pro10->setNom('Boxers Lacoste ')
            ->setDescription('Boxers pour homme en coton x3')
            ->setStock(100)
            ->setPrix(11)
            ->setImage("boxerL.png")
            ->setIsActive(true);
        $manager->persist($pro10);

        $manager->flush();
    }
}
