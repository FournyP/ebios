<?php

namespace App\Repository;

use App\Entity\BusinessAsset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusinessAsset|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessAsset|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessAsset[]    findAll()
 * @method BusinessAsset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessAssetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessAsset::class);
    }

    // /**
    //  * @return BusinessAsset[] Returns an array of BusinessAsset objects
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
    public function findOneBySomeField($value): ?BusinessAsset
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
