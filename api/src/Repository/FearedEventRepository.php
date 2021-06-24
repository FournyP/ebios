<?php

namespace App\Repository;

use App\Entity\FearedEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FearedEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method FearedEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method FearedEvent[]    findAll()
 * @method FearedEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FearedEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FearedEvent::class);
    }

    // /**
    //  * @return FearedEvent[] Returns an array of FearedEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FearedEvent
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
