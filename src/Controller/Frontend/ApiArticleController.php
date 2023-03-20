<?php

namespace App\Controller\Frontend;

use App\Repository\ArticleRepository;
use App\Repository\FournisseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 /**
     * @Route("/api")
     */
class ApiArticleController extends AbstractController
{
    /**
     * @Route("/", name="api_article")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->json($articleRepository->findAll(),200,[],['groups' => 'articles']);
    }


    /**
     * @Route("/addarticle", name="api_addarticle" )
    */
    public function addarticle(ArticleRepository $articleRepository,FournisseurRepository $fournisseurRepository): Response
    { 
        return $this->json($fournisseurRepository->findOneBy(array('nom' => 'fournisseur1'),array('nom' => 'ASC'),1 ,0),200,[],['groups' => 'articles']);
    }
}
