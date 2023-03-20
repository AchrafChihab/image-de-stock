<?php

namespace App\Repository;

use App\Entity\UserFournisseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserFournisseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFournisseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFournisseur[]    findAll()
 * @method UserFournisseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFournisseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFournisseur::class);
    }

    // /**
    //  * @return UserFournisseur[] Returns an array of UserFournisseur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserFournisseur
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
