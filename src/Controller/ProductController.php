<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    #[Route('/fetch', name: 'fetch')]
    public function fetchproduct(ManagerRegistry $mr): Response
    {
        $products=$mr->getRepository(Product::class);
        $result=$products->findAll();
        //dd($result);
        return $this->render('product/list.html.twig', [
            'p' => $result,
        ]);
    }
}
