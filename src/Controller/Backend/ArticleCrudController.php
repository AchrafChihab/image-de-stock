<?php

namespace App\Controller\Backend;

use App\Entity\Article;
use App\Entity\Magasin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions; 

use EasyCorp\Bundle\EasyAdminBundle\Field\{ 
    TextField,
    BooleanField, 
    TextareaField,
    ImageField,
    AssociationField,
    FormField,  
    NumberField,
    CollectionFileField
}; 
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType; 

class ArticleCrudController extends AbstractCrudController
{  
  

    public static function getEntityFqcn(): string
    {
        return Article::class;
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('reference')
            ->add('magasin')
            ->add('clients') 
        ;
    }

    
    public function configureActions(Actions $actions): Actions
    {
        return $actions 
            ->setPermission(Action::NEW, 'ROLE_ADMIN')
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
            ->setPermission(Action::EDIT, 'ROLE_ADMIN') 
        ;
    }
 
    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_INDEX:
                return [    
                    TextField::new('reference'),
                    AssociationField::new('fournisseur'),  
                    TextField::new('designation'),  
                    TextField::new('nserie'),  
                    TextField::new('nlot'),  
                    NumberField::new('qte'),  
                    AssociationField::new('magasin'),    
                    AssociationField::new('clients'),               
                    ImageField::new('excel')
                    ->setBasePath(
                        $this->getParameter('app.path.excel_file')
                    ),  
                ]; break;

                case Crud::PAGE_DETAIL:

                    return [
                        FormField::addPanel('Edite Article'), 
                        TextField::new('reference'),
                        TextField::new('designation'),  
                        AssociationField::new('fournisseur'),  
                        TextField::new('nserie'),  
                        TextField::new('nlot'),  
                        NumberField::new('qte'),  
                        ImageField::new('excel')
                        ->setBasePath(
                            $this->getParameter('app.path.excel_file')
                        ),  
                        AssociationField::new('magasin')->setTemplatePath('bundles/EasyAdminBundle/Field/listemagasin.html.twig'), 
                        AssociationField::new('clients')->setTemplatePath('bundles/EasyAdminBundle/Field/listeclient.html.twig'),  
                    ];
                    break;
            default:
                break;
        } 

        if (in_array('ROLE_FOURNISSEUR', $this->getUser()->getRoles())) {
            $f = $this->getUser()->getFournisseur();
        }
        return [
            
            FormField::addPanel('Information Article'), 
 
            TextField::new('reference'), 
            TextField::new('designation'),  
            AssociationField::new('fournisseur'),  
            TextField::new('nserie'),  
            TextField::new('nlot'),  
            NumberField::new('qte'),
            TextareaField::new('excelFile')->setFormType(VichFileType::class),
            AssociationField::new('magasin'), 
            AssociationField::new('clients','Liste des clients'),  
        ];
    } 
    
 


}
