<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectRepository;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organization;

    /**
     * @ORM\OneToOne(targetEntity=ProjectParameters::class, mappedBy="project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $projectParameters;

    /**
     * @ORM\OneToOne(targetEntity=Workshop1::class, mappedBy="project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $workshop1;

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

    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    public function setOrganization(?Organization $organization): self
    {
        $this->organization = $organization;

        return $this;
    }

    public function getProjectParameters(): ?ProjectParameters
    {
        return $this->projectParameters;
    }

    public function setProjectParameters(ProjectParameters $projectParameters): self
    {
        // set the owning side of the relation if necessary
        if ($projectParameters->getProject() !== $this) {
            $projectParameters->setProject($this);
        }

        $this->projectParameters = $projectParameters;

        return $this;
    }

    public function getWorkshop1(): ?Workshop1
    {
        return $this->workshop1;
    }

    public function setWorkshop1(Workshop1 $workshop1): self
    {
        // set the owning side of the relation if necessary
        if ($workshop1->getProject() !== $this) {
            $workshop1->setProject($this);
        }

        $this->workshop1 = $workshop1;

        return $this;
    }
}
