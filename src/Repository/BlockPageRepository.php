<?php

namespace App\Repository;

use App\Entity\BlockPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlockPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlockPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlockPage[]    findAll()
 * @method BlockPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlockPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlockPage::class);
    }

    public function getAllBlockByPage($slug)
    {
        return $this->createQueryBuilder('B')
            ->leftJoin('B.page',' P')
            ->where('B.page = P')
            ->andWhere('P.slug = :page_selected')
            ->andWhere('B.publier = 1')
            ->setParameter('page_selected', $slug)
            ->orderBy('B.position', 'ASC')
            ->getQuery()
            ->getResult();
    }
    

    // /**
    //  * @return BlockPage[] Returns an array of BlockPage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlockPage
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
