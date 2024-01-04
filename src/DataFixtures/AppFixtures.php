<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;
    public function __construct(private readonly UserPasswordHasherInterface $passwordEncoder)
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new Utilisateur();
        $admin->setUtilNom('Malek')
            ->setEmail('admin@mail.fr')
            ->setPassword($this->passwordEncoder->hashPassword($admin, 'admin'))
            ->setUtilType('Admin')
            ->setRoles(['ROLE_ADMIN'])
            ->setUtilAdresse($this->faker->streetAddress)
            ->setUtilReference(uniqid())
            ->setUtilCoef(0);
        $manager->persist($admin);

        for ($usr = 0; $usr < 5; ++$usr) {
            $user = new Utilisateur();
            $user->setUtilNom('Malek')
                ->setEmail('admin@mail.fr')
                ->setPassword($this->passwordEncoder->hashPassword($user, 'password'))
                ->setUtilType($this->faker->randomElement(['Particulier', 'Professionnel']))
                ->setRoles(['ROLE_USER'])
                ->setUtilAdresse($this->faker->streetAddress)
                ->setUtilReference(uniqid())
                ->setUtilCoef(0);
            $manager->persist($user);
        }

        $fournisseur1 = new Fournisseur();
        $fournisseur1->setFouNom('Adidas')
            ->setFouAdresse('Roissy-en-France');
        $manager->persist($fournisseur1);

        $fournisseur2 = new Fournisseur();
        $fournisseur2->setFouNom('Nike')
            ->setFouAdresse('Paris 8');
        $manager->persist($fournisseur2);

        $fournisseur3 = new Fournisseur();
        $fournisseur3->setFouNom('New Balance')
            ->setFouAdresse('Paris 1');
        $manager->persist($fournisseur3);

        $fournisseur4 = new Fournisseur();
        $fournisseur4->setFouNom('Calvin Klein')
            ->setFouAdresse('Amiens');
        $manager->persist($fournisseur4);

        $fournisseur5 = new Fournisseur();
        $fournisseur5->setFouNom('The North Face')
            ->setFouAdresse('Les Clayes Sous Bois');
        $manager->persist($fournisseur5);

        $fournisseur6 = new Fournisseur();
        $fournisseur6->setFouNom('Pull&Bear')
            ->setFouAdresse('Paris 9');
        $manager->persist($fournisseur6);

        $cat1 = new Categorie();
        $cat1->setNom('Adidas')
            ->setImage('adidas.jpg')
            ->setDescription('Vêtements de la marque Adidas');
        $manager->persist($cat1);

        $cat2 = new Categorie();
        $cat2->setNom('Nike')
            ->setImage('nike.jpg')
            ->setDescription('Vêtements de la marque Nike');
        $manager->persist($cat2);

        $cat3 = new Categorie();
        $cat3->setNom('New Balance')
            ->setImage('newB.jpg')
            ->setDescription('Vêtements de la marque New Balance');
        $manager->persist($cat3);

        $cat4 = new Categorie();
        $cat4->setNom('The North Face')
            ->setImage('tnf.jpg')
            ->setDescription('Vêtements de la marque The North Face');
        $manager->persist($cat4);

        $cat5 = new Categorie();
        $cat5->setNom('Pull & Bear')
            ->setImage('petb.jpg')
            ->setDescription('Vêtements de la marque Pull & Bear');
        $manager->persist($cat5);

        $cat6 = new Categorie();
        $cat6->setNom('Calvin Klein')
            ->setImage('ck.jpg')
            ->setDescription('Vêtements de la marque Calvin Klein');
        $manager->persist($cat6);

        $pro1 = new Produit();
        $pro1
            ->setNom('T-Shirt Adidas')
            ->setFournisseur($fournisseur1)
            ->setCategorie($cat1)
            ->setDescription('T-shirt a col rond avec différentes palette de couleur')
            ->setStock(5)
            ->setPrix(15)
            ->setImage("tshirtA.png")
            ->setIsActive(true);
        $manager->persist($pro1);

        $pro2 = new Produit();
        $pro2->setNom('T-Shirt Nike')
            ->setFournisseur($fournisseur2)
            ->setCategorie($cat2)
            ->setDescription('T-shirt a col rond avec différentes palette de couleur')
            ->setStock(5)
            ->setPrix(20)
            ->setImage("tshirtN.png")
            ->setIsActive(true);
        $manager->persist($pro2);

        $pro3 = new Produit();
        $pro3->setNom('T-Shirt New Balance')
            ->setFournisseur($fournisseur3)
            ->setCategorie($cat3)
            ->setDescription('T-shirt a col rond avec différentes palette de couleur')
            ->setStock(5)
            ->setPrix(10)
            ->setImage("tshirtNb.png")
            ->setIsActive(true);
        $manager->persist($pro3);

        $pro4 = new Produit();
        $pro4->setNom('T-Shirt The North Face')
            ->setFournisseur($fournisseur5)
            ->setCategorie($cat4)
            ->setDescription('T-shirt a col rond avec différentes palette de couleur')
            ->setStock(5)
            ->setPrix(25)
            ->setImage("tshirtTnf.png")
            ->setIsActive(true);
        $manager->persist($pro4);

        $pro5 = new Produit();
        $pro5->setNom('Pantalon Pull & Bear')
            ->setFournisseur($fournisseur6)
            ->setCategorie($cat5)
            ->setDescription('Pantalon en jean large résistant')
            ->setStock(5)
            ->setPrix(40)
            ->setImage("pantPb.png")
            ->setIsActive(true);
        $manager->persist($pro5);

        $pro6 = new Produit();
        $pro6->setNom('Veste Calvin Klein')
            ->setFournisseur($fournisseur4)
            ->setCategorie($cat6)
            ->setDescription('Veste en jean entièrement imprimée de logos')
            ->setStock(5)
            ->setPrix(80)
            ->setImage("vesteCK.png")
            ->setIsActive(true);
        $manager->persist($pro6);

        $pro7 = new Produit();
        $pro7->setNom('Bas de survêtement Nike')
            ->setFournisseur($fournisseur2)
            ->setCategorie($cat2)
            ->setDescription('Bas de survêtement en coton comfortable')
            ->setStock(5)
            ->setPrix(50)
            ->setImage("basN.png")
            ->setIsActive(true);
        $manager->persist($pro7);

        $pro8 = new Produit();
        $pro8->setNom('Bas de survêtement Adidas')
            ->setFournisseur($fournisseur1)
            ->setCategorie($cat1)
            ->setDescription('Bas de survêtement en coton comfortable')
            ->setStock(10)
            ->setPrix(40)
            ->setImage("basA.png")
            ->setIsActive(true);
        $manager->persist($pro8);

        $pro9 = new Produit();
        $pro9->setNom('Veste New Balance')
            ->setFournisseur($fournisseur3)
            ->setCategorie($cat3)
            ->setDescription('Veste polaire en coton')
            ->setStock(5)
            ->setPrix(70)
            ->setImage("vesteNb.png")
            ->setIsActive(true);
        $manager->persist($pro9);

        $pro10 = new Produit();
        $pro10->setNom('Boxers Calvin Klein ')
            ->setFournisseur($fournisseur4)
            ->setCategorie($cat6)
            ->setDescription('Boxers pour homme en coton x3')
            ->setStock(100)
            ->setPrix(11)
            ->setImage("boxerL.png")
            ->setIsActive(true);
        $manager->persist($pro10);

        $manager->flush();
    }
}
