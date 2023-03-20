<?php

namespace App\Controller\Backend;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\{ 
    Article,  
    History
    
};


/**
 * @Route("/fournisseurdashboard")
 */
class FournisseurDashbordController extends AbstractDashboardController
{
    /**
     * @Route("/", name="fournisseur_home")
     */
    public function index(): Response
    {
        $em                 = $this->getDoctrine()->getManager();   
        $listproduits      = $em->getRepository(Article::class)->getAllGroupByReference($this->getUser()->getFournisseur()->getId());  
          
        return $this->render('Backend/fournisseur/fournisseurdashboard.html.twig',[
            'produits'=>$listproduits, 
        
        ]); 
         
    }
    
    /**
     * @Route("/list-article-par-magasin-fournisseur", name="fournisseur_home_listproduitsparmagasin")
     */
    public function listproduitsparmagasin(): Response
    {        
        $em                 = $this->getDoctrine()->getManager();      
        $listproduitsparmagasin     = $em->getRepository(Article::class)->getAllGroupByReferenceMagasin($this->getUser()->getFournisseur()->getId());     

        return $this->render('Backend/fournisseur/listproduitsparmagasin.html.twig',[ 
            'magasin'=>$listproduitsparmagasin,
        ]);
         
    }
    
    /**
     * @Route("/liste-article-par-nserie-fournisseur", name="fournisseur_home_listproduitsparnserie")
     */
    public function listproduitsparnserie(): Response
    {        
        $em                 = $this->getDoctrine()->getManager();    
        $listproduitsparnserie     = $em->getRepository(Article::class)->getAllGroupByReferenceNserie($this->getUser()->getFournisseur()->getId());     
        
        return $this->render('Backend/fournisseur/referencenserie.html.twig',[ 
            'nserie'=>$listproduitsparnserie, 
        
        ]);
         
    }

    /**
     * @Route("/detail/reference/{reference}", name="detail_reference_fournisseur")
     */
    public function detail_reference($reference): Response
    {        
        $em                 = $this->getDoctrine()->getManager();   
        $listproduits      = $em->getRepository(Article::class)->getAllByReference($reference);  
        return $this->render('Backend/fournisseur/details.html.twig',[
            'reference'=>$reference, 
            'produits'=>$listproduits, 
        
        ]);
         
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Fournisseur Dashborad');
    }

 
    
    public function configureMenuItems(): iterable
    {
        $em                 = $this->getDoctrine()->getManager(); 
        $last_update      = $em->getRepository(History::class)->find(1)->getUpdatedAt()->format('Y-m-d');
        
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),   
            MenuItem::subMenu('Liste du regroupement', 'fa fa-cogs')->setSubItems([ 
                MenuItem::linkToRoute('Liste Produits par Nserie', 'fa fa-home','fournisseur_home_listproduitsparnserie'),
                MenuItem::linkToRoute('Liste Produits par Magasin', 'fa fa-home','fournisseur_home_listproduitsparmagasin'),
    
            ]),  
 
            MenuItem::subMenu('Liste Article', 'fa fa-tasks')->setSubItems([ 
                MenuItem::linkToCrud('Article', 'fa fa-tags', Article::class), 
                // MenuItem::linkToCrud('Magasin', 'fa fa-tags', Magasin::class), 
            ]),
            MenuItem::section('Derniere mise à jour à ----'.$last_update),

        ];
    }



 
    
}
