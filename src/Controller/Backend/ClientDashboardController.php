<?php

namespace App\Controller\Backend;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\{
    Article,
    History,
};


/**
 * @Route("/clientdashboard")
 */
class ClientDashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="client_home")
     */
    public function index(): Response
    { 
        
        $em                     = $this->getDoctrine()->getManager();  
        $listreference          = $em->getRepository(Article::class)->getAllGroupByReferenceForClient($this->getUser()->getClient()->getId());  
        $listproduitsparnserie  = $em->getRepository(Article::class)->getAllGroupByReferenceNserieForClient($this->getUser()->getClient()->getId());     
        $listproduitsparmagasin = $em->getRepository(Article::class)->getAllGroupByReferenceMagasinForClient($this->getUser()->getClient()->getId());     

        return $this->render('Backend/client/clientdashboard.html.twig',[
            'produits'=>$listreference,
            'nserie'=>$listproduitsparnserie,
            'magasin'=>$listproduitsparmagasin,
        
        ]); 
                  
    }

        /**
     * @Route("/list-article-par-magasin", name="client_home_listproduitsparmagasin")
     */
    public function listproduitsparmagasin(): Response
    {        
        $em                 = $this->getDoctrine()->getManager();      
        $listproduitsparmagasin     = $em->getRepository(Article::class)->getAllGroupByReferenceMagasinForAdmin();     

        return $this->render('Backend/client/listproduitsparmagasin.html.twig',[ 
            'magasin'=>$listproduitsparmagasin,
        ]);
         
    }

    /**
     * @Route("/liste-article-par-nserie", name="client_home_listproduitsparnserie")
     */
    public function listproduitsparnserie(): Response
    {        
        $em                 = $this->getDoctrine()->getManager();    
        $listproduitsparnserie     = $em->getRepository(Article::class)->getAllGroupByReferenceNserieForAdmin();     
        
        return $this->render('Backend/client/referencenserie.html.twig',[ 
            'nserie'=>$listproduitsparnserie, 
        
        ]);
         
    }

        /**
     * @Route("/detail/reference/{reference}", name="detail_reference_client")
     */
    public function detail_reference($reference): Response
    {        
        $em                 = $this->getDoctrine()->getManager();   
        $listproduits      = $em->getRepository(Article::class)->getAllByReferenceForClient($reference,$this->getUser()->getClient()->getId());  
        return $this->render('Backend/client/detailsclient.html.twig',[
            'reference'=>$reference, 
            'produits'=>$listproduits, 
        
        ]);
         
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard Client');
    }
 
    
    public function configureMenuItems(): iterable
    {
        $em                 = $this->getDoctrine()->getManager(); 
        $last_update      = $em->getRepository(History::class)->find(1)->getUpdatedAt()->format('Y-m-d');
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'), 
            MenuItem::subMenu('Liste du regroupement', 'fa fa-cogs')->setSubItems([ 
                MenuItem::linkToRoute('Liste Produits par Nserie', 'fa fa-home','client_home_listproduitsparnserie'),
                MenuItem::linkToRoute('Liste Produits par Magasin', 'fa fa-home','client_home_listproduitsparmagasin'),
    
            ]),    
            
            MenuItem::section('Derniere mise à jour à ----'.$last_update),
        ];
    }
    
}
