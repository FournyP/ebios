<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:Project']],
    denormalizationContext: ['groups' => ['write:Project']],
    itemOperations: ['get', 'delete']
)]
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:Project", "read:ProjectParameters"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:Project", "write:Project"])]
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:Project", "write:Project"])]
    private $organization;

    /**
     * @ORM\OneToOne(targetEntity=ProjectParameters::class, mappedBy="project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Project"])]
    private $projectParameters;

    /**
     * @ORM\OneToOne(targetEntity=Workshop1::class, mappedBy="project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Project"])]
    private $workshop1;

    /**
     * @ORM\OneToOne(targetEntity=Workshop2::class, mappedBy="project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Project"])]
    private $workshop2;

    /**
     * @ORM\OneToOne(targetEntity=Workshop3::class, mappedBy="project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Project"])]
    private $workshop3;

    /**
     * @ORM\OneToOne(targetEntity=Workshop4::class, mappedBy="project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Project"])]
    private $workshop4;

    /**
     * @ORM\OneToOne(targetEntity=Workshop5::class, mappedBy="project", cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Project"])]
    private $workshop5;

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

    public function getWorkshop2(): ?Workshop2
    {
        return $this->workshop2;
    }

    public function setWorkshop2(Workshop2 $workshop2): self
    {
        // set the owning side of the relation if necessary
        if ($workshop2->getProject() !== $this) {
            $workshop2->setProject($this);
        }

        $this->workshop2 = $workshop2;

        return $this;
    }

    public function getWorkshop3(): ?Workshop3
    {
        return $this->workshop3;
    }

    public function setWorkshop3(Workshop3 $workshop3): self
    {
        // set the owning side of the relation if necessary
        if ($workshop3->getProject() !== $this) {
            $workshop3->setProject($this);
        }

        $this->workshop3 = $workshop3;

        return $this;
    }

    public function getWorkshop4(): ?Workshop4
    {
        return $this->workshop4;
    }

    public function setWorkshop4(Workshop4 $workshop4): self
    {
        // set the owning side of the relation if necessary
        if ($workshop4->getProject() !== $this) {
            $workshop4->setProject($this);
        }

        $this->workshop4 = $workshop4;

        return $this;
    }

    public function getWorkshop5(): ?Workshop5
    {
        return $this->workshop5;
    }

    public function setWorkshop5(Workshop5 $workshop5): self
    {
        // set the owning side of the relation if necessary
        if ($workshop5->getProject() !== $this) {
            $workshop5->setProject($this);
        }

        $this->workshop5 = $workshop5;

        return $this;
    }
}
