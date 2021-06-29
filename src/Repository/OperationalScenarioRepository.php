<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\OperationalScenario;

/**
 * @method OperationalScenario|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationalScenario|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationalScenario[]    findAll()
 * @method OperationalScenario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationalScenarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationalScenario::class);
    }
}
