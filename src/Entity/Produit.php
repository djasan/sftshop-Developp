<?php



namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Prix = null;

    #[ORM\Column(length: 255)]
    private ?string $Couleur = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Taille::class, inversedBy: 'produits')]
    private Collection $tailles;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Paiement $MoyenPaiement = null;

    #[ORM\Column]
    private ?bool $Online = null;

    public function __construct()
    {
        $this->tailles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(string $Couleur): static
    {
        $this->Couleur = $Couleur;

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
    /**
     * @return Collection<int, Taille>
     */
    public function getTailles(): Collection
    {
        return $this->tailles;
    }

    public function addTaille(Taille $taille): static
    {
        if (!$this->tailles->contains($taille)) {
            $this->tailles->add($taille);
            $taille->addProduit($this);
        }

        return $this;
    }

    public function removeTaille(Taille $taille): static
    {
        if ($this->tailles->removeElement($taille)) {
            $taille->removeProduit($this);
        }

        return $this;
    }

    public function getMoyenPaiement(): ?Paiement
    {
        return $this->MoyenPaiement;
    }

    public function setMoyenPaiement(?Paiement $MoyenPaiement): static
    {
        $this->MoyenPaiement = $MoyenPaiement;

        return $this;
    }

    public function isOnline(): ?bool
    {
        return $this->Online;
    }

    public function setOnline(bool $Online): static
    {
        $this->Online = $Online;

        return $this;
    }
}
