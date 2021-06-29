<?php

namespace App\Repository;

use App\Entity\Workshop5;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Workshop5|null find($id, $lockMode = null, $lockVersion = null)
 * @method Workshop5|null findOneBy(array $criteria, array $orderBy = null)
 * @method Workshop5[]    findAll()
 * @method Workshop5[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Workshop5Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Workshop5::class);
    }

    // /**
    //  * @return Workshop5[] Returns an array of Workshop5 objects
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
    public function findOneBySomeField($value): ?Workshop5
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
