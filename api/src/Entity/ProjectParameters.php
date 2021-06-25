<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectParametersRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ProjectParametersRepository::class)
 */
#[ApiResource()]
class ProjectParameters
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $workshopsDefined = [];

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="projectParameters", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkshopsDefined(): ?array
    {
        return $this->workshopsDefined;
    }

    public function setWorkshopsDefined(array $workshopsDefined): self
    {
        $this->workshopsDefined = $workshopsDefined;

        return $this;
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
}
