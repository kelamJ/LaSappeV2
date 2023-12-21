<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_categorie')]
    public function index(CategorieRepository $repo): Response
    {
        $categories = $repo->findBy([], ['id' => 'asc']);

        return $this->render('accueil/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
