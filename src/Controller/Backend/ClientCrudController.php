<?php

namespace App\Controller\Backend;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;

use EasyCorp\Bundle\EasyAdminBundle\Field\{
    TextField,
    BooleanField, 
    TextareaField,
    ImageField,
    FormField, 
    AssociationField,
    NumberField,
    SlugField
};

use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use App\Form\Field\CKEditorField;
use App\Form\Field\ImagevichField;



class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
 
        switch ($pageName) {
            case Crud::PAGE_INDEX:
                return [ 
                    TextField::new('nom'),   
                ];

            default:
                break;
        }
        return [ 

            FormField::addPanel('Ajouter client'),
            TextField::new('nom'),          

        ];
    }
}
