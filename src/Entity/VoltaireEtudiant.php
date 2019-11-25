<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoltaireEtudiantRepository")
 */
class VoltaireEtudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="integer")
     */
    private $idBareme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEtudiant(): ?string
    {
        return $this->idEtudiant;
    }

    public function setIdEtudiant(string $idEtudiant): self
    {
        $this->idEtudiant = $idEtudiant;

        return $this;
    }

    public function getNomEtudiant(): ?string
    {
        return $this->nomEtudiant;
    }

    public function setNomEtudiant(string $nomEtudiant): self
    {
        $this->nomEtudiant = $nomEtudiant;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->prenomEtudiant;
    }

    public function setPrenomEtudiant(string $prenomEtudiant): self
    {
        $this->prenomEtudiant = $prenomEtudiant;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getIdBareme(): ?int
    {
        return $this->idBareme;
    }

    public function setIdBareme(int $idBareme): self
    {
        $this->idBareme = $idBareme;

        return $this;
    }
}
