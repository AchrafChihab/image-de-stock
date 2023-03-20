<?php

namespace App\Controller\Backend;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Form\ImporfileType;
use App\Entity\{
    User,  
    Article,  
    Magasin,  
    Client,
    Fournisseur,
    Userclient,
    UserFournisseur,
    History
};


use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/sitewebadmin")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="admin_home")
     */
    public function index(): Response
    {        
        $em                 = $this->getDoctrine()->getManager();   
        $listproduits      = $em->getRepository(Article::class)->getAllGroupByReferenceForAdmin();  
         
        $form = $this->createForm(ImporfileType::class);

     

        return $this->render('Backend/admin/dashboard.html.twig', [
            'form' => $form->createView(),
            'produits'=>$listproduits, 
        ]);
 
         
    }

    /**
     * @Route("/upload-excel", name="xlsx" )
     * @param Request $request
     * @throws \Exception
     */
    public function xslx(Request $request,SluggerInterface $slugger)
    {


        $form = $this->createForm(ImporfileType::class);
        $form->handleRequest($request);
        
        $brochureFile = $form->get('brochure')->getData();
        $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
        // this is needed to safely include the file name as part of the URL
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

     
        if ($form->isSubmitted() && $form->isValid()) {
           
            /** @var UploadedFile $brochureFile */
            
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('file_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                // $product->setBrochureFilename($newFilename);
            }
        } 
        $spreadsheet = IOFactory::load( $this->getParameter('file_directory').'/' . $newFilename); // Here we are able to read from the excel file 
        $row = $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line 
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array

        $entityManager = $this->getDoctrine()->getManager(); 
    foreach ($sheetData as $Row) 
        { 

            $reference = $Row['A']; // store the first_name on each iteration 
            $designation = $Row['B']; // store the last_name on each iteration
            $nserie= $Row['C'];     // store the email on each iteration
            $nlot = $Row['D'];   // store the phone on each iteration
            $qte = $Row['E'];   // store the phone on each iteration
            // $fournisseur_a = 1;    // store the phone on each iteration
            // $magasin = $Row['G'];   // store the phone on each iteration

            $article = $entityManager->getRepository(Article::class); 
 
                $article = new Article(); 
                $article->setReference($reference);           
                $article->setDesignation($designation);
                $article->setNserie($nserie);
                $article->setNlot($nlot);
                $article->setQte($qte);
                // $article->setFournisseur($fournisseur_a);
                // $article->setMagasin($magasin);
 
                $entityManager->persist($article); 
                $entityManager->flush(); 
                 // here Doctrine checks all the fields of all fetched data and make a transaction to the database.
         
        }     

        return $this->redirectToRoute('admin_home');

    }


    /**
     * @Route("/list-article-par-magasin", name="admin_home_listproduitsparmagasin")
     */
    public function listproduitsparmagasin(): Response
    {        
        $em                 = $this->getDoctrine()->getManager();      
        $listproduitsparmagasin     = $em->getRepository(Article::class)->getAllGroupByReferenceMagasinForAdmin();     

        return $this->render('Backend/admin/listproduitsparmagasin.html.twig',[ 
            'magasin'=>$listproduitsparmagasin,
        ]);
         
    }
    /**
     * @Route("/liste-article-par-nserie", name="admin_home_listproduitsparnserie")
     */
    public function listproduitsparnserie(): Response
    {        
        $em                 = $this->getDoctrine()->getManager();    
        $listproduitsparnserie     = $em->getRepository(Article::class)->getAllGroupByReferenceNserieForAdmin();     
        
        return $this->render('Backend/admin/referencenserie.html.twig',[ 
            'nserie'=>$listproduitsparnserie, 
        
        ]);
         
    }
    /**
     * @Route("/detail/reference/{reference}", name="detail_reference_admin")
     */
    public function detail_reference($reference): Response
    {
        $em                 = $this->getDoctrine()->getManager();   
        $listproduits      = $em->getRepository(Article::class)->getAllByReference($reference);  
        return $this->render('Backend/admin/detailsadmin.html.twig',[
            'reference'=>$reference, 
            'produits'=>$listproduits,
        ]);
         
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SLS Partner Dasboard Admin');
    }
 
    
    public function configureMenuItems(): iterable
    {
        $em                 = $this->getDoctrine()->getManager(); 
        $last_update      = $em->getRepository(History::class)->find(1)->getUpdatedAt()->format('Y-m-d');
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),   
             MenuItem::subMenu('Liste du regroupement', 'fa fa-cogs')->setSubItems([ 
                MenuItem::linkToRoute('Liste Produits par Nserie', 'fa fa-home','admin_home_listproduitsparnserie'),
                MenuItem::linkToRoute('Liste Produits par Magasin', 'fa fa-home','admin_home_listproduitsparmagasin'),
                
            ]),  
             MenuItem::subMenu('Liste des utilisateur', 'fa fa-cogs')->setSubItems([ 
                 MenuItem::linkToCrud('Clients', 'fa fa-tags', Client::class),   
                MenuItem::linkToCrud('User Client', 'fa fa-tags', Userclient::class),
                MenuItem::linkToCrud('Fournisseur', 'fa fa-tags', Fournisseur::class),   
                MenuItem::linkToCrud('User Fournisseur', 'fa fa-tags', UserFournisseur::class),
            ]),  
            MenuItem::subMenu('Liste Article', 'fa fa-tasks')->setSubItems([ 
                MenuItem::linkToCrud('Article', 'fa fa-tags', Article::class), 
                MenuItem::linkToCrud('Magasin', 'fa fa-tags', Magasin::class), 
            ]), 
            MenuItem::section('Derniere mise à jour à ----'.$last_update),
            
        ];
 

    }
    
}
