<?php

namespace App\Controller\Backend;

use App\Entity\Magasin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MagasinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Magasin::class;
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
