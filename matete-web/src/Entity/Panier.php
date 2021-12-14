<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $annonce = [];

    /**
     * @ORM\OneToOne(targetEntity=Producteur::class, inversedBy="panier", cascade={"persist", "remove"})
     */
    private $Producteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnonce(): ?array
    {
        return $this->annonce;
    }

    public function setAnnonce(?array $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getProducteur(): ?Producteur
    {
        return $this->Producteur;
    }

    public function setProducteur(?Producteur $Producteur): self
    {
        $this->Producteur = $Producteur;

        return $this;
    }
}
