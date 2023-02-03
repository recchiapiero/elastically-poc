<?php

namespace App\Controller;

use App\Interactors\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product', methods: ['GET', 'POST'])]
    public function index(SearchService $searchService): Response
    {
        $products = $searchService->search('Games');

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
