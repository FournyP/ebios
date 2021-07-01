<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Workshop2Repository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=Workshop2Repository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:Workshop2']],
    denormalizationContext: ['groups' => ['write:Workshop2']]
)]
class Workshop2
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:Project", "read:Workshop2"])]
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    #[Groups(["read:Workshop2", "write:Workshop2"])]
    private $evaluationBase = [];

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="workshop2", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:Workshop2", "write:Workshop2"])]
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=Risk::class, mappedBy="workshop2", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Workshop2"])]
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
