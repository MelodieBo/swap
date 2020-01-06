<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $femme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $homme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $enfant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $maison;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $media_loisir;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\produit", mappedBy="categorie", orphanRemoval=true)
     */
    private $produit;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFemme(): ?string
    {
        return $this->femme;
    }

    public function setFemme(?string $femme): self
    {
        $this->femme = $femme;

        return $this;
    }

    public function getHomme(): ?string
    {
        return $this->homme;
    }

    public function setHomme(?string $homme): self
    {
        $this->homme = $homme;

        return $this;
    }

    public function getEnfant(): ?string
    {
        return $this->enfant;
    }

    public function setEnfant(?string $enfant): self
    {
        $this->enfant = $enfant;

        return $this;
    }

    public function getMaison(): ?string
    {
        return $this->maison;
    }

    public function setMaison(?string $maison): self
    {
        $this->maison = $maison;

        return $this;
    }

    public function getMediaLoisir(): ?string
    {
        return $this->media_loisir;
    }

    public function setMediaLoisir(?string $media_loisir): self
    {
        $this->media_loisir = $media_loisir;

        return $this;
    }

    public function getAutre(): ?string
    {
        return $this->autre;
    }

    public function setAutre(?string $autre): self
    {
        $this->autre = $autre;

        return $this;
    }

    /**
     * @return Collection|produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
            $produit->setCategorie($this);
        }

        return $this;
    }

    public function removeProduit(produit $produit): self
    {
        if ($this->produit->contains($produit)) {
            $this->produit->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }

        return $this;
    }
}
