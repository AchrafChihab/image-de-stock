<?php



namespace App\Controller\Backend;



use App\Entity\BlockPage;



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

    ChoiceField,

    ColorField

};



use Vich\UploaderBundle\Form\Type\VichFileType;

use Vich\UploaderBundle\Form\Type\VichImageType;



use FOS\CKEditorBundle\Form\Type\CKEditorType;

use App\Form\Field\CKEditorField;

use App\Form\Field\ImagevichField;







 

class BlockPageCrudController extends AbstractCrudController

{

    public static function getEntityFqcn(): string

    {

        return BlockPage::class;

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

                    //ImagevichField::new('image')->setCustomOption('entity', getEntity()),

                   

                    ImageField::new('image')

                        ->setBasePath(

                            $this->getParameter('app.path.blockpage_image')

                        ),

                    AssociationField::new('page'),

                    TextField::new('titre'), 

                    BooleanField::new('publier'),

                   // BooleanField::new('isTop'),

                    NumberField::new('position'),

                ];



            default:

                break;

        }

 

        return [

            FormField::addPanel('Informations'),

            ChoiceField::new('styleBlock', 'Style block')->setChoices([

                                                                        'Image en droit'  => 'Image en droit',

                                                                        'Image en gauche' => 'Image en gauche',

                                                                        'Sans image'      => 'Sans image',

                                                                    ]),

            AssociationField::new('page'),

            TextField::new('titre'),

            TextField::new('subTitre', 'Sous-titre'),

            CKEditorField::new('contenu', 'Contenu'),

            

            FormField::addPanel('Config'),

           // ChoiceField::new('direction', 'Direction')->setChoices(['Droit' => 0, 'Gauche' => 1]),

            ChoiceField::new('colorTitre', 'Couleur titre')->setChoices(['Bleu' => 'Bleu', 'Vert' => 'Vert']),

            ColorField::new('background', 'Background block'),

           // BooleanField::new('isTop', 'Block top'),

            BooleanField::new('isCercle', 'Image cercle'),

            BooleanField::new('publier'),

            NumberField::new('position'),

            

            FormField::addPanel('Medias'),

            TextareaField::new('imageFile', 'Image')->setFormType(VichImageType::class),

            TextareaField::new('iconFile', 'Icon')->setFormType(VichImageType::class),

           // TextareaField::new('fichierFile', 'Fichier')->setFormType(VichFileType::class),

        ];

    }

}

