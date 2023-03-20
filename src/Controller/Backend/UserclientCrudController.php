<?php

namespace App\Controller\Backend;

use App\Entity\Userclient;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; 
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;  
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use EasyCorp\Bundle\EasyAdminBundle\Field\{
    EmailField,
    ArrayField,
    TextField,
    AssociationField,
    Field,
    ChoiceField,
    BooleanField
};


class UserclientCrudController extends AbstractCrudController
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getEntityFqcn(): string
    {
        return Userclient::class;
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
                    AssociationField::new('client'),
                ];
                break;
            case Crud::PAGE_DETAIL:

                return [
                    TextField::new('nom'),
                    TextField::new('prenom'),
                    EmailField::new('email'),
                    BooleanField::new('enabled'),
                    AssociationField::new('client'),
                ];
                break;
            
            default: 
                break;
        }
        return [                      
            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('email'),
            TextField::new('password')->setFormType(PasswordType::class),
            ChoiceField::new('roles', 'Roles')
            ->allowMultipleChoices()
            ->autocomplete()
            ->setChoices([  
                'Admin' => 'ROLE_ADMIN',
                'Client' => 'ROLE_CLIENT',
                'Fournisseur' => 'ROLE_FOURNISSEUR']
            ),
            AssociationField::new('client'),
            BooleanField::new('enabled'),
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
