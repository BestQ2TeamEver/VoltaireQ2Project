<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $sphere;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $module;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $derniereConnexion;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $tempsEntrainement;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $tempsTotal;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $inscription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
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

    public function getSphere(): ?string
    {
        return $this->sphere;
    }

    public function setSphere(string $sphere): self
    {
        $this->sphere = $sphere;

        return $this;
    }

    public function getModule(): ?string
    {
        return $this->module;
    }

    public function setModule(string $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getDerniereConnexion(): ?string
    {
        return $this->derniereConnexion;
    }

    public function setDerniereConnexion(string $derniereConnexion): self
    {
        $this->derniereConnexion = $derniereConnexion;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getTempsEntrainement(): ?string
    {
        return $this->tempsEntrainement;
    }

    public function setTempsEntrainement(string $tempsEntrainement): self
    {
        $this->tempsEntrainement = $tempsEntrainement;

        return $this;
    }

    public function getTempsTotal(): ?string
    {
        return $this->tempsTotal;
    }

    public function setTempsTotal(string $tempsTotal): self
    {
        $this->tempsTotal = $tempsTotal;

        return $this;
    }

    public function getInscription(): ?string
    {
        return $this->inscription;
    }

    public function setInscription(string $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }
}
