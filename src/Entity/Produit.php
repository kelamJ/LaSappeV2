<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Panier $panier = null;

    #[ORM\OneToMany(mappedBy: 'articlesPanier', targetEntity: ArticlePanier::class, orphanRemoval: true)]
    private Collection $articlePanier;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: CommandeDetail::class, cascade: ['remove'],orphanRemoval: true)]
    private Collection $comDetail;

    public function __construct()
    {
        $this->articlePanier = new ArrayCollection();
        $this->comDetail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCart(): ?Panier
    {
        return $this->panier;
    }

    public function setCart(?Panier $panier): static
    {
        $this->panier = $panier;

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
            $articlePanier->setArticlesPanier($this);
        }

        return $this;
    }

    public function removeArticlePanier(ArticlePanier $articlePanier): static
    {
        if ($this->articlePanier->removeElement($articlePanier)) {
            // set the owning side to null (unless already changed)
            if ($articlePanier->getArticlesPanier() === $this) {
                $articlePanier->setArticlesPanier(null);
            }
        }

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, CommandeDetail>
     */
    public function getComDetail(): Collection
    {
        return $this->comDetail;
    }

    public function addComDetail(CommandeDetail $comDetail): static
    {
        if (!$this->comDetail->contains($comDetail)) {
            $this->comDetail->add($comDetail);
            $comDetail->setProduit($this);
        }

        return $this;
    }

    public function removeComDetail(CommandeDetail $comDetail): static
    {
        if ($this->comDetail->removeElement($comDetail)) {
            // set the owning side to null (unless already changed)
            if ($comDetail->getProduit() === $this) {
                $comDetail->setProduit(null);
            }
        }

        return $this;
    }
}
