<?php

namespace App\DataPersister;

use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Organization;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class OrganizationDataPersister implements ContextAwareDataPersisterInterface 
{
    private Security $security;

    private EntityManagerInterface $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Organization;
    }

    public function persist($data, array $context = [])
    {
        $data->addUser($this->security->getUser());

        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}