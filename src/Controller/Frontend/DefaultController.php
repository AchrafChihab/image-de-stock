<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Routing\Annotation\Route;  

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('app_login');
 
    }
 
    /**
     * @Route("/_header", name="_header")
     */
    public function _header(): Response
    {
        $em             = $this->getDoctrine()->getManager(); 
        return $this->render('Frontend/_header.html.twig');
    }
    
    /**
     * @Route("/_footer", name="_footer")
     */
    public function _footer(): Response
    {
        return $this->render('Frontend/_footer.html.twig');
    }

  
   
}
