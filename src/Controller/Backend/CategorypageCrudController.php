<?php

namespace App\Controller\Backend;

use App\Entity\Categorypage;

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


class CategorypageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorypage::class;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return Assets::new()->addCssFile('assets/lib/admin/admineyse.css');
        //return $assets;
    }
 

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    public function configureFields(string $pageName): iterable
    {
 
        switch ($pageName) {
            case Crud::PAGE_INDEX:
                return [
                    ImageField::new('image')
                        ->setBasePath(
                            $this->getParameter('app.path.page_image')
                        ),
                    TextField::new('titre'),
                    NumberField::new('position'),
                ];

            default:
                break;
        }
        return [
            FormField::addPanel('Informations'),
            TextField::new('titre'),
            SlugField::new('slug')->setTargetFieldName('slug'),
            NumberField::new('position'),
            TextareaField::new('imageFile', 'Switcher')->setFormType(VichImageType::class),

            FormField::addPanel('Contenu'),
            CKEditorField::new('contenu'),
            
            FormField::addPanel('Seo'),
            TextField::new('seo_titre', 'Seo titre'),
            TextareaField::new('seo_keywords', 'Seo keywords'),
            TextareaField::new('seo_description', 'Seo description'),

        ];
    }


    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
