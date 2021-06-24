<?php

namespace App\Repository;

use App\Entity\SecurityBaseline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SecurityBaseline|null find($id, $lockMode = null, $lockVersion = null)
 * @method SecurityBaseline|null findOneBy(array $criteria, array $orderBy = null)
 * @method SecurityBaseline[]    findAll()
 * @method SecurityBaseline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecurityBaselineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SecurityBaseline::class);
    }

    // /**
    //  * @return SecurityBaseline[] Returns an array of SecurityBaseline objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SecurityBaseline
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
