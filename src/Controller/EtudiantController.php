<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\VoltaireEtudiant;
use App\Entity\VoltaireResultats;
use App\Entity\VoltaireModules;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index()
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }

    /**
	* @Route("/etudiant/createModules")
	*/
	public function createModules(){
		//variables csv fp1(simple)
		$sphere1 = 0;
		$groupe1 = 1;
		$nom1 = 2;
		$prenom1 = 3;
		$identifiant1 = 4;
		$inscription1 = 5;
		$module1 = 6;
		$derniereutilisation1 = 7;
		$tpsTotalpasse1 = 8;
		$usagefixe1 = 9;
		$usageMobile1 = 10;
		$scoreEvaluationInitiale1 = 11;
		$tempsEvaluation1 = 12;
		$niveauInitial1 = 13;
		$tpsEntrainement1 = 14;
		$niveauAtteint1 = 15;
		$dateCV = 16;
		$idModule = 1;
		$moduleArray =array();
		$rowNo1 = 1;
		$rowNo2 = 1;
		$boolean1 = 0;
		$boolean1 = 0;
		$nomcolonnes1 = array();
		$info1 = array();
		//Variable pour communiquer avec la bdd
		$entityManager = $this->getDoctrine()->getManager();

		$fp1 = fopen((__DIR__)."\\simple.csv", "r");

        // $fp is file pointer to file sample.csv

		if ($fp1 !== FALSE){

			while (($row1 = fgetcsv($fp1, 1000, ";")) !== FALSE){
            //Only 0 .  $num = count($row);
            //useless because CSV have one column and c is always only 0.  for($c=0 ; $c< $num; $c++){
			//explode va faire de str un array qui est row découpée: exemple 1;2;3;4;5 l'array "1","2", etc...
				if($boolean1 == 0){
					foreach ($row1 as $s1){// La premiere ligne contient les noms de colonnes
						array_push($nomcolonnes1,$s1);
						$boolean1++;
					}
					$nbColonnes1 = count($row1);
				}
				else{
					if(!in_array($row1[$module1], $moduleArray)){
						$module = new VoltaireModules();
						$module->setIdModule($idModule);
						$module->setNomModule($row1[$module1]);
						$module->setNbReglesModule(0);
						$entityManager->persist($module);
						array_push($moduleArray, $row1[$module1]);
						$idModule = $idModule +1 ;
					}
				}
			}
		$entityManager->flush();
		}
		return new Response();
	}

	/**
	 * @Route("/etudiant/createEtudiants")
	 */
	public function createEtudiants()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

{
	$rowNo1 = 1;
	$rowNo2 = 1;
	$boolean1 = 0;
	$boolean1 = 0;
	$nomcolonnes1 = array();
	$info1 = array();

	//variables csv fp1(simple)
	$sphere1 = 0;
	$groupe1 = 1;
	$nom1 = 2;
	$prenom1 = 3;
	$identifiant1 = 4;
	$inscription1 = 5;
	$module1 = 6;
	$derniereutilisation1 = 7;
	$tpsTotalpasse1 = 8;
	$usagefixe1 = 9;
	$usageMobile1 = 10;
	$scoreEvaluationInitiale1 = 11;
	$tempsEvaluation1 = 12;
	$niveauInitial1 = 13;
	$tpsEntrainement1 = 14;
	$niveauAtteint1 = 15;
	$dateCV = 16;

	//variables csv fp2(detaille)
	$sphere2 = 0;
	$groupe2 = 1;
	$nom2 = 2;
	$prenom2 = 3;
	$identifiant2 = 4;
	$niveau2 = 5;
	$derniereutilisation2 = 6;
	$tpsTotal2 = 7;
	$niveauAtteint2 = 8;
	$scoreEvaluation2 = 9;
	$noteSur202=10;
	$parcours2 = 11;

	//variables imposées
	$idEtudiant = 1;
	$studentArray = array();

	//Variable pour communiquer avec la bdd
	$entityManager = $this->getDoctrine()->getManager();
	$fp1 = fopen((__DIR__)."\\simple.csv", "r");
   // $fp is file pointer to file sample.csv
	if ($fp1 !== FALSE){
		while (($row1 = fgetcsv($fp1, 1000, ";")) !== FALSE){
            //Only 0 .  $num = count($row);
            //useless because CSV have one column and c is always only 0.  for($c=0 ; $c< $num; $c++){
			//explode va faire de str un array qui est row découpée: exemple 1;2;3;4;5 l'array "1","2", etc...
			if($boolean1 == 0){
				foreach ($row1 as $s1){// La premiere ligne contient les noms de colonnes
					array_push($nomcolonnes1,$s1);
					$boolean1++;
				}
				$nbColonnes1 = count($row1);
			}

			else{
				if(!in_array($row1[$identifiant1],$studentArray)){
					$etudiant = new VoltaireEtudiant();
					$etudiant->setNomEtudiant($row1[$nom1]);
					$etudiant->setPrenomEtudiant($row1[$prenom1]);
					$etudiant->setLogin($row1[$identifiant1]);
					$etudiant->setidBareme(0);
					$entityManager->persist($etudiant);
					array_push($studentArray, $row1[$identifiant1]);
				}
			}
			$rowNo1++;
		}
	$entityManager->flush();
	fclose($fp1);
	}
	

	return new Response();
	
}

    /**
	* @Route("/etudiant/createResultats")
	*/
	public function createResultats()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

