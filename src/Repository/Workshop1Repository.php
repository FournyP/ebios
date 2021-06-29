<?php

namespace App\Repository;

use App\Entity\Workshop1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Workshop1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Workshop1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Workshop1[]    findAll()
 * @method Workshop1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Workshop1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Workshop1::class);
    }

    // /**
    //  * @return Workshop1[] Returns an array of Workshop1 objects
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
    public function findOneBySomeField($value): ?Workshop1
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
