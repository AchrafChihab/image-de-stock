<?php

namespace App\Controller\Backend;

use App\Entity\UserFournisseur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
 
use Symfony\Component\Form\Extension\Core\Type\PasswordType; 
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use EasyCorp\Bundle\EasyAdminBundle\Field\{
    EmailField,
    ArrayField,
    TextField, 
    BooleanField,
    AssociationField
};


class UserFournisseurCrudController extends AbstractCrudController
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public static function getEntityFqcn(): string
    {
        return UserFournisseur::class;
    }
 
    public function configureFields(string $pageName): iterable
    { 
        switch ($pageName) {
            case Crud::PAGE_INDEX:

                return [
                    TextField::new('nom'),
                    TextField::new('prenom'),
                    EmailField::new('email'),
                    BooleanField::new('enabled'),
                    BooleanField::new('roles'),
                ];
                break;
            case Crud::PAGE_DETAIL:

                return [
                    TextField::new('nom'),
                    TextField::new('prenom'),
                    EmailField::new('email'),
                    BooleanField::new('enabled'),
                ];
                break;
            
            default: 
                break;
        }
        return [ 
            AssociationField::new('fournisseur'), 
            TextField::new('nom'), 
            TextField::new('prenom'),
            EmailField::new('email'),
            TextField::new('password')->setFormType(PasswordType::class),
            BooleanField::new('enabled'),
            ArrayField::new('roles'),
        ];
    }

    

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $encodedPassword = $this->passwordEncoder->encodePassword(
            $entityInstance,
            $entityInstance->getPassword()
        );
        $entityInstance->setPassword($encodedPassword);

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $encodedPassword = $this->passwordEncoder->encodePassword(
            $entityInstance,
            $entityInstance->getPassword()
        );
        $entityInstance->setPassword($encodedPassword);

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

}
