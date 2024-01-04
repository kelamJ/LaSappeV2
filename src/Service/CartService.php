<?php

namespace App\Service;


use App\Entity\ArticlePanier;
use Doctrine\ORM\EntityManagerInterface;

class CartService
{
private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addToCart($produit, $quantite)
    {
        $articlePanier = $this->entityManager->getRepository(ArticlePanier::class)->findOneBy(['produit' => $produit]);

        if (!$articlePanier) {
            // Le produit n'est pas encore dans le panier, donc nous le créons
            $articlePanier = new CartItem();
            $articlePanier->setProduit($produit);
            $articlePanier->setQuantite($quantite);
            $articlePanier->setPrixUnitaire($produit->getPrix()); // Assurez-vous d'ajuster cette partie en fonction de votre entité Produit
        } else {
            // Le produit est déjà dans le panier, nous mettons à jour la quantité
            $articlePanier->setQuantite($articlePanier->getQuantite() + $quantite);
        }

        // Mettez à jour le total en fonction de la quantité et du prix unitaire
        $articlePanier->setTotal($articlePanier->getQuantite() * $articlePanier->getPrixUnitaire());

        // Enregistrez l'entité CartItem dans la base de données
        $this->entityManager->persist($articlePanier);
        $this->entityManager->flush();
    }

    public function removeFromCart(ArticlePanier $articlePanier)
    {
        // Supprimez l'entité CartItem de la base de données
        $this->entityManager->remove($articlePanier);
        $this->entityManager->flush();
    }

    public function getCartItems()
    {
        return $this->entityManager->getRepository(ArticlePanier::class)->findAll();
    }

    public function getTotal()
    {
        $articlesPanier = $this->getCartItems();
        $total = 0;

        foreach ($articlesPanier as $cartItem) {
            $total += $cartItem->getTotal();
        }

        return $total;
    }
}