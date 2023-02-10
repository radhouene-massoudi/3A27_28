<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class TwigController extends AbstractController
{
    #[Route('/twig', name: 'app_twig')]
    public function index(): Response
    {
        return $this->render('twig/index.html.twig', [
            'controller_name' => 'TwigController',
        ]);
    }

    #[Route('/test/{msg}', name: 'twig')]
    public function twig($msg): Response
    {
        //la liste des students
        return $this->render('3A2728/test.html.twig',[
            't'=>$msg
        ]);
    }
    #[Route('/showmsg', name: 'showmsg')]
    public function showmsg(): Response
    {
        $name="MOHAMED";
        $formations = array(
            array('ref' => 'esprit', 'Titre' => 'Formation Symfony
            4','Description'=>'formation pratique',
            'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
            'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
            'Description'=>'formation
            theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
            'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
            'Description'=>'formation
            theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
            'nb_participants'=>12));
            
        return $this->render('3A2728/show.html.twig',
        [
            'key'=>$name,
            'f'=>$formations
        ]);
    }

    #[Route('/detail/{t}', name: 'test123')]
    public function detail($t): Response
    {
        return $this->render('3A2728/detail.html.twig', [
            'm'=>$t
        ]);
    }
}
