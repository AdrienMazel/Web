<?php

namespace App\Repository;

use App\Entity\Auteurlistapi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Auteurlistapi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auteurlistapi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auteurlistapi[]    findAll()
 * @method Auteurlistapi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurlistapiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auteurlistapi::class);
    }

    // /**
    //  * @return Auteurlistapi[] Returns an array of Auteurlistapi objects
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
    public function findOneBySomeField($value): ?Auteurlistapi
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
