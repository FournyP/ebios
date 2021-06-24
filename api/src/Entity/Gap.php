<?php

namespace App\Entity;

use App\Repository\GapRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GapRepository::class)
 */
class Gap
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
    private $justification;

    /**
     * @ORM\ManyToOne(targetEntity=SecurityBaseline::class, inversedBy="gaps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $securityBaseline;

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

    public function getJustification(): ?string
    {
        return $this->justification;
    }

    public function setJustification(string $justification): self
    {
        $this->justification = $justification;

        return $this;
    }

    public function getSecurityBaseline(): ?SecurityBaseline
    {
        return $this->securityBaseline;
    }

    public function setSecurityBaseline(?SecurityBaseline $securityBaseline): self
    {
        $this->securityBaseline = $securityBaseline;

        return $this;
    }
}
