<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectParametersRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ProjectParametersRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:ProjectParameters']],
    denormalizationContext: ['groups' => ['write:ProjectParameters']],
    itemOperations: ['get', 'delete']
)]
class ProjectParameters
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:ProjectParameters"])]
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    #[Groups(["read:ProjectParameters", "write:ProjectParameters"])]
    private $workshopsDefined = [];

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="projectParameters", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(["read:ProjectParameters", "write:ProjectParameters"])]
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
