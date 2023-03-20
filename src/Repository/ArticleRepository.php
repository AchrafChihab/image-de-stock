<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // public function findAllActiveByCp($cp)
    // {   
    //     return $this->createQueryBuilder('a')
    //         ->leftJoin('a.magasins', 'm') 
    //         ->select('a.reference','a.designation','a.nserie','a.nlot','sum(a.qte) as qte ','m.nom')
    //         ->groupBy('a.reference') 
    //         ->getQuery()
    //         ->getResult();
    // }
    public function getAllGroupByReferenceMagasin($value)
    {
        return $this->createQueryBuilder('a') 
        ->leftJoin('a.magasin', 'm')       
        ->leftJoin('a.fournisseur', 'f')
        ->select('a.reference','m.nom','a.nlot','a.nserie','a.designation','sum(a.qte) as qte')    
        ->where('a.fournisseur = :id')
        ->setParameter('id', $value)     
        ->groupBy('a.reference','a.nserie','a.designation','m.nom','a.nlot')
        ->getQuery()
        ->getResult()
        ; 
    }
    public function getAllGroupByReferenceMagasinForAdmin()
    {
        return $this->createQueryBuilder('a') 
        ->leftJoin('a.magasin', 'm')       
        ->leftJoin('a.fournisseur', 'f')
        ->select('a.reference','m.nom','f.nom as fournisseurnom','a.nlot','a.nserie','a.designation','sum(a.qte) as qte')      
        ->groupBy('a.reference','a.nserie','f.nom','a.designation','m.nom','a.nlot')
        ->getQuery()
        ->getResult()
        ; 
    }
    public function getAllGroupByReferenceMagasinForClient()
    {
        return $this->createQueryBuilder('a') 
        ->leftJoin('a.magasin', 'm')       
        ->select('a.reference','a.designation','m.nom','sum(a.qte) as qte')
        ->groupBy('a.reference','m.id','a.designation')
        ->getQuery()
        ->getResult()
        ; 
    }
    public function getAllGroupByReferenceNserie($value)
    {
        return $this->createQueryBuilder('a')  
        ->LeftJoin('a.fournisseur','c')
        ->LeftJoin('a.magasin','m')
        ->select('a.reference','m.nom','a.nlot','a.nserie','a.designation','sum(a.qte) as qte') 
        ->where('c.id = :id')
        ->setParameter('id', $value)   
        ->groupBy('a.reference','a.nserie','a.designation','m.nom','a.nlot')
        ->getQuery()
        ->getResult()
        ;  
              
    }
    public function getAllGroupByReferenceNserieForAdmin()
    {
        return $this->createQueryBuilder('a') 
        ->LeftJoin('a.fournisseur','c')
        ->LeftJoin('a.magasin','m')
        ->select('a.reference','m.nom','a.nlot','a.nserie','a.designation','sum(a.qte) as qte')    
        ->groupBy('a.reference','a.nserie','a.designation','m.nom','a.nlot')
        ->getQuery()
        ->getResult()
        ;  
              
    }
    public function getAllGroupByReferenceNserieForClient($value)
    {
        return $this->createQueryBuilder('a') 
        ->LeftJoin('a.clients','c')
        ->LeftJoin('a.magasin','m')
        ->select('a.reference','m.nom','a.nlot','a.nserie','a.designation','sum(a.qte) as qte')        
        ->where('c.id = :id ')
        ->setParameter('id', $value)
        ->groupBy('a.reference','a.nserie','a.designation','m.nom','a.nlot')
        ->getQuery()
        ->getResult()
        ;
              
    }
    public function getAllGroupByReference($value)
    {
        return $this->createQueryBuilder('a')  
        ->LeftJoin('a.fournisseur','c')
        ->select('a.reference','a.designation','sum(a.qte) as qte')
        ->where('c.id = :id')
        ->setParameter('id', $value)
        ->groupBy('a.reference','a.designation')
        ->getQuery()
        ->getResult()
        ;         
    }
    public function getAllGroupByReferenceForAdmin()
    {
        return $this->createQueryBuilder('a')  
        ->LeftJoin('a.fournisseur','c')
        ->select('a.reference','a.designation','c.nom','sum(a.qte) as qte') 
        ->groupBy('a.reference','a.designation','c.nom')
        ->getQuery()
        ->getResult()
        ;        
    }

    public function getAllGroupByReferenceForClient($value)
    {
        return $this->createQueryBuilder('a')  
        ->LeftJoin('a.clients','c')
        ->select('a.reference','a.designation','c.nom as nom','sum(a.qte) as qte')
        ->where('c.id = :id ')
        ->setParameter('id', $value)
        ->groupBy('a.reference','a.designation')
        ->getQuery()
        ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
 
    public function getAllByReference($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.reference = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
 
    public function getAllByReferenceForClient($value , $id)
    {
        return $this->createQueryBuilder('a')
            ->LeftJoin('a.clients','c')        
            ->where('c.id = :id ')
            ->andWhere('a.reference = :val')
            ->setParameter('id', $id)
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getAllGroupByReferenceByclient($value)
    {
        return $this->createQueryBuilder('a')  
        ->andWhere('a.clients = :val')
        ->setParameter('val', $value)
        ->getQuery()
        ->getResult()
    ; 
    }

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
