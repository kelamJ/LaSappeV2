<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fouNom = null;

    #[ORM\Column(length: 255)]
    private ?string $fouAdresse = null;

    #[ORM\OneToMany(mappedBy: 'fournisseur', targetEntity: Produit::class)]
    private Collection $produit;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFouNom(): ?string
    {
        return $this->fouNom;
    }

    public function setFouNom(string $fouNom): static
    {
        $this->fouNom = $fouNom;

        return $this;
    }

    public function getFouAdresse(): ?string
    {
        return $this->fouAdresse;
    }

    public function setFouAdresse(string $fouAdresse): static
    {
        $this->fouAdresse = $fouAdresse;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getFournisseur(): Collection
    {
        return $this->fournisseur;
    }

    public function addFournisseur(Produit $produit): static
    {
        if (!$this->fournisseur->contains($produit)) {
            $this->fournisseur->add($produit);
            $produit->setFournisseur($this);
        }

        return $this;
    }

    public function removeFournisseur(Produit $produit): static
    {
        if ($this->fournisseur->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getFournisseur() === $this) {
                $produit->setFournisseur(null);
            }
        }

        return $this;
    }
}
