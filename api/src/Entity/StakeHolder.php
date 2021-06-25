<?php

namespace App\Entity;

use App\Repository\StakeHolderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StakeHolderRepository::class)
 */
class StakeHolder
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
     * @ORM\Column(type="smallint")
     */
    private $exposure;

    /**
     * @ORM\Column(type="smallint")
     */
    private $cyberReliability;

    /**
     * @ORM\Column(type="boolean")
     */
    private $selected;

    /**
     * @ORM\ManyToOne(targetEntity=StakeHolderCategory::class, inversedBy="stakeHolders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stakeHolderCategory;

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

    public function getExposure(): ?int
    {
        return $this->exposure;
    }

    public function setExposure(int $exposure): self
    {
        $this->exposure = $exposure;

        return $this;
    }

    public function getCyberReliability(): ?int
    {
        return $this->cyberReliability;
    }

    public function setCyberReliability(int $cyberReliability): self
    {
        $this->cyberReliability = $cyberReliability;

        return $this;
    }

    public function getSelected(): ?bool
    {
        return $this->selected;
    }

    public function setSelected(bool $selected): self
    {
        $this->selected = $selected;

        return $this;
    }

    public function getStakeHolderCategory(): ?StakeHolderCategory
    {
        return $this->stakeHolderCategory;
    }

    public function setStakeHolderCategory(?StakeHolderCategory $stakeHolderCategory): self
    {
        $this->stakeHolderCategory = $stakeHolderCategory;

        return $this;
    }
}
