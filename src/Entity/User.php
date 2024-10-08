<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(['email'], message: 'Cette adresse email est déjà utilisée.')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    #[Assert\Length(min: 2, max: 32, minMessage: 'Votre prénom doit avoir minimum {{ limit }} caractères de long', maxMessage: 'Votre prénom doit avoir maximum {{ limit }} caractères de long')]
    private ?string $firstname = null;

    #[ORM\Column(length: 32)]
    #[Assert\Length(min: 2, max: 32, minMessage: 'Votre nom doit avoir minimum  {{ limit }} caractères de long', maxMessage: 'Votre nom doit avoir maximum {{ limit }} caractères de long')]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(message: 'L\'adresse {{ value }} n\'est pas une adresse email valide.')]
    private ?string $email = null;

    #[ORM\Column(length: 32)]
    private ?string $contract_type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $employement_date = null;

    /**
     * @var Collection<int, Task>
     */
    #[ORM\OneToMany(targetEntity: Task::class, mappedBy: 'user')]
    private Collection $tasks;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'users')]
    private Collection $projects;

    /**
     * @var Collection<int, Project>
     */

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getInitials(): string
    {
        return strtoupper($this->firstname[0] . $this->lastname[0]);
    }

    public function getFullName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getContractType(): ?string
    {
        return $this->contract_type;
    }

    public function setContractType(string $contract_type): static
    {
        $this->contract_type = $contract_type;

        return $this;
    }

    public function getEmployementDate(): ?\DateTimeInterface
    {
        return $this->employement_date;
    }

    public function setEmployementDate(\DateTimeInterface $employement_date): static
    {
        $this->employement_date = $employement_date;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setUser($this);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getUser() === $this) {
                $task->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        dd("AddProject dans user");
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addUser($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        dd("RemoveProject dans user");
        if ($this->projects->removeElement($project)) {
            dd("RemoveProject dans user");

            $project->removeUser($this);
        }

        return $this;
    }


}