{
	$rowNo1 = 1;
	$rowNo2 = 1;
	$boolean1 = 0;
	$boolean1 = 0;
	$nomcolonnes1 = array();
	$info1 = array();
	//variables csv fp1(simple)
	$sphere1 = 0;
	$groupe1 = 1;
	$nom1 = 2;
	$prenom1 = 3;
	$identifiant1 = 4;
	$inscription1 = 5;
	$module1 = 6;
	$derniereutilisation1 = 7;
	$tpsTotalpasse1 = 8;
	$usagefixe1 = 9;
	$usageMobile1 = 10;
	$scoreEvaluationInitiale1 = 11;
	$tempsEvaluation1 = 12;
	$niveauInitial1 = 13;
	$tpsEntrainement1 = 14;
	$niveauAtteint1 = 15;
	$dateCV = 16;
	//variables csv fp2(detaille)
	$sphere2 = 0;
	$groupe2 = 1;
	$nom2 = 2;
	$prenom2 = 3;
	$identifiant2 = 4;
	$niveau2 = 5;
	$derniereutilisation2 = 6;
	$tpsTotal2 = 7;
	$niveauAtteint2 = 8;
	$scoreEvaluation2 = 9;
	$noteSur202=10;
	$parcours2 = 11;
	//variables imposées
	$idEtudiant = 1;
	$studentArray = array();

	//Variable pour communiquer avec la bdd
	$entityManager = $this->getDoctrine()->getManager();

	$fp1 = fopen((__DIR__)."\\simple.csv", "r");

        // $fp is file pointer to file sample.csv

	if ($fp1 !== FALSE){
		while (($row1 = fgetcsv($fp1, 1000, ";")) !== FALSE){
            //Only 0 .  $num = count($row);
            //useless because CSV have one column and c is always only 0.  for($c=0 ; $c< $num; $c++){
			//explode va faire de str un array qui est row découpée: exemple 1;2;3;4;5 l'array "1","2", etc...
			if($boolean1 == 0){
				foreach ($row1 as $s1){// La premiere ligne contient les noms de colonnes
					array_push($nomcolonnes1,$s1);
					$boolean1++;
				}
				$nbColonnes1 = count($row1);
			}

			else{
				$module = $entityManager->getRepository(VoltaireModules::Class)->findBy(["nomModule" => $row1[$module1]]);
				$resultat = new VoltaireResultats();	
				$resultat->setidEtudiant($row1[$identifiant1]);
				$resultat->setIdModule($module[0]->getIdModule());
				if(strcmp($row1[$derniereutilisation1],' ')){$resultat->setDerniereUtilisation(date_create_from_format("j/m/Y","0/0/0"));}
				else{$resultat->setDerniereUtilisation(date_create_from_format("j/m/Y",$row1[$derniereutilisation1]));}
				$resultat->setNiveauAtteint(intval($row1[$module1]));
				$resultat->setTpsEntrainement(date_create($row1[$tpsEntrainement1]));
				$resultat->setTpsTotal(date_create($row1[$tpsTotalpasse1]));
				$resultat->setInscription(date_create_from_format("j/m/Y",($row1[$inscription1])));
				$resultat->setUsageFixe(intval($row1[$usagefixe1]));
				$resultat->setUsageMobile(intval($row1[$usageMobile1]));
				$resultat->setScoreEvaluationInitiale(intval($row1[$scoreEvaluationInitiale1]));
				$resultat->setTpsEvaluationInitiale(date_create($row1[$tempsEvaluation1]));
				$resultat->setNiveauInitial(intval($row1[$niveauInitial1]));
				if(strcmp($row1[$dateCV],' ')){$resultat->setDateCV(date_create_from_format("j/m/Y","0/0/0"));}
				else{$resultat->setDateCV(date_create_from_format("j/m/Y",$row1[$dateCV]));}
				//Dire a doctrine qu'on veut faire des actions sur cet element(sauvegarder)
				$entityManager->persist($resultat);
				//Commit et push les evenements.
				

			}
			
			$rowNo1++;
		}
		$entityManager->flush();
		fclose($fp1);
	}
	

	return new Response();
	
}


    /**
	* @Route("/etudiant/createbycsv")
	*/
	public function createByCSV()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

