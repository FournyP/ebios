<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GapRepository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ORM\Entity(repositoryClass=GapRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:Gap']],
    denormalizationContext: ['groups' => ['write:Gap']]
),
ApiFilter(SearchFilter::class, properties: ['securityBaseline' => "exact"])]
class Gap
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:SecurityBaseline", "read:Gap"])]
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(["read:Gap", "write:Gap"])]
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(["read:Gap", "write:Gap"])]
    private $justification;

    /**
     * @ORM\ManyToOne(targetEntity=SecurityBaseline::class, inversedBy="gaps")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:Gap", "write:Gap"])]
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
