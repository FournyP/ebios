<?php

namespace App\Repository;

use App\Entity\Workshop2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Workshop2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Workshop2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Workshop2[]    findAll()
 * @method Workshop2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Workshop2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Workshop2::class);
    }

    // /**
    //  * @return Workshop2[] Returns an array of Workshop2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Workshop2
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
