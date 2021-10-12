<?php

namespace App\Entity;

use App\Repository\ProducteurRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProducteurRepository::class)
 */
class Producteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;

    /**
     * @ORM\OneToOne(targetEntity=Administrateur::class, mappedBy="Producteur", cascade={"persist", "remove"})
     */
    private $administrateur;

    /**
     * @ORM\ManyToMany(targetEntity=Lieu::class, mappedBy="Producteur")
     */
    private $lieux;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="producteur")
     */
    private $Annonce;

    public function __toString(): string
    {
        return $this->getNom();
    }

    public function __construct()
    {
        $this->lieux = new ArrayCollection();
        $this->Annonce = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getAdministrateur(): ?Administrateur
    {
        return $this->administrateur;
    }

    public function setAdministrateur(?Administrateur $administrateur): self
    {
        // unset the owning side of the relation if necessary
        if ($administrateur === null && $this->administrateur !== null) {
            $this->administrateur->setProducteur(null);
        }

        // set the owning side of the relation if necessary
        if ($administrateur !== null && $administrateur->getProducteur() !== $this) {
            $administrateur->setProducteur($this);
        }

        $this->administrateur = $administrateur;

        return $this;
    }

    /**
     * @return Collection|Lieu[]
     */
    public function getLieux(): Collection
    {
        return $this->lieux;
    }

    public function addLieux(Lieu $lieux): self
    {
        if (!$this->lieux->contains($lieux)) {
            $this->lieux[] = $lieux;
            $lieux->addProducteur($this);
        }

        return $this;
    }

    public function removeLieux(Lieu $lieux): self
    {
        if ($this->lieux->removeElement($lieux)) {
            $lieux->removeProducteur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getAnnonce(): Collection
    {
        return $this->Annonce;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->Annonce->contains($annonce)) {
            $this->Annonce[] = $annonce;
            $annonce->setProducteur($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->Annonce->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getProducteur() === $this) {
                $annonce->setProducteur(null);
            }
        }

        return $this;
    }
}
