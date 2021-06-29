<?php

namespace App\Repository;

use App\Entity\SupportingAsset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SupportingAsset|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupportingAsset|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupportingAsset[]    findAll()
 * @method SupportingAsset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportingAssetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupportingAsset::class);
    }

    // /**
    //  * @return SupportingAsset[] Returns an array of SupportingAsset objects
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
    public function findOneBySomeField($value): ?SupportingAsset
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
