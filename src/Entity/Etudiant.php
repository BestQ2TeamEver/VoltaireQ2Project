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
     * @ORM\Column(type="string", length=255)
     */
    private $sphere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $inscription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $module;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $derniereutilisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tempstotal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usagefixe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usagemobile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $scoreEvalutationInitiale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tempsEvaluationInitiale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveauInitial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tempsEntrainement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveauAtteint;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateCV;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(string $groupe): self
    {
        $this->groupe = $groupe;

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

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

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

    public function getModule(): ?string
    {
        return $this->module;
    }

    public function setModule(string $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getDerniereutilisation(): ?string
    {
        return $this->derniereutilisation;
    }

    public function setDerniereutilisation(string $derniereutilisation): self
    {
        $this->derniereutilisation = $derniereutilisation;

        return $this;
    }

    public function getTempstotal(): ?string
    {
        return $this->tempstotal;
    }

    public function setTempstotal(string $tempstotal): self
    {
        $this->tempstotal = $tempstotal;

        return $this;
    }

    public function getUsagefixe(): ?string
    {
        return $this->usagefixe;
    }

    public function setUsagefixe(string $usagefixe): self
    {
        $this->usagefixe = $usagefixe;

        return $this;
    }

    public function getUsagemobile(): ?string
    {
        return $this->usagemobile;
    }

    public function setUsagemobile(string $usagemobile): self
    {
        $this->usagemobile = $usagemobile;

        return $this;
    }

    public function getScoreEvalutationInitiale(): ?string
    {
        return $this->scoreEvalutationInitiale;
    }

    public function setScoreEvalutationInitiale(string $scoreEvalutationInitiale): self
    {
        $this->scoreEvalutationInitiale = $scoreEvalutationInitiale;

        return $this;
    }

    public function getTempsEvaluationInitiale(): ?string
    {
        return $this->tempsEvaluationInitiale;
    }

    public function setTempsEvaluationInitiale(string $tempsEvaluationInitiale): self
    {
        $this->tempsEvaluationInitiale = $tempsEvaluationInitiale;

        return $this;
    }

    public function getNiveauInitial(): ?string
    {
        return $this->niveauInitial;
    }

    public function setNiveauInitial(string $niveauInitial): self
    {
        $this->niveauInitial = $niveauInitial;

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

    public function getNiveauAtteint(): ?string
    {
        return $this->niveauAtteint;
    }

    public function setNiveauAtteint(string $niveauAtteint): self
    {
        $this->niveauAtteint = $niveauAtteint;

        return $this;
    }

    public function getDateCV(): ?string
    {
        return $this->dateCV;
    }

    public function setDateCV(string $dateCV): self
    {
        $this->dateCV = $dateCV;

        return $this;
    }
}
