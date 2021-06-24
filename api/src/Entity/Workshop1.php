<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Workshop1Repository;

/**
 * @ORM\Entity(repositoryClass=Workshop1Repository::class)
 */
class Workshop1
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
    private $workshopContributors = [];

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="workshop1", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=BusinessAsset::class, mappedBy="workshop1", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $businessAssets;

    public function __construct()
    {
        $this->businessAssets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkshopContributors(): ?array
    {
        return $this->workshopContributors;
    }

    public function setWorkshopContributors(array $workshopContributors): self
    {
        $this->workshopContributors = $workshopContributors;

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
     * @return Collection|BusinessAsset[]
     */
    public function getBusinessAssets(): Collection
    {
        return $this->businessAssets;
    }

    public function addBusinessAsset(BusinessAsset $businessAsset): self
    {
        if (!$this->businessAssets->contains($businessAsset)) {
            $this->businessAssets[] = $businessAsset;
            $businessAsset->setWorkshop1($this);
        }

        return $this;
    }

    public function removeBusinessAsset(BusinessAsset $businessAsset): self
    {
        if ($this->businessAssets->removeElement($businessAsset)) {
            // set the owning side to null (unless already changed)
            if ($businessAsset->getWorkshop1() === $this) {
                $businessAsset->setWorkshop1(null);
            }
        }

        return $this;
    }
}
