<?php

namespace App\Repository;

use App\Entity\ArticleApi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleApi|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleApi|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleApi[]    findAll()
 * @method ArticleApi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleApiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleApi::class);
    }

    // /**
    //  * @return ArticleApi[] Returns an array of ArticleApi objects
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
    public function findOneBySomeField($value): ?ArticleApi
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
