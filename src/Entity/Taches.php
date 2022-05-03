<?php

namespace App\Entity;

use App\Repository\TachesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TachesRepository::class)
 */
class Taches
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
    private $taskName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dueDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $taskPriority;

    /**
     * @ORM\ManyToOne(targetEntity=Listes::class, inversedBy="tache")
     */
    private $listes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaskName(): ?string
    {
        return $this->taskName;
    }

    public function setTaskName(string $taskName): self
    {
        $this->taskName = $taskName;

        return $this;
    }

    public function getDueDate(): ?\DateTime
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getTaskPriority(): ?string
    {
        return $this->taskPriority;
    }

    public function setTaskPriority(string $taskPriority): self
    {
        $this->taskPriority = $taskPriority;

        return $this;
    }

    public function getListes(): ?Listes
    {
        return $this->listes;
    }

    public function setListes(?Listes $listes): self
    {
        $this->listes = $listes;

        return $this;
    }
}
