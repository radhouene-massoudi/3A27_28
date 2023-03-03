<?php

namespace App\Controller;

use App\Entity\Compture;
use App\Form\ComptureType;
use App\Repository\DepartementRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    #[Route('/departement', name: 'app_departement')]
    public function index(): Response
    {
        return $this->render('departement/index.html.twig', [
            'controller_name' => 'DepartementController',
        ]);
    }
    #[Route('/fetchdep', name: 'fetchdep')]
    public function fetchdep(DepartementRepository $repo): Response
    {
        return $this->render('departement/liste.html.twig', [
            'deps' => $repo->findAll(),
        ]);
    }
    #[Route('/addcom/{iddep}', name: 'addcom')]
    public function addcom(ManagerRegistry $mr,Request $req,$iddep,DepartementRepository $repo)
    {
        $c=new Compture();
        $f=$this->createForm(ComptureType::class,$c);
        $f->handleRequest($req);
        if($f->isSubmitted()){
            $departement=$repo->find($iddep);
            $c->setDep($departement);
            $c->setRam($departement->getDomaine());
        $em=$mr->getManager();
        $em->persist($c);
        $em->flush();
            }
        return $this->render('departement/addC.html.twig', [
            'f'=>$f->createView()
        ]);
    }
}
