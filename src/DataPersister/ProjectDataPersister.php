<?php

namespace App\DataPersister;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Workshop5;
use App\Entity\Workshop4;
use App\Entity\Workshop3;
use App\Entity\Workshop2;
use App\Entity\Workshop1;
use App\Entity\Project;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class ProjectDataPersister implements ContextAwareDataPersisterInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Project;
    }

    public function persist($data, array $context = [])
    {
        $workshops = $this->createWorkshops($data);

        foreach ($workshops as $workshop) {
            $this->entityManager->persist($workshop);
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }

    private function createWorkshops(Project $project) {
        
        $workshopsToCreate = [];

        foreach ($project->getWorkshopsDefined() as $workshopDefined) {

            switch ($workshopDefined){
                case 1: 
                    $workshop = new Workshop1();
                    $project->setWorkshop1($workshop);
                    \array_push($workshopsToCreate, $workshop);
                    break;
                case 2:
                    $workshop = new Workshop2();
                    $project->setWorkshop2($workshop);
                    \array_push($workshopsToCreate, $workshop);
                    break;
                case 3:
                    $workshop = new Workshop3();
                    $project->setWorkshop3($workshop);
                    \array_push($workshopsToCreate, $workshop);
                    break;
                case 4:
                    $workshop = new Workshop4();
                    $project->setWorkshop4($workshop);
                    \array_push($workshopsToCreate, $workshop);
                    break;
                case 5:
                    $workshop = new Workshop5();
                    $project->setWorkshop5($workshop);
                    \array_push($workshopsToCreate, $workshop);
                    break;
            }
        }

        return $workshopsToCreate;
    }
}
