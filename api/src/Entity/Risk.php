<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\RiskRepository;

/**
 * @ORM\Entity(repositoryClass=RiskRepository::class)
 */
class Risk
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
    private $source;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $goal;

    /**
     * @ORM\Column(type="json")
     */
    private $evaluation = [];

    /**
     * @ORM\ManyToOne(targetEntity=Workshop2::class, inversedBy="risks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workshop2;

    /**
     * @ORM\OneToMany(targetEntity=StrategicScenario::class, mappedBy="risk", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $strategicScenarios;

    public function __construct()
    {
        $this->strategicScenarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getEvaluation(): ?array
    {
        return $this->evaluation;
    }

    public function setEvaluation(array $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getWorkshop2(): ?Workshop2
    {
        return $this->workshop2;
    }

    public function setWorkshop2(?Workshop2 $workshop2): self
    {
        $this->workshop2 = $workshop2;

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
            $strategicScenario->setRisk($this);
        }

        return $this;
    }

    public function removeStrategicScenario(StrategicScenario $strategicScenario): self
    {
        if ($this->strategicScenarios->removeElement($strategicScenario)) {
            // set the owning side to null (unless already changed)
            if ($strategicScenario->getRisk() === $this) {
                $strategicScenario->setRisk(null);
            }
        }

        return $this;
    }
}
