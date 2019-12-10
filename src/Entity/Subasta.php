<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubastaRepository")
 */
class Subasta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaIngreso;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objetos", inversedBy="subastaobjeto")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objetos;

    /**
     * @ORM\Column(type="float")
     */
    private $oferta;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Oferta", mappedBy="subasta")
     */
    private $subasta;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $estado;

    public function __construct()
    {
        $this->subasta = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getFechaIngreso(): ?\DateTimeInterface
    {
        return $this->fechaIngreso;
    }

    public function setFechaIngreso(\DateTimeInterface $fechaIngreso): self
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    public function getObjetos(): ?Objetos
    {
        return $this->objetos;
    }

    public function setObjetos(?Objetos $objetos): self
    {
        $this->objetos = $objetos;

        return $this;
    }

    public function getOferta(): ?float
    {
        return $this->oferta;
    }

    public function setOferta(float $oferta): self
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * @return Collection|Oferta[]
     */
    public function getSubasta(): Collection
    {
        return $this->subasta;
    }

    public function addSubastum(Oferta $subastum): self
    {
        if (!$this->subasta->contains($subastum)) {
            $this->subasta[] = $subastum;
            $subastum->setSubasta($this);
        }

        return $this;
    }

    public function removeSubastum(Oferta $subastum): self
    {
        if ($this->subasta->contains($subastum)) {
            $this->subasta->removeElement($subastum);
            // set the owning side to null (unless already changed)
            if ($subastum->getSubasta() === $this) {
                $subastum->setSubasta(null);
            }
        }

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }


}
