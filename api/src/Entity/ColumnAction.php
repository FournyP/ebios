<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ColumnActionRepository;
use App\Entity\OperationalScenario;

/**
 * @ORM\Entity(repositoryClass=ColumnActionRepository::class)
 */
class ColumnAction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=OperationalScenario::class, inversedBy="columnActions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $operationalScenario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOperationalScenario(): ?OperationalScenario
    {
        return $this->operationalScenario;
    }

    public function setOperationalScenario(?OperationalScenario $operationalScenario): self
    {
        $this->operationalScenario = $operationalScenario;

        return $this;
    }
}
