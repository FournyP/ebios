<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SupportingAssetRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=SupportingAssetRepository::class)
 */
#[ApiResource()]
class SupportingAsset
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:BusinessAsset"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $manager;

    /**
     * @ORM\ManyToOne(targetEntity=BusinessAsset::class, inversedBy="supportingAssets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $businessAsset;

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
