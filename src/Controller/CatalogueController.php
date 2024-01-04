<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    #[Route('/catalogue', name: 'app_catalogue')]
    public function index(ProduitRepository $repo): Response
    {
        $produits = $repo->findBy([], ['id' => 'asc']);

        return $this->render('catalogue/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/ajouter-au-panier/{id}', name: 'ajouter_au_panier', methods: ['POST'])]
    public function ajouterAuPanier(Produit $produit): JsonResponse
    {
        $cartService = $this->get('app.cart_service'); // Assurez-vous que 'app.cart_service' correspond au nom de votre service CartService dans services.yaml

        // Logique pour ajouter le produit au panier
        $this->cartService->addToCart($produit, 1); // Exemple avec quantité de 1, ajustez selon vos besoins

        // Répondez avec un JSON indiquant le succès
        return new JsonResponse(['success' => true]);
    }
}
