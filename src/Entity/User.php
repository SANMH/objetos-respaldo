<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Facultad", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $facultad;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objetos", mappedBy="user")
     */
    private $objetos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Oferta", mappedBy="user")
     */
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->objetos = new ArrayCollection();
        $this->user = new ArrayCollection();
        // your own logic
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

    public function getFacultad(): ?Facultad
    {
        return $this->facultad;
    }

    public function setFacultad(?Facultad $facultad): self
    {
        $this->facultad = $facultad;

        return $this;
    }

    /**
     * @return Collection|Objetos[]
     */
    public function getObjetos(): Collection
    {
        return $this->objetos;
    }

    public function addObjeto(Objetos $objeto): self
    {
        if (!$this->objetos->contains($objeto)) {
            $this->objetos[] = $objeto;
            $objeto->setUser($this);
        }

        return $this;
    }

    public function removeObjeto(Objetos $objeto): self
    {
        if ($this->objetos->contains($objeto)) {
            $this->objetos->removeElement($objeto);
            // set the owning side to null (unless already changed)
            if ($objeto->getUser() === $this) {
                $objeto->setUser(null);
            }
        }


        return $this;
    }

    /**
     * @return Collection|Oferta[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Oferta $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setUser($this);
        }

        return $this;
    }

    public function removeUser(Oferta $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getUser() === $this) {
                $user->setUser(null);
            }
        }

        return $this;
    }


}