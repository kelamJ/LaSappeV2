<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    #[Route('/catalogue', name: 'app_catalogue')]
    public function index(ProduitRepository $repo): Response
    {
        $produits = $repo->findBy([], ['id' => 'asc']);

        return $this->render('catalogue/index.html.twig', [
            'produits' => $produits,
        ]);
    }
}
