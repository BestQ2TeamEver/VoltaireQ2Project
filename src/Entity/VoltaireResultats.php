<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoltaireResultatsRepository")
 */
class VoltaireResultats
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
     * @ORM\Column(type="integer")
     */
    private $idModule;

    /**
     * @ORM\Column(type="date")
     */
    private $inscription;

    /**
     * @ORM\Column(type="date")
     */
    private $derniereUtilisation;

    /**
     * @ORM\Column(type="time")
     */
    private $tpsTotal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usageFixe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usageMobile;

    /**
     * @ORM\Column(type="integer")
     */
    private $scoreEvaluation;

    /**
     * @ORM\Column(type="time")
     */
    private $tpsEvaluationInitiale;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauInitial;

    /**
     * @ORM\Column(type="time")
     */
    private $tpsEntrainement;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauAtteint;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCV;

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

    public function getIdModule(): ?int
    {
        return $this->idModule;
    }

    public function setIdModule(int $idModule): self
    {
        $this->idModule = $idModule;

        return $this;
    }

    public function getInscription(): ?\DateTimeInterface
    {
        return $this->inscription;
    }

    public function setInscription(\DateTimeInterface $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getDerniereUtilisation(): ?\DateTimeInterface
    {
        return $this->derniereUtilisation;
    }

    public function setDerniereUtilisation(\DateTimeInterface $derniereUtilisation): self
    {
        $this->derniereUtilisation = $derniereUtilisation;

        return $this;
    }

    public function getTpsTotal(): ?\DateTimeInterface
    {
        return $this->tpsTotal;
    }

    public function setTpsTotal(\DateTimeInterface $tpsTotal): self
    {
        $this->tpsTotal = $tpsTotal;

        return $this;
    }

    public function getUsageFixe(): ?string
    {
        return $this->usageFixe;
    }

    public function setUsageFixe(string $usageFixe): self
    {
        $this->usageFixe = $usageFixe;

        return $this;
    }

    public function getUsageMobile(): ?string
    {
        return $this->usageMobile;
    }

    public function setUsageMobile(string $usageMobile): self
    {
        $this->usageMobile = $usageMobile;

        return $this;
    }

    public function getScoreEvaluation(): ?int
    {
        return $this->scoreEvaluation;
    }

    public function setScoreEvaluation(int $scoreEvaluation): self
    {
        $this->scoreEvaluation = $scoreEvaluation;

        return $this;
    }

    public function getTpsEvaluationInitiale(): ?\DateTimeInterface
    {
        return $this->tpsEvaluationInitiale;
    }

    public function setTpsEvaluationInitiale(\DateTimeInterface $tpsEvaluationInitiale): self
    {
        $this->tpsEvaluationInitiale = $tpsEvaluationInitiale;

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

    public function getTpsEntrainement(): ?\DateTimeInterface
    {
        return $this->tpsEntrainement;
    }

    public function setTpsEntrainement(\DateTimeInterface $tpsEntrainement): self
    {
        $this->tpsEntrainement = $tpsEntrainement;

        return $this;
    }

    public function getNiveauAtteint(): ?int
    {
        return $this->niveauAtteint;
    }

    public function setNiveauAtteint(int $niveauAtteint): self
    {
        $this->niveauAtteint = $niveauAtteint;

        return $this;
    }

    public function getDateCV(): ?\DateTimeInterface
    {
        return $this->dateCV;
    }

    public function setDateCV(\DateTimeInterface $dateCV): self
    {
        $this->dateCV = $dateCV;

        return $this;
    }
}
