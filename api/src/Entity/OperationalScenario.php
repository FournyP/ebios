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
}
