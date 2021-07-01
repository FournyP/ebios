<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SecurityMeasureRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=SecurityMeasureRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:SecurityMeasure']],
    denormalizationContext: ['groups' => ['write:SecurityMeasure']]
)]
class SecurityMeasure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:StakeHolder", "read:SecurityMeasure"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:SecurityMeasure", "write:SecurityMeasure"])]
    private $strategicAttackPath;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(["read:SecurityMeasure", "write:SecurityMeasure"])]
    private $measure;

    /**
     * @ORM\Column(type="smallint")
     */
    #[Groups(["read:SecurityMeasure", "write:SecurityMeasure"])]
    private $initialThreat;

    /**
     * @ORM\Column(type="smallint")
     */
    #[Groups(["read:SecurityMeasure", "write:SecurityMeasure"])]
    private $residualThreat;

    /**
     * @ORM\ManyToOne(targetEntity=StakeHolder::class, inversedBy="securityMeasures")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:SecurityMeasure", "write:SecurityMeasure"])]
    private $stakeHolder;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrategicAttackPath(): ?string
    {
        return $this->strategicAttackPath;
    }

    public function setStrategicAttackPath(string $strategicAttackPath): self
    {
        $this->strategicAttackPath = $strategicAttackPath;

        return $this;
    }

    public function getMeasure(): ?string
    {
        return $this->measure;
    }

    public function setMeasure(string $measure): self
    {
        $this->measure = $measure;

        return $this;
    }

    public function getInitialThreat(): ?int
    {
        return $this->initialThreat;
    }

    public function setInitialThreat(int $initialThreat): self
    {
        $this->initialThreat = $initialThreat;

        return $this;
    }

    public function getResidualThreat(): ?int
    {
        return $this->residualThreat;
    }

    public function setResidualThreat(int $residualThreat): self
    {
        $this->residualThreat = $residualThreat;

        return $this;
    }

    public function getStakeHolder(): ?StakeHolder
    {
        return $this->stakeHolder;
    }

    public function setStakeHolder(?StakeHolder $stakeHolder): self
    {
        $this->stakeHolder = $stakeHolder;

        return $this;
    }
}
