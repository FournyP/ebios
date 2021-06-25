<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OperationalScenarioRepository;

/**
 * @ORM\Entity(repositoryClass=OperationalScenarioRepository::class)
 */
class OperationalScenario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $overallLikelihood;

    /**
     * @ORM\OneToOne(targetEntity=StrategicScenario::class, inversedBy="operationalScenario", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $strategicScenario;

    /**
     * @ORM\ManyToOne(targetEntity=Workshop4::class, inversedBy="operationalScenarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workshop4;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOverallLikelihood(): ?int
    {
        return $this->overallLikelihood;
    }

    public function setOverallLikelihood(int $overallLikelihood): self
    {
        $this->overallLikelihood = $overallLikelihood;

        return $this;
    }

    public function getStrategicScenario(): ?StrategicScenario
    {
        return $this->strategicScenario;
    }

    public function setStrategicScenario(StrategicScenario $strategicScenario): self
    {
        $this->strategicScenario = $strategicScenario;

        return $this;
    }

    public function getWorkshop4(): ?Workshop4
    {
        return $this->workshop4;
    }

    public function setWorkshop4(?Workshop4 $workshop4): self
    {
        $this->workshop4 = $workshop4;

        return $this;
    }
}
