<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfertaRepository")
 */
class Oferta
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
    private $cuanto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subasta", inversedBy="subasta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subasta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="user")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCuanto(): ?float
    {
        return $this->cuanto;
    }

    public function setCuanto(float $cuanto): self
    {
        $this->cuanto = $cuanto;

        return $this;
    }

    public function getSubasta(): ?Subasta
    {
        return $this->subasta;
    }

    public function setSubasta(?Subasta $subasta): self
    {
        $this->subasta = $subasta;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
