<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $estAcheter = null;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: Produit::class)]
    private Collection $produit;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: ArticlePanier::class, cascade: ["persist"], orphanRemoval: true)]
    private Collection $articlePanier;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
        $this->articlePanier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isEstAcheter(): ?bool
    {
        return $this->estAcheter;
    }

    public function setEstAcheter(bool $estAcheter): static
    {
        $this->estAcheter = $estAcheter;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
            $produit->setCart($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCart() === $this) {
                $produit->setCart(null);
            }
        }

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, ArticlePanier>
     */
    public function getArticlePanier(): Collection
    {
        return $this->articlePanier;
    }

    public function addArticlePanier(ArticlePanier $articlePanier): static
    {
        if (!$this->articlePanier->contains($articlePanier)) {
            $this->articlePanier->add($articlePanier);
            $articlePanier->setCart($this);
        }

        return $this;
    }

    public function removeArticlePanier(ArticlePanier $articlePanier): static
    {
        if ($this->articlePanier->removeElement($articlePanier)) {
            // set the owning side to null (unless already changed)
            if ($articlePanier->getCart() === $this) {
                $articlePanier->setCart(null);
            }
        }

        return $this;
    }
}
