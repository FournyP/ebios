<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Workshop3Repository;

/**
 * @ORM\Entity(repositoryClass=Workshop3Repository::class)
 */
class Workshop3
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="workshop3", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=StakeHolderCategory::class, mappedBy="workshop3", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $stakeHolderCategories;

    public function __construct()
    {
        $this->stakeHolderCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|StakeHolderCategory[]
     */
    public function getStakeHolderCategories(): Collection
    {
        return $this->stakeHolderCategories;
    }

    public function addStakeHolderCategory(StakeHolderCategory $stakeHolderCategory): self
    {
        if (!$this->stakeHolderCategories->contains($stakeHolderCategory)) {
            $this->stakeHolderCategories[] = $stakeHolderCategory;
            $stakeHolderCategory->setWorkshop3($this);
        }

        return $this;
    }

    public function removeStakeHolderCategory(StakeHolderCategory $stakeHolderCategory): self
    {
        if ($this->stakeHolderCategories->removeElement($stakeHolderCategory)) {
            // set the owning side to null (unless already changed)
            if ($stakeHolderCategory->getWorkshop3() === $this) {
                $stakeHolderCategory->setWorkshop3(null);
            }
        }

        return $this;
    }
}
