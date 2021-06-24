<?php

namespace App\Entity;

use App\Repository\Workshop2Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Workshop2Repository::class)
 */
class Workshop2
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $evaluationBase = [];

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="workshop2", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvaluationBase(): ?array
    {
        return $this->evaluationBase;
    }

    public function setEvaluationBase(array $evaluationBase): self
    {
        $this->evaluationBase = $evaluationBase;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
