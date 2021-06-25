<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\ActionRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 */
#[ApiResource()]
class Action
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
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=ColumnAction::class, inversedBy="actions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $columnAction;

    /**
     * @ORM\ManyToMany(targetEntity=Action::class, inversedBy="followingActions")
     */
    private $antecedentAction;

    /**
     * @ORM\ManyToMany(targetEntity=Action::class, mappedBy="antecedentAction")
     */
    private $followingActions;

    public function __construct()
    {
        $this->antecedentAction = new ArrayCollection();
        $this->followingActions = new ArrayCollection();
    }

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

    public function getColumnAction(): ?ColumnAction
    {
        return $this->columnAction;
    }

    public function setColumnAction(?ColumnAction $columnAction): self
    {
        $this->columnAction = $columnAction;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAntecedentAction(): Collection
    {
        return $this->antecedentAction;
    }

    public function addAntecedentAction(self $antecedentAction): self
    {
        if (!$this->antecedentAction->contains($antecedentAction)) {
            $this->antecedentAction[] = $antecedentAction;
        }

        return $this;
    }

    public function removeAntecedentAction(self $antecedentAction): self
    {
        $this->antecedentAction->removeElement($antecedentAction);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFollowingActions(): Collection
    {
        return $this->followingActions;
    }

    public function addFollowingAction(self $followingAction): self
    {
        if (!$this->followingActions->contains($followingAction)) {
            $this->followingActions[] = $followingAction;
            $followingAction->addAntecedentAction($this);
        }

        return $this;
    }

    public function removeFollowingAction(self $followingAction): self
    {
        if ($this->followingActions->removeElement($followingAction)) {
            $followingAction->removeAntecedentAction($this);
        }

        return $this;
    }
}
