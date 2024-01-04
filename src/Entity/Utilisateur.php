<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il existe déjà un compte avec cet email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $utilNom = null;

    #[ORM\Column(length: 255)]
    private ?string $utilAdresse = null;

    #[ORM\Column(length: 255)]
    private ?string $utilType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $utilReference = null;

    #[ORM\Column(nullable: true)]
    private ?float $utilCoef = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Commande::class, cascade: ['remove'], orphanRemoval: true)]
    private Collection $commandes;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Panier $panier = null;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUtilNom(): ?string
    {
        return $this->utilNom;
    }

    public function setUtilNom(string $utilNom): static
    {
        $this->utilNom = $utilNom;

        return $this;
    }

    public function getUtilAdresse(): ?string
    {
        return $this->utilAdresse;
    }

    public function setUtilAdresse(string $utilAdresse): static
    {
        $this->utilAdresse = $utilAdresse;

        return $this;
    }

    public function getUtilType(): ?string
    {
        return $this->utilType;
    }

    public function setUtilType(string $utilType): static
    {
        $this->utilType = $utilType;

        return $this;
    }

    public function getUtilReference(): ?string
    {
        return $this->utilReference;
    }

    public function setUtilReference(?string $utilReference): static
    {
        $this->utilReference = $utilReference;

        return $this;
    }

    public function getUtilCoef(): ?float
    {
        return $this->utilCoef;
    }

    public function setUtilCoef(?float $utilCoef): static
    {
        $this->utilCoef = $utilCoef;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getUtilisateur(): Collection
    {
        return $this->commandes;
    }

    public function addUtilisateur(Commande $commandes): static
    {
        if (!$this->commandes->contains($commandes)) {
            $this->commandes->add($commandes);
            $commandes->setUtilisateur($this);
        }

        return $this;
    }

    public function removeUtilisateur(Commande $commandes): static
    {
        if ($this->commandes->removeElement($commandes)) {
            // set the owning side to null (unless already changed)
            if ($commandes->getUtilisateur() === $this) {
                $commandes->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(Panier $panier): static
    {
        // set the owning side of the relation if necessary
        if ($panier->getUtilisateur() !== $this) {
            $panier->setUtilisateur($this);
        }

        $this->panier = $panier;

        return $this;
    }
}
