<?php

namespace App\Entity;

use App\Repository\FearedEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FearedEventRepository::class)
 */
class FearedEvent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $impact;

    /**
     * @ORM\Column(type="smallint")
     */
    private $severity;

    /**
     * @ORM\ManyToOne(targetEntity=BusinessAsset::class, inversedBy="fearedEvents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $businessAsset;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImpact(): ?string
    {
        return $this->impact;
    }

    public function setImpact(string $impact): self
    {
        $this->impact = $impact;

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

    public function getBusinessAsset(): ?BusinessAsset
    {
        return $this->businessAsset;
    }

    public function setBusinessAsset(?BusinessAsset $businessAsset): self
    {
        $this->businessAsset = $businessAsset;

        return $this;
    }
}
