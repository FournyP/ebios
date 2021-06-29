<?php

namespace App\Repository;

use App\Entity\ProjectParameters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectParameters|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectParameters|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectParameters[]    findAll()
 * @method ProjectParameters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectParametersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectParameters::class);
    }

    // /**
    //  * @return ProjectParameters[] Returns an array of ProjectParameters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjectParameters
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
