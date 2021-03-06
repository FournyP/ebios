<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\OrganizationRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=OrganizationRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ["read:Organization"]],
    denormalizationContext: ['groups' => ["write:Organization"]],
    itemOperations: ['get']
)]
class Organization
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read:Organization", "read:Project"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read:Organization", "write:Organization", "read:Project"])]
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="organizations")
     */
    #[Groups(["read:Organization", "write:Organization"])]
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="organization", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    #[Groups(["read:Organization"])]
    private $projects;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->projects = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setOrganization($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getOrganization() === $this) {
                $project->setOrganization(null);
            }
        }

        return $this;
    }
}
