<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $comDate = null;

    #[ORM\Column(length: 255)]
    private ?string $comLivAdresse = null;

    #[ORM\Column(length: 255)]
    private ?string $comFactureAdresse = null;

    #[ORM\Column]
    private ?float $comReduction = null;

    #[ORM\Column]
    private ?bool $comStatutPaie = null;

    #[ORM\Column(length: 255)]
    private ?string $comEnvoieStatut = null;

    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: Paiement::class, orphanRemoval: true)]
    private Collection $paiements;

    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: CommandeDetail::class, orphanRemoval: true)]
    private Collection $comDetail;


    public function __construct()
    {
        $this->paiements = new ArrayCollection();
        $this->comDetail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getComDate(): ?\DateTimeInterface
    {
        return $this->comDate;
    }

    public function setComDate(\DateTimeInterface $comDate): static
    {
        $this->comDate = $comDate;

        return $this;
    }

    public function getComLivAdresse(): ?string
    {
        return $this->comLivAdresse;
    }

    public function setComLivAdresse(string $comLivAdresse): static
    {
        $this->comLivAdresse = $comLivAdresse;

        return $this;
    }

    public function getComFactureAdresse(): ?string
    {
        return $this->comFactureAdresse;
    }

    public function setComFactureAdresse(string $comFactureAdresse): static
    {
        $this->comFactureAdresse = $comFactureAdresse;

        return $this;
    }

    public function getComReduction(): ?float
    {
        return $this->comReduction;
    }

    public function setComReduction(float $comReduction): static
    {
        $this->comReduction = $comReduction;

        return $this;
    }

    public function isComStatutPaie(): ?bool
    {
        return $this->comStatutPaie;
    }

    public function setComStatutPaie(bool $comStatutPaie): static
    {
        $this->comStatutPaie = $comStatutPaie;

        return $this;
    }

    public function getComEnvoieStatut(): ?string
    {
        return $this->comEnvoieStatut;
    }

    public function setComEnvoieStatut(string $comEnvoieStatut): static
    {
        $this->comEnvoieStatut = $comEnvoieStatut;

        return $this;
    }

    /**
     * @return Collection<int, Paiement>
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): static
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements->add($paiement);
            $paiement->setPaiements($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): static
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getPaiements() === $this) {
                $paiement->setPaiements(null);
            }
        }

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
            $comDetail->setCommandes($this);
        }

        return $this;
    }

    public function removeComDetail(CommandeDetail $comDetail): static
    {
        if ($this->comDetail->removeElement($comDetail)) {
            // set the owning side to null (unless already changed)
            if ($comDetail->getCommandes() === $this) {
                $comDetail->setCommandes(null);
            }
        }

        return $this;
    }
}