{
	EtudiantController::createModules();
	EtudiantController::createEtudiants();
	EtudiantController::createResultats();

	return new Response();
	
}
/**
	* @Route("/etudiant/refreshbycsv")
	*/
/**	public function refresh()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

{
	$rowNo = 1;
	$boolean = 0;
	$nomcolonnes = array();
	$info = array();
	$time = 0;

	//Variable pour communiquer avec la bdd
	$entityManager = $this->getDoctrine()->getManager();
	$repository = $this->getDoctrine()->getRepository(Etudiant::class);

        // $fp is file pointer to file sample.csv
	while($time<2){
		if (($fp = fopen((__DIR__)."\\data.csv", "r")) !== FALSE) {
		while (($row = fgetcsv($fp, 1000, ";")) !== FALSE) {
            //Only 0 .  $num = count($row);
            //useless because CSV have one column and c is always only 0.  for($c=0 ; $c< $num; $c++){
			$str = explode(";", $row[0]);
			//explode va faire de str un array qui est row découpée: exemple 1;2;3;4;5 l'array "1","2", etc...
			if($boolean == 0){
				foreach ($str as $s) {// La premiere ligne contient les noms de colonnes
					array_push($nomcolonnes,$s);
					$boolean++;
					
				}
				$nbColonnes = count($str);
			}
			else{
				$modif = 0;
				$etudiantbdd = $repository->find($rowNo-1);
				if($etudiantbdd->getGroupe() != $str[1]){
					$etudiantbdd->setGroupe($str[1]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getIdentifiant() != $str[4]){
					$etudiantbdd->setIdentifiant($str[4]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getNom() != $str[2]){
					$etudiantbdd->setNom($str[2]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getPrenom() != $str[3]){
					$etudiantbdd->setPrenom($str[3]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getSphere() != $str[0]){
					$etudiantbdd->setSphere($str[0]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getGroupe() != $str[1]){
					$etudiantbdd->setGroupe($str[1]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getModule() != $str[6]){
					$etudiantbdd->setModule($str[6]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getDerniereUtilisation() != $str[7]){
					$etudiantbdd->setDerniereUtilisation($str[7]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getNiveauAtteint() != $str[13]){
					$etudiantbdd->setNiveauAtteint($str[13]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getTempsEntrainement() != $str[14]){
					$etudiantbdd->setTempsEntrainement($str[14]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getGroupe() != $str[1]){
					$etudiantbdd->setGroupe($str[1]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getTempsTotal() != $str[8]){
					$etudiantbdd->setTempsTotal($str[8]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getInscription() != $str[5]){
					$etudiantbdd->setInscription($str[5]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getUsageFixe() != $str[9]){
					$etudiantbdd->setUsageFixe($str[9]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getUsageMobile() != $str[10]){
					$etudiantbdd->setUsageMobile($str[10]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getScoreEvalutationInitiale() != $str[11]){
					$etudiantbdd->setScoreEvalutationInitiale($str[11]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getTempsEvaluationInitiale() != $str[12]){
					$etudiantbdd->setTempsEvaluationInitiale($str[12]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getNiveauInitial() != $str[13]){
					$etudiantbdd->setNiveauInitial($str[13]);
					$modif = $modif+1;
				}
				if($etudiantbdd->getDateCV() != $str[16]){
					$etudiantbdd->setDateCV($str[16]);
					$modif = $modif+1;
				}
				if($modif>0){
					$entityManager->flush();

				}
				echo($modif);
				echo(" Lignes Modifiées");
				
			}
			
			$rowNo++;
		}
		fclose($fp);

		unlink((__DIR__)."\\data.csv");
	}
	$rowNo = 1;
	$boolean = 0;
	$nomcolonnes = array();
	$info = array();
}
	return new Response();
	

}
**/
/**
	* @Route("/etudiant/createBareme")
	*/
	public function createBareme(){
	if($_GET['1param'] + $_GET['2param'] + $_GET['3param'] != 15 ){
		echo("Ca ne fais pas 15 ! ");
		echo ("<a href= http://localhost:8000/etudiant/> Recreer un bareme </a>");
			}
	else{
		echo("On crée le bareme voulu");
	}
			return new Response();
	}

}
