<?php

namespace App\Repository;

use App\Entity\StakeHolderCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StakeHolderCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method StakeHolderCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method StakeHolderCategory[]    findAll()
 * @method StakeHolderCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StakeHolderCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StakeHolderCategory::class);
    }

    // /**
    //  * @return StakeHolderCategory[] Returns an array of StakeHolderCategory objects
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
    public function findOneBySomeField($value): ?StakeHolderCategory
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
