<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig');
    }

    #[Route('/firstmethode', name: 'firstmethode')]
    public function firstMethode(): Response
    {
    
       return new Response('bonjour 3A27/28');
    }
    #[Route('/secondmethode', name: 'secondmethode')]
    public function secondMethode(): Response
    {
       return new Response('<h1>bonjour 3A27/28 </h1>');
    }

    #[Route('/json', name: 'json')]
    public function jsonMethode(): Response
    {
       return new JsonResponse('bonjour');
    }
    #[Route('/bnj/{t}', name: 'bnj')]
    public function bnjMethode($t): Response
    {
       return new Response('bonjour'.$t);
    }
}
