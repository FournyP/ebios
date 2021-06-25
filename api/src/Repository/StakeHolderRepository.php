<?php

namespace App\Repository;

use App\Entity\StakeHolder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StakeHolder|null find($id, $lockMode = null, $lockVersion = null)
 * @method StakeHolder|null findOneBy(array $criteria, array $orderBy = null)
 * @method StakeHolder[]    findAll()
 * @method StakeHolder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StakeHolderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StakeHolder::class);
    }

    // /**
    //  * @return StakeHolder[] Returns an array of StakeHolder objects
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
    public function findOneBySomeField($value): ?StakeHolder
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
