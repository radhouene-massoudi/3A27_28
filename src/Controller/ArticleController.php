<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
    #[Route('/getarticle', name: 'getarticle')]
    public function getarticle(ArticleRepository $repo): Response
    {
        return $this->render('article/liste.html.twig', [
            'articles' => $repo->findAll(),
        ]);
    }
    #[Route('/remove/{id}', name: 'remove3')]
    public function remove(ManagerRegistry $mr, $id, ArticleRepository $repo): Response
    {
        $a = $repo->find($id);
        $em = $mr->getManager();
        $em->remove($a);
        $em->flush();
        //return new Response('removed');
        return $this->redirectToRoute('getarticle');
    }
    #[Route('/addarticle', name: 'addarticle')]
    public function addArticle(ManagerRegistry $mr, Request $req): Response
    {
        $a = new Article();
        //$a->setref(123456789);
        //$a->setTitre('fvfdgg');
        $f = $this->createForm(ArticleType::class, $a);
        $f->handleRequest($req);
       // dd($req);
        
        if ($f->isSubmitted()) {
            $a->setCreatedAt(new DateTimeImmutable('now'));
           // dd($a);
          $ref=$mr->getRepository(Article::class)->find($a->getref());
          //dd($ref);
          $titre=$a->getref().'@esprit.tn';
          $a->setTitre($titre);
          if($ref==null){
            $em = $mr->getManager();
            $em->persist($a);
            $em->flush();
            return $this->redirectToRoute('getarticle');
        } else{
return new Response('ref deja existe');
        }
            
        }
        return $this->renderForm('article/addarticle.html.twig', [
            'formarticle' => $f
        ]);
    }
    #[Route('/update/{id}', name: 'update')]
    public function updateArticle(ManagerRegistry $mr, Request $req,$id): Response
    {
      //  $a = new Article();
   $a=$mr->getRepository(Article::class)->find($id);
        $f = $this->createForm(ArticleType::class, $a);
        $f->handleRequest($req);
          
        if ($f->isSubmitted()) {
            //$a->setCreatedAt(new DateTimeImmutable('now'));
            $em = $mr->getManager();
            //$em->persist($a);
            $em->flush();
            return $this->redirectToRoute('getarticle');
        }
        return $this->renderForm('article/addarticle.html.twig', [
            'formarticle' => $f
        ]);
    }
    #[Route('/dql', name: 'dql')]
    public function dql(EntityManagerInterface $em)
    {
$req=$em->createQuery("select a test from App\Entity\Article a where a.titre=?1  ");
$req->setParameter('1','esprit');
$result=$req->getResult();
dd($result);
    }

    #[Route('/dqlfromrepo', name: 'dqlfromrepo')]
    public function dqlfromrepo(ArticleRepository $repo)
    {
$result=$repo->myFindALL();
dd($result);
    }
}
