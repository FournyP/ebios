<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Workshop3Repository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=Workshop3Repository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:Workshop3']],
    denormalizationContext: ['groups' => ['write:Workshop3']]
)]
class Workshop3
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:Project", "read:Workshop3", "read:StakeHolderCategory", "read:StrategicScenario"])]
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="workshop3", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:Workshop3", "write:Workshop3"])]
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=StakeHolderCategory::class, mappedBy="workshop3", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Workshop3"])]
    private $stakeHolderCategories;

    /**
     * @ORM\OneToMany(targetEntity=StrategicScenario::class, mappedBy="workshop3", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Workshop3"])]
    private $strategicScenarios;

    public function __construct()
    {
        $this->stakeHolderCategories = new ArrayCollection();
        $this->strategicScenarios = new ArrayCollection();
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

    /**
     * @return Collection|StrategicScenario[]
     */
    public function getStrategicScenarios(): Collection
    {
        return $this->strategicScenarios;
    }

    public function addStrategicScenario(StrategicScenario $strategicScenario): self
    {
        if (!$this->strategicScenarios->contains($strategicScenario)) {
            $this->strategicScenarios[] = $strategicScenario;
            $strategicScenario->setWorkshop3($this);
        }

        return $this;
    }

    public function removeStrategicScenario(StrategicScenario $strategicScenario): self
    {
        if ($this->strategicScenarios->removeElement($strategicScenario)) {
            // set the owning side to null (unless already changed)
            if ($strategicScenario->getWorkshop3() === $this) {
                $strategicScenario->setWorkshop3(null);
            }
        }

        return $this;
    }
}
