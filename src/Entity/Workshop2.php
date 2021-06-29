<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Workshop2Repository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=Workshop2Repository::class)
 */
#[ApiResource()]
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

    /**
     * @ORM\OneToMany(targetEntity=Risk::class, mappedBy="workshop2", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $risks;

    public function __construct()
    {
        $this->risks = new ArrayCollection();
    }

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

    /**
     * @return Collection|Risk[]
     */
    public function getRisks(): Collection
    {
        return $this->risks;
    }

    public function addRisk(Risk $risk): self
    {
        if (!$this->risks->contains($risk)) {
            $this->risks[] = $risk;
            $risk->setWorkshop2($this);
        }

        return $this;
    }

    public function removeRisk(Risk $risk): self
    {
        if ($this->risks->removeElement($risk)) {
            // set the owning side to null (unless already changed)
            if ($risk->getWorkshop2() === $this) {
                $risk->setWorkshop2(null);
            }
        }

        return $this;
    }
}
