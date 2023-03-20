<?php

namespace App\Repository;

use App\Entity\Dentiste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dentiste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dentiste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dentiste[]    findAll()
 * @method Dentiste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DentisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dentiste::class);
    }

    // /**
    //  * @return Dentiste[] Returns an array of Dentiste objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dentiste
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
