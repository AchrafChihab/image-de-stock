<?php

namespace App\Repository;

use App\Entity\Userclient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Userclient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Userclient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Userclient[]    findAll()
 * @method Userclient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserclientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Userclient::class);
    }

    // /**
    //  * @return Userclient[] Returns an array of Userclient objects
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
    public function findOneBySomeField($value): ?Userclient
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
