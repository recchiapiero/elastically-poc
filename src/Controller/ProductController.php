<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Interactors\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product', methods: ['GET', 'POST'])]
    public function index(Request $request, SearchService $searchService): Response
    {
        $form = $this->createForm(SearchType::class);
        $products = [];

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $products = $searchService->search($data['search']);
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }
}
