<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\MeasureRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=MeasureRepository::class)
 */
#[ApiResource()]
class Measure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:OperationalScenario", "read:Workshop5"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $deadline;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="smallint")
     */
    private $complexity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $difficulty;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $manager;

    /**
     * @ORM\ManyToOne(targetEntity=Workshop5::class, inversedBy="measures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workshop5;

    /**
     * @ORM\ManyToMany(targetEntity=OperationalScenario::class, inversedBy="measures")
     */
    private $operationalScenario;

    public function __construct()
    {
        $this->operationalScenario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDeadline(): ?\DateInterval
    {
        return $this->deadline;
    }

    public function setDeadline(\DateInterval $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getComplexity(): ?int
    {
        return $this->complexity;
    }

    public function setComplexity(int $complexity): self
    {
        $this->complexity = $complexity;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

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

    public function getWorkshop5(): ?Workshop5
    {
        return $this->workshop5;
    }

    public function setWorkshop5(?Workshop5 $workshop5): self
    {
        $this->workshop5 = $workshop5;

        return $this;
    }

    /**
     * @return Collection|OperationalScenario[]
     */
    public function getOperationalScenario(): Collection
    {
        return $this->operationalScenario;
    }

    public function addOperationalScenario(OperationalScenario $operationalScenario): self
    {
        if (!$this->operationalScenario->contains($operationalScenario)) {
            $this->operationalScenario[] = $operationalScenario;
        }

        return $this;
    }

    public function removeOperationalScenario(OperationalScenario $operationalScenario): self
    {
        $this->operationalScenario->removeElement($operationalScenario);

        return $this;
    }
}
