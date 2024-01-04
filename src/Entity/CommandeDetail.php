<?php

namespace App\Entity;

use App\Repository\CommandeDetailRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeDetailRepository::class)]
class CommandeDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $comDetailPrix = null;

    #[ORM\ManyToOne(inversedBy: 'comDetail')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commandes = null;

    #[ORM\ManyToOne(inversedBy: 'comDetail')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getComDetailPrix(): ?string
    {
        return $this->comDetailPrix;
    }

    public function setComDetailPrix(string $comDetailPrix): static
    {
        $this->comDetailPrix = $comDetailPrix;

        return $this;
    }

    public function getCommandes(): ?Commande
    {
        return $this->commandes;
    }

    public function setCommandes(?Commande $commandes): static
    {
        $this->commandes = $commandes;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }
}
