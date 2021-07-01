<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\StakeHolderCategoryRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=StakeHolderCategoryRepository::class)
 */
#[ApiResource()]
class StakeHolderCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:Workshop3"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Workshop3::class, inversedBy="stakeHolderCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workshop3;

    /**
     * @ORM\OneToMany(targetEntity=StakeHolder::class, mappedBy="stakeHolderCategory", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $stakeHolders;

    public function __construct()
    {
        $this->stakeHolders = new ArrayCollection();
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

    public function getWorkshop3(): ?Workshop3
    {
        return $this->workshop3;
    }

    public function setWorkshop3(?Workshop3 $workshop3): self
    {
        $this->workshop3 = $workshop3;

        return $this;
    }

    /**
     * @return Collection|StakeHolder[]
     */
    public function getStakeHolders(): Collection
    {
        return $this->stakeHolders;
    }

    public function addStakeHolder(StakeHolder $stakeHolder): self
    {
        if (!$this->stakeHolders->contains($stakeHolder)) {
            $this->stakeHolders[] = $stakeHolder;
            $stakeHolder->setStakeHolderCategory($this);
        }

        return $this;
    }

    public function removeStakeHolder(StakeHolder $stakeHolder): self
    {
        if ($this->stakeHolders->removeElement($stakeHolder)) {
            // set the owning side to null (unless already changed)
            if ($stakeHolder->getStakeHolderCategory() === $this) {
                $stakeHolder->setStakeHolderCategory(null);
            }
        }

        return $this;
    }
}
