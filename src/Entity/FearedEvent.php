<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FearedEventRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=FearedEventRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:FearedEvent']],
    denormalizationContext: ['groups' => ['write:FearedEvent']]
)]
class FearedEvent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:BusinessAsset", "read:FearedEvent"])]
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(["read:FearedEvent", "write:FearedEvent"])]
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(["read:FearedEvent", "write:FearedEvent"])]
    private $impact;

    /**
     * @ORM\Column(type="smallint")
     */
    #[Groups(["read:FearedEvent", "write:FearedEvent"])]
    private $severity;

    /**
     * @ORM\ManyToOne(targetEntity=BusinessAsset::class, inversedBy="fearedEvents")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:FearedEvent", "write:FearedEvent"])]
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
