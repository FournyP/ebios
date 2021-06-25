<?php

namespace App\Entity;

use App\Repository\StakeHolderCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StakeHolderCategoryRepository::class)
 */
class StakeHolderCategory
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Workshop3::class, inversedBy="stakeHolderCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workshop3;

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
}
