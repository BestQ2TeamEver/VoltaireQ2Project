<?php
class ModelEtudiantComplexe{
//Prérequis, on suppose que le csv compliqué compte 17 colonnes.
	private $sphère;
	private $groupe;
	private $nom;
	private $prenom;
	private $identifiant;
	private $inscription;
	private $module;
	private $dernutilisation;
	private $tempstotal;
	private $usagefixe;
	private $usagemobile;
	private $scoreevalinit;
	private $tmpsevaluationinit;
	private $niveauinit;
	private $tmpentrainement;
	private $niveauatteint;
	private $dateCV;

	//Constructeur
	public function __construct($sphère,$groupe,$nom,$prenom,$identifiant,$inscription,$module,$dernutilisation,$tempstotal,$usagefixe,$usagemobile,$scoreevalini,$tmpsevaluationinit,$niveauinit,$tmpentrainement,$niveauatteint,$dateCV) {
 
    $this->sphère = $sphère;
    $this->groupe = $groupe;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->identifiant = $identifiant;
    $this->inscription = $inscription;
    $this->module = $module;
    $this->dernutilisation = $dernutilisation;
    $this->tempstotal = $tempstotal;
    $this->usagefixe = $usagefixe;
    $this->usagemobile = $usagemobile;
    $this->scoreevalini = $scoreevalini;
    $this->tmpsevaluationinit = $tmpsevaluationinit;
    $this->niveauinit = $niveauinit;
    $this->tmpentrainement = $tmpentrainement;
    $this->niveauatteint = $niveauatteint;
    $this->dateCV = $dateCV;
    
  }


}