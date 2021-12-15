<?php

namespace App\Repository;

use App\Entity\Apitest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apitest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apitest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apitest[]    findAll()
 * @method Apitest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApitestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apitest::class);
    }

    // /**
    //  * @return Apitest[] Returns an array of Apitest objects
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

    /*
    public function findOneBySomeField($value): ?Apitest
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
