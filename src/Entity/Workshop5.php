<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Workshop5Repository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ORM\Entity(repositoryClass=Workshop5Repository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:Workshop5']],
    denormalizationContext: ['groups' => ['write:Workshop5']]
),
ApiFilter(SearchFilter::class, properties: ['project' => "exact"])]
class Workshop5
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:Project", "read:Workshop5", "read:Measure"])]
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="workshop5", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:Workshop5", "write:Workshop5"])]
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=Measure::class, mappedBy="workshop5", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Workshop5"])]
    private $measures;

    public function __construct()
    {
        $this->measures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection|Measure[]
     */
    public function getMeasures(): Collection
    {
        return $this->measures;
    }

    public function addMeasure(Measure $measure): self
    {
        if (!$this->measures->contains($measure)) {
            $this->measures[] = $measure;
            $measure->setWorkshop5($this);
        }

        return $this;
    }

    public function removeMeasure(Measure $measure): self
    {
        if ($this->measures->removeElement($measure)) {
            // set the owning side to null (unless already changed)
            if ($measure->getWorkshop5() === $this) {
                $measure->setWorkshop5(null);
            }
        }

        return $this;
    }
}
