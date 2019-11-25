<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoltaireNiveauRepository")
 */
class VoltaireNiveau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idNiveau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomNiveau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdNiveau(): ?int
    {
        return $this->idNiveau;
    }

    public function setIdNiveau(int $idNiveau): self
    {
        $this->idNiveau = $idNiveau;

        return $this;
    }

    public function getNomNiveau(): ?string
    {
        return $this->nomNiveau;
    }

    public function setNomNiveau(string $nomNiveau): self
    {
        $this->nomNiveau = $nomNiveau;

        return $this;
    }
}
