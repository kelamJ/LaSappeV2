<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(CartService $cartService): Response
    {
        $cartItems = $cartService->getCartItems();
        $total = $cartService->getTotal();

        return $this->render('panier/index.html.twig', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }
}
