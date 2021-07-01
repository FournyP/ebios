<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\ColumnActionRepository;
use App\Entity\OperationalScenario;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ColumnActionRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:ColumnAction']],
    denormalizationContext: ['groups' => ['write:ColumnAction']]
)]
class ColumnAction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:OperationalScenario", "read:ColumnAction"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:ColumnAction", "write:ColumnAction"])]
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=OperationalScenario::class, inversedBy="columnActions")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:ColumnAction", "write:ColumnAction"])]
    private $operationalScenario;

    /**
     * @ORM\OneToMany(targetEntity=Action::class, mappedBy="columnAction", orphanRemoval=true)
     */
    #[Groups(["read:ColumnAction"])]
    private $actions;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
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

    public function getOperationalScenario(): ?OperationalScenario
    {
        return $this->operationalScenario;
    }

    public function setOperationalScenario(?OperationalScenario $operationalScenario): self
    {
        $this->operationalScenario = $operationalScenario;

        return $this;
    }

    /**
     * @return Collection|Action[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->setColumnAction($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getColumnAction() === $this) {
                $action->setColumnAction(null);
            }
        }

        return $this;
    }
}
