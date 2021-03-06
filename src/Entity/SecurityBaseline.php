<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\SecurityBaselineRepository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ORM\Entity(repositoryClass=SecurityBaselineRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:SecurityBaseline']],
    denormalizationContext: ['groups' => ['write:SecurityBaseline']]
),
ApiFilter(SearchFilter::class, properties: ['workshop1' => "exact"])]
class SecurityBaseline
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:Workshop1", "read:SecurityBaseline", "read:Gap"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:SecurityBaseline", "write:SecurityBaseline"])]
    private $referenceStandardType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:SecurityBaseline", "write:SecurityBaseline"])]
    private $referenceStandardName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:SecurityBaseline", "write:SecurityBaseline"])]
    private $implementationStatus;

    /**
     * @ORM\ManyToOne(targetEntity=Workshop1::class, inversedBy="securityBaselines")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:SecurityBaseline", "write:SecurityBaseline"])]
    private $workshop1;

    /**
     * @ORM\OneToMany(targetEntity=Gap::class, mappedBy="securityBaseline", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:SecurityBaseline"])]
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
