<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\SecurityBaselineRepository;

/**
 * @ORM\Entity(repositoryClass=SecurityBaselineRepository::class)
 */
class SecurityBaseline
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
    private $referenceStandardType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceStandardName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $implementationStatus;

    /**
     * @ORM\ManyToOne(targetEntity=Workshop1::class, inversedBy="securityBaselines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workshop1;

    /**
     * @ORM\OneToMany(targetEntity=Gap::class, mappedBy="securityBaseline", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $gaps;

    public function __construct()
    {
        $this->gaps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceStandardType(): ?string
    {
        return $this->referenceStandardType;
    }

    public function setReferenceStandardType(string $referenceStandardType): self
    {
        $this->referenceStandardType = $referenceStandardType;

        return $this;
    }

    public function getReferenceStandardName(): ?string
    {
        return $this->referenceStandardName;
    }

    public function setReferenceStandardName(string $referenceStandardName): self
    {
        $this->referenceStandardName = $referenceStandardName;

        return $this;
    }

    public function getImplementationStatus(): ?string
    {
        return $this->implementationStatus;
    }

    public function setImplementationStatus(string $implementationStatus): self
    {
        $this->implementationStatus = $implementationStatus;

        return $this;
    }

    public function getWorkshop1(): ?Workshop1
    {
        return $this->workshop1;
    }

    public function setWorkshop1(?Workshop1 $workshop1): self
    {
        $this->workshop1 = $workshop1;

        return $this;
    }

    /**
     * @return Collection|Gap[]
     */
    public function getGaps(): Collection
    {
        return $this->gaps;
    }

    public function addGap(Gap $gap): self
    {
        if (!$this->gaps->contains($gap)) {
            $this->gaps[] = $gap;
            $gap->setSecurityBaseline($this);
        }

        return $this;
    }

    public function removeGap(Gap $gap): self
    {
        if ($this->gaps->removeElement($gap)) {
            // set the owning side to null (unless already changed)
            if ($gap->getSecurityBaseline() === $this) {
                $gap->setSecurityBaseline(null);
            }
        }

        return $this;
    }
}
