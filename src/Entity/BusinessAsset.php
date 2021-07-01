<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\BusinessAssetRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=BusinessAssetRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:BusinessAsset']],
    denormalizationContext: ['groups' => ['write:BusinessAsset']]
)]
class BusinessAsset
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:Workshop1", "read:BusinessAsset"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:BusinessAsset", "write:BusinessAsset"])]
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:BusinessAsset", "write:BusinessAsset"])]
    private $value;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    #[Groups(["read:BusinessAsset", "write:BusinessAsset"])]
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:BusinessAsset", "write:BusinessAsset"])]
    private $manager;

    /**
     * @ORM\ManyToOne(targetEntity=Workshop1::class, inversedBy="businessAssets")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:BusinessAsset", "write:BusinessAsset"])]
    private $workshop1;

    /**
     * @ORM\OneToMany(targetEntity=SupportingAsset::class, mappedBy="businessAsset", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:BusinessAsset"])]
    private $supportingAssets;

    /**
     * @ORM\OneToMany(targetEntity=FearedEvent::class, mappedBy="businessAsset", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:BusinessAsset"])]
    private $fearedEvents;

    public function __construct()
    {
        $this->supportingAssets = new ArrayCollection();
        $this->fearedEvents = new ArrayCollection();
    }

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getManager(): ?string
    {
        return $this->manager;
    }

    public function setManager(string $manager): self
    {
        $this->manager = $manager;

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
     * @return Collection|SupportingAsset[]
     */
    public function getSupportingAssets(): Collection
    {
        return $this->supportingAssets;
    }

    public function addSupportingAsset(SupportingAsset $supportingAsset): self
    {
        if (!$this->supportingAssets->contains($supportingAsset)) {
            $this->supportingAssets[] = $supportingAsset;
            $supportingAsset->setBusinessAsset($this);
        }

        return $this;
    }

    public function removeSupportingAsset(SupportingAsset $supportingAsset): self
    {
        if ($this->supportingAssets->removeElement($supportingAsset)) {
            // set the owning side to null (unless already changed)
            if ($supportingAsset->getBusinessAsset() === $this) {
                $supportingAsset->setBusinessAsset(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FearedEvent[]
     */
    public function getFearedEvents(): Collection
    {
        return $this->fearedEvents;
    }

    public function addFearedEvent(FearedEvent $fearedEvent): self
    {
        if (!$this->fearedEvents->contains($fearedEvent)) {
            $this->fearedEvents[] = $fearedEvent;
            $fearedEvent->setBusinessAsset($this);
        }

        return $this;
    }

    public function removeFearedEvent(FearedEvent $fearedEvent): self
    {
        if ($this->fearedEvents->removeElement($fearedEvent)) {
            // set the owning side to null (unless already changed)
            if ($fearedEvent->getBusinessAsset() === $this) {
                $fearedEvent->setBusinessAsset(null);
            }
        }

        return $this;
    }
}
