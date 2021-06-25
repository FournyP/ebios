<?php

namespace App\Repository;

use App\Entity\Workshop4;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Workshop4|null find($id, $lockMode = null, $lockVersion = null)
 * @method Workshop4|null findOneBy(array $criteria, array $orderBy = null)
 * @method Workshop4[]    findAll()
 * @method Workshop4[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Workshop4Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Workshop4::class);
    }

    // /**
    //  * @return Workshop4[] Returns an array of Workshop4 objects
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
    public function findOneBySomeField($value): ?Workshop4
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
