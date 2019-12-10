<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipoRepository")
 */
class Tipo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Facultad", mappedBy="tipo")
     */
    private $facultads;

    public function __construct()
    {
        $this->facultads = new ArrayCollection();
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
     * @return Collection|Facultad[]
     */
    public function getFacultads(): Collection
    {
        return $this->facultads;
    }

    public function addFacultad(Facultad $facultad): self
    {
        if (!$this->facultads->contains($facultad)) {
            $this->facultads[] = $facultad;
            $facultad->setTipo($this);
        }

        return $this;
    }

    public function removeFacultad(Facultad $facultad): self
    {
        if ($this->facultads->contains($facultad)) {
            $this->facultads->removeElement($facultad);
            // set the owning side to null (unless already changed)
            if ($facultad->getTipo() === $this) {
                $facultad->setTipo(null);
            }
        }

        return $this;
    }
}
