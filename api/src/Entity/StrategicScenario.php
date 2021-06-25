<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StrategicScenarioRepository;

/**
 * @ORM\Entity(repositoryClass=StrategicScenarioRepository::class)
 */
class StrategicScenario
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
     * @ORM\Column(type="text")
     */
    private $strategy;

    /**
     * @ORM\Column(type="smallint")
     */
    private $severity;

    /**
     * @ORM\ManyToOne(targetEntity=Risk::class, inversedBy="strategicScenarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $risk;

    /**
     * @ORM\ManyToOne(targetEntity=Workshop3::class, inversedBy="strategicScenarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workshop3;

    /**
     * @ORM\OneToOne(targetEntity=OperationalScenario::class, mappedBy="strategicScenario", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
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

    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    public function setStrategy(string $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function getSeverity(): ?int
    {
        return $this->severity;
    }

    public function setSeverity(int $severity): self
    {
        $this->severity = $severity;

        return $this;
    }

    public function getRisk(): ?Risk
    {
        return $this->risk;
    }

    public function setRisk(?Risk $risk): self
    {
        $this->risk = $risk;

        return $this;
    }

    public function getWorkshop3(): ?Workshop3
    {
        return $this->workshop3;
    }

    public function setWorkshop3(?Workshop3 $workshop3): self
    {
        $this->workshop3 = $workshop3;

        return $this;
    }

    public function getOperationalScenario(): ?OperationalScenario
    {
        return $this->operationalScenario;
    }

    public function setOperationalScenario(OperationalScenario $operationalScenario): self
    {
        // set the owning side of the relation if necessary
        if ($operationalScenario->getStrategicScenario() !== $this) {
            $operationalScenario->setStrategicScenario($this);
        }

        $this->operationalScenario = $operationalScenario;

        return $this;
    }
}
