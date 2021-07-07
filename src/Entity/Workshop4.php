<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Workshop4Repository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ORM\Entity(repositoryClass=Workshop4Repository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:Workshop4']],
    denormalizationContext: ['groups' => ['write:Workshop4']]
),
ApiFilter(SearchFilter::class, properties: ['project' => "exact"])]
class Workshop4
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:Project", "read:Workshop4", "read:OperationalScenario"])]
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="workshop4", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:Workshop4", "write:Workshop4"])]
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=OperationalScenario::class, mappedBy="workshop4", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Workshop4"])]
    private $operationalScenarios;

    public function __construct()
    {
        $this->operationalScenarios = new ArrayCollection();
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
     * @return Collection|OperationalScenario[]
     */
    public function getOperationalScenarios(): Collection
    {
        return $this->operationalScenarios;
    }

    public function addOperationalScenario(OperationalScenario $operationalScenario): self
    {
        if (!$this->operationalScenarios->contains($operationalScenario)) {
            $this->operationalScenarios[] = $operationalScenario;
            $operationalScenario->setWorkshop4($this);
        }

        return $this;
    }

    public function removeOperationalScenario(OperationalScenario $operationalScenario): self
    {
        if ($this->operationalScenarios->removeElement($operationalScenario)) {
            // set the owning side to null (unless already changed)
            if ($operationalScenario->getWorkshop4() === $this) {
                $operationalScenario->setWorkshop4(null);
            }
        }

        return $this;
    }
}
