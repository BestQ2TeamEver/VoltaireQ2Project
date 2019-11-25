<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoltaireEnseignantRepository")
 */
class VoltaireEnseignant
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
    private $nomEnseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomEnseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupeEnseignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="integer")
     */
    private $idEnseignant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnseignant(): ?string
    {
        return $this->nomEnseignant;
    }

    public function setNomEnseignant(string $nomEnseignant): self
    {
        $this->nomEnseignant = $nomEnseignant;

        return $this;
    }

    public function getPrenomEnseignant(): ?string
    {
        return $this->prenomEnseignant;
    }

    public function setPrenomEnseignant(string $prenomEnseignant): self
    {
        $this->prenomEnseignant = $prenomEnseignant;

        return $this;
    }

    public function getGroupeEnseignant(): ?string
    {
        return $this->groupeEnseignant;
    }

    public function setGroupeEnseignant(string $groupeEnseignant): self
    {
        $this->groupeEnseignant = $groupeEnseignant;

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

    public function getIdEnseignant(): ?int
    {
        return $this->idEnseignant;
    }

    public function setIdEnseignant(int $idEnseignant): self
    {
        $this->idEnseignant = $idEnseignant;

        return $this;
    }
}
