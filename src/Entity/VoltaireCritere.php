<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoltaireCritereRepository")
 */
class VoltaireCritere
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
    private $progression;

    /**
     * @ORM\Column(type="integer")
     */
    private $tpsUtilisation;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauInitial;

    /**
     * @ORM\Column(type="integer")
     */
    private $evaluationFinale;

    /**
     * @ORM\Column(type="integer")
     */
    private $idCritere;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgression(): ?int
    {
        return $this->progression;
    }

    public function setProgression(int $progression): self
    {
        $this->progression = $progression;

        return $this;
    }

    public function getTpsUtilisation(): ?int
    {
        return $this->tpsUtilisation;
    }

    public function setTpsUtilisation(int $tpsUtilisation): self
    {
        $this->tpsUtilisation = $tpsUtilisation;

        return $this;
    }

    public function getNiveauInitial(): ?int
    {
        return $this->niveauInitial;
    }

    public function setNiveauInitial(int $niveauInitial): self
    {
        $this->niveauInitial = $niveauInitial;

        return $this;
    }

    public function getEvaluationFinale(): ?int
    {
        return $this->evaluationFinale;
    }

    public function setEvaluationFinale(int $evaluationFinale): self
    {
        $this->evaluationFinale = $evaluationFinale;

        return $this;
    }

    public function getIdCritere(): ?int
    {
        return $this->idCritere;
    }

    public function setIdCritere(int $idCritere): self
    {
        $this->idCritere = $idCritere;

        return $this;
    }
}
