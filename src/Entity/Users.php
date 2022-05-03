<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MDP;

    /**
     * @ORM\OneToMany(targetEntity=Listes::class, mappedBy="user")
     */
    private $listes;

    public function __construct()
    {
        $this->listes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMDP(): ?string
    {
        return $this->MDP;
    }

    public function setMDP(string $MDP): self
    {
        $this->MDP = $MDP;

        return $this;
    }

    /**
     * @return Collection<int, Listes>
     */
    public function getListes(): Collection
    {
        return $this->listes;
    }

    public function addListe(Listes $liste): self
    {
        if (!$this->listes->contains($liste)) {
            $this->listes[] = $liste;
            $liste->setUser($this);
        }

        return $this;
    }

    public function removeListe(Listes $liste): self
    {
        if ($this->listes->removeElement($liste)) {
            // set the owning side to null (unless already changed)
            if ($liste->getUser() === $this) {
                $liste->setUser(null);
            }
        }

        return $this;
    }
}
