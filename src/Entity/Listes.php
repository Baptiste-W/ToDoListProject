<?php

namespace App\Entity;

use App\Repository\ListesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListesRepository::class)
 */
class Listes
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

    private $listName;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="listes")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Taches::class, mappedBy="listes", cascade={"remove"})
     */
    private $tache;

    public function __construct()
    {
        $this->tache = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="integer")
     */

    public function getListName(): ?string
    {
        return $this->listName;
    }

    public function setListName(string $listName): self
    {
        $this->listName = $listName;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Taches>
     */
    public function getTache(): Collection
    {
        return $this->tache;
    }

    public function addTache(Taches $tache): self
    {
        if (!$this->tache->contains($tache)) {
            $this->tache[] = $tache;
            $tache->setListes($this);
        }

        return $this;
    }

    public function removeTache(Taches $tache): self
    {
        if ($this->tache->removeElement($tache)) {
            // set the owning side to null (unless already changed)
            if ($tache->getListes() === $this) {
                $tache->setListes(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}
