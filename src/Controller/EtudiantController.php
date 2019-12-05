<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\VoltaireEtudiant;
use App\Entity\VoltaireResultats;
use App\Entity\VoltaireModules;
use App\Entity\VoltaireNiveau;
use App\Entity\VoltaireResultatNiveau;
use App\Entity\VoltaireBareme;
use App\Entity\VoltaireCritere;
use App\Entity\User;


class EtudiantController extends AbstractController
{


    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index()
    {
    	$user = $this->getUser();
    	$entityManager = $this->getDoctrine()->getManager();
    	$etudiants = $this->getDoctrine()->getRepository(VoltaireEtudiant::class)->findAll();
    	return $this->render('etudiant/index.html.twig', [
    		'etudiants' => $etudiants,
    		'user' => $user
    	]);
    }

    /**
     * @Route("/etudiant/generateCSV", name="Création du fichier csv")
     */
    public function generateCSV()
    {
    	$entityManager = $this->getDoctrine()->getManager();
    	$etudiants = $this->getDoctrine()->getRepository(VoltaireEtudiant::class)->findAll();
    	foreach($etudiants as $etudiant){
    		$nom = $etudiant->getNomEtudiant();
    		$prenom = $etudiant->getPrenomEtudiant();
    		$INE = $etudiant->getLogin();
    		$note = EtudiantController::avoirNoteEtudiant($INE);
    		$data[] = array(
    			'Nom' => $nom,
    			'Prenom' => $prenom,
    			'INE' => $INE,
    			'Note totale' => $note,
    		);
    	}
    	$fp = fopen('./notes.csv','w');
    	fputcsv($fp, array('NUMERO','NOM'));
    	foreach($data as $fields){
    		fputcsv($fp, $fields,";");
    	}
    	fclose($fp);
    	$fichier = 'notes.csv';
    	$chemin = "./notes.csv";
    	header('Content-disposition: attachment; filename="' . $fichier . '"');
    	header('Content-Type: application/force-download');
    	header('Content-Transfer-Encoding: binary');
    	header('Content-Length: '. filesize($chemin));
    	header('Pragma: no-cache');
    	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    	header('Expires: 0');
    	readfile($chemin);
    	return new Response();
    }

    /**
     * @Route("/etudiant/createAllUsers", name="créer tous les utilisateurs")
     */
    public function createAllUsers()
    {
    	$entityManager = $this->getDoctrine()->getManager();
    	$etudiants = $this->getDoctrine()->getRepository(VoltaireEtudiant::class)->findAll();
    	foreach ($etudiants as $etudiant) {
    		$user = new User();
    		$user->setLogin($etudiant->getLogin());
    		$user->setPassword("\$argon2id\$v=19\$m=65536,t=4,p=1\$Y0FtdmYwMFN3SUpvTks3eg\$pqoDW8L3ClYYkTB7HQ3PPY8AhSp8LkFcfdfpaPA6vTc");
    		$entityManager->persist($user);
    	}
    	$entityManager->flush();
    	return new Response();
    }


     /**
     * @Route("/etudiant/show/{id}", methods={"GET","HEAD"})
     */
     public function show(string $id)
     {
     	$entityManager = $this->getDoctrine()->getManager();
     	$etudiant = $this->getDoctrine()->getRepository(VoltaireEtudiant::class)->findOneBy(['login' => $id]);
     	$resultat = $this->getDoctrine()->getRepository(Voltaireresultats::class)->findOneBy(['idEtudiant' => $id,'idModule' => 1]);
     	$resultatniveau = $this->getDoctrine()->getRepository(VoltaireresultatNiveau::class)->findBy(['idEtudiant' => $id,'idNiveau' => 'Évaluation initiale']);
     	$bareme = $this->getDoctrine()->getRepository(VoltaireBareme::class)->findOneBy(['id' => $etudiant->getIdBareme()]);


     }

    /**
	* @Route("/etudiant/createModules")
	*/
	public function createModules(){
		$simplepath = (__DIR__)."\\../../public/simple.csv";
		$detailleespath = (__DIR__)."\\../../public/detaillees.csv";
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

		$fp1 = fopen($simplepath,"r");

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
	* @Route("/etudiant/createNiveaux")
	*/
	public function createNiveaux(){
		$simplepath = (__DIR__)."\\../../public/simple.csv";
		$detailleespath = (__DIR__)."\\../../public/detaillees.csv";
		
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
		
		$niveauArray =array();
		$rowNo2 = 1;
		$boolean2 = 0;
		$nomcolonnes2 = array();
		$info2 = array();
		$idNiveau = 1;
		//Variable pour communiquer avec la bdd
		$entityManager = $this->getDoctrine()->getManager();

		$fp2 = fopen($detailleespath,"r");

        // $fp is file pointer to file sample.csv

		if ($fp2 !== FALSE){

			while (($row2 = fgetcsv($fp2, 1000, ";")) !== FALSE){
            //Only 0 .  $num = count($row);
            //useless because CSV have one column and c is always only 0.  for($c=0 ; $c< $num; $c++){
			//explode va faire de str un array qui est row découpée: exemple 1;2;3;4;5 l'array "1","2", etc...
				if($boolean2 == 0){
					foreach ($row2 as $s2){// La premiere ligne contient les noms de colonnes
						array_push($nomcolonnes2,$s2);
						$boolean2++;
					}
					$nbColonnes2 = count($row2);
				}
				else{
					if(!in_array($row2[$niveau2], $niveauArray)){
						$niveau = new VoltaireNiveau();
						$niveau->setIdNiveau($idNiveau);
						$niveau->setNomNiveau($row2[$niveau2]);
						$entityManager->persist($niveau);
						array_push($niveauArray, $row2[$niveau2]);
						$idNiveau = $idNiveau +1 ;
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
		$simplepath = (__DIR__)."\\../../public/simple.csv";
		$detailleespath = (__DIR__)."\\../../public/detaillees.csv";
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
		$repository = $this->getDoctrine()->getRepository(VoltaireResultats::class);
		$fp1 = fopen($simplepath,"r");
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
					$resultat = $repository->findOneBy([
						'idEtudiant' => $row1[$identifiant1],
						'idModule' => 1,
					]);
					if($resultat->getScoreEvaluationInitiale() <= 25){
						$mod = 2;
					}
					elseif($resultat->getScoreEvaluationInitiale() >= 25 && $resultat->getScoreEvaluationInitiale() <= 60){
						$mod = 1;
					}
					elseif($resultat->getScoreEvaluationInitiale() >= 60){
						$mod = 3;
					}
					else{
						$mod = 1;
					}
					$etudiant = new VoltaireEtudiant();
					$etudiant->setNomEtudiant($row1[$nom1]);
					$etudiant->setPrenomEtudiant($row1[$prenom1]);
					$etudiant->setLogin($row1[$identifiant1]);
					$etudiant->setidBareme($mod);
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
		$simplepath = (__DIR__)."\\../../public/simple.csv";
		$detailleespath = (__DIR__)."\\../../public/detaillees.csv";
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
		$strnul = "";

	//Variable pour communiquer avec la bdd
		$entityManager = $this->getDoctrine()->getManager();
		$moduleRepository = $entityManager->getRepository(VoltaireModules::Class);
		$etudiantRepository = $entityManager->getRepository(VoltaireEtudiant::Class);

		$fp1 = fopen($simplepath, "r");

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
				$etudiant = $etudiantRepository->findOneBy(["login" => $row1[$identifiant1]]);
				if(!$etudiant){
					$etudiant = new VoltaireEtudiant();
					$etudiant->setNomEtudiant($row1[$nom1]);
					$etudiant->setPrenomEtudiant($row1[$prenom1]);
					$etudiant->setLogin($row1[$identifiant1]);
					$etudiant->setidBareme();
					$entityManager->persist($etudiant);
				}
				$module = $moduleRepository->findOneBy(["nomModule" => $row1[$module1]]);
				$resultat = new VoltaireResultats();	
				$resultat->setidEtudiant($row1[$identifiant1]);
				$resultat->setIdModule($module->getIdModule());

				if(strcmp($row1[$derniereutilisation1],$strnul) == 0){$resultat->setDerniereUtilisation(date_create_from_format("j/m/Y","0/0/0"));}
				else{$resultat->setDerniereUtilisation(date_create_from_format("j/m/Y",$row1[$derniereutilisation1]));}

				$resultat->setNiveauAtteint(intval($row1[$module1]));

				if(strcmp($row1[$tpsEntrainement1],$strnul) == 0){
					$resultat->setTpsEntrainement(date_create("0:0:0"));
				}
				else{
					$resultat->setTpsEntrainement(date_create($row1[$tpsEntrainement1]));
				}
				if(strcmp($row1[$tpsTotalpasse1],$strnul) == 0){
					$resultat->setTpsTotal(date_create("0:0:0"));
				}
				else{$resultat->setTpsTotal(date_create($row1[$tpsTotalpasse1]));}	
				$resultat->setInscription(date_create_from_format("j/m/Y",($row1[$inscription1])));
				$resultat->setUsageFixe(intval($row1[$usagefixe1]));
				$resultat->setUsageMobile(intval($row1[$usageMobile1]));
				if(strcmp($row1[$tempsEvaluation1],$strnul) == 0){
					$resultat->setTpsEvaluationInitiale(date_create("0:0:0"));
				}
				else{
					$resultat->setTpsEvaluationInitiale(date_create($row1[$tempsEvaluation1]));
				}
				$resultat->setScoreEvaluationInitiale(intval($row1[$scoreEvaluationInitiale1]));
				
				$resultat->setNiveauInitial(intval($row1[$niveauInitial1]));
				if(strcmp($row1[$dateCV],'') == 0){$resultat->setDateCV(date_create_from_format("j/m/Y","0/0/0"));}
				else{$resultat->setDateCV(date_create_from_format("j/m/Y",$row1[$dateCV]));}
				//Dire a doctrine qu'on veut faire des actions sur cet element(sauvegarder)
				$entityManager->persist($resultat);
				//Commit et push les evenements.
				

			}
			
			$rowNo1++;
		}
		set_time_limit(30);
		$entityManager->flush();
		fclose($fp1);
	}
	

	return new Response();
	
}
/**
	* @Route("/etudiant/createResultatsNiveaux")
	*/
	public function createResultatsNiveaux()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

	{
		$simplepath = (__DIR__)."\\../../public/simple.csv";
		$detailleespath = (__DIR__)."\\../../public/detaillees.csv";
		$rowNo1 = 1;
		$rowNo2 = 1;
		$boolean1 = 0;
		$boolean2 = 0;
		$nomcolonnes1 = array();
		$info1 = array();
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
		$strnul = "";

	//Variable pour communiquer avec la bdd
		$entityManager = $this->getDoctrine()->getManager();

		$fp1 = fopen($detailleespath, "r");

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
				$niveau = new VoltaireResultatNiveau();	
				$niveau->setIdEtudiant($row1[$identifiant2]);
				$niveau->setIdNiveau($row1[$niveau2]);
				if(strcmp($row1[$derniereutilisation2],$strnul) == 0){$niveau->setDerniereUtilisation(date_create_from_format("j/m/Y","0/0/0"));}
				else{$niveau->setDerniereUtilisation(date_create_from_format("j/m/Y",$row1[$derniereutilisation2]));}

				if(strcmp($row1[$tpsTotal2],$strnul) == 0){
					$niveau->setTpsTotal(date_create("0:0:0"));
				}
				else{$niveau->setTpsTotal(date_create($row1[$tpsTotal2]));}	
				$niveau->setNiveauAtteint(intval($row1[$niveauAtteint2]));
				$niveau->setScoreEvaluation(intval($row1[$scoreEvaluation2]));
				$niveau->setNote(intval($row1[$noteSur202]));
				//Dire a doctrine qu'on veut faire des actions sur cet element(sauvegarder)
				$entityManager->persist($niveau);
				//Commit et push les evenements.
				

			}
			
			$rowNo1++;
		}
		set_time_limit(30);
		$entityManager->flush();
		fclose($fp1);
	}
	

	return new Response();
	
}



    /**
	* @Route("/etudiant/createbycsv",name="Creation de la base de donnée")
	*/
	public function createByCSV()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

	{
		EtudiantController::createModules();
		EtudiantController::createResultats();
		EtudiantController::createEtudiants();
		EtudiantController::createNiveaux();
		EtudiantController::createResultatsNiveaux();

		return new Response();

	}

	/**
	* @Route("/etudiant/refreshCSVSIMPLE")
	*/
	public function refreshByCSVSimple()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

	{
		EtudiantController::deleteResultats();
		EtudiantController::createResultats();
		echo("Mise a jour des resultat à partir du fichier simple.csv terminé.");
		echo("<a href= \"http://localhost:8000/etudiant\" > Retourner sur la page d'accueil </a>");

		return new Response();

	}
	/**
	* @Route("/etudiant/refreshCSVDETAILLEES")
	*/
	public function refreshByCSVDetaillees()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

	{
		EtudiantController::deleteResultatsNiveaux();
		EtudiantController::createResultatsNiveaux();
		echo("Mise a jour des resultat à partir du fichier detaillees.csv terminé.");
		echo("<a href= \"http://localhost:8000/etudiant\" > Retourner sur la page d'accueil </a>");	

		return new Response();

	}



	/**
	* @Route("/etudiant/deleteResultats")
	*/
	public function deleteResultats()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

	{


	//Variable pour communiquer avec la bdd
		$entityManager = $this->getDoctrine()->getManager();	
		$sql = 'TRUNCATE TABLE voltaire_resultats' ; 
		$entityManager->getConnection()->prepare($sql)->execute();
		return new Response();

	}

	/**
	* @Route("/etudiant/deleteResultatsNiveaux")
	*/
	public function deleteResultatsNiveaux()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

	{


	//Variable pour communiquer avec la bdd
		$entityManager = $this->getDoctrine()->getManager();	
		$sql = 'TRUNCATE TABLE voltaire_resultat_niveau' ; 
		$entityManager->getConnection()->prepare($sql)->execute();
		return new Response();
	}
	/**
	* @Route("/etudiant/noterEtudiant/{identifiant}", methods={"GET","HEAD"})
	*/
	public function noterEtudiant($identifiant){
		$point = 0;
		$user = $this->getUser();
		$entityManager = $this->getDoctrine()->getManager();
		$baremeRepository = $entityManager->getRepository(VoltaireBareme::Class);
		$resultatRepository = $entityManager->getRepository(VoltaireResultats::Class);
		$resultatniveauRepository = $entityManager->getRepository(VoltaireResultatNiveau::Class);
		$etudiantRepository = $entityManager->getRepository(VoltaireEtudiant::Class);
		$critereRepository = $entityManager->getRepository(VoltaireCritere::Class);
		$etudiant = $etudiantRepository->findOneBy(["login" => $identifiant]);
		$bareme = $baremeRepository->findOneBy(["id" =>$etudiant->getIdBareme()]);
		$allbareme = $baremeRepository->findAll();
		$critere =  $critereRepository->findOneBy(["idCritere" =>$bareme->getIdCritere()]);
		$resultat = $resultatRepository->findOneBy(["idModule" => 1 , "idEtudiant" => $etudiant->getLogin()]);
		$resultatniveauinitial = $resultatniveauRepository->findOneBy(["idNiveau" => "Évaluation initiale" , "idEtudiant" => $etudiant->getLogin()]);
		$resultatniveaufinal = $resultatniveauRepository->findOneBy(["idNiveau" => "Évaluation finale" , "idEtudiant" => $etudiant->getLogin()]);
		if(!$resultatniveaufinal){
			$notersurFinal = 0;
		}
		else{$progression = $resultatniveaufinal->getScoreEvaluation() - $resultatniveauinitial->getScoreEvaluation(); $notersurFinal =1;}
		$niveauatteint = count($resultatniveauRepository->findBy(["idEtudiant" => $etudiant->getLogin()]));
		$tpsUtilisation = $resultat->getTpsTotal();
		$c1 = explode(";",$critere->getProgression());
		$c10 = explode(",",$c1[0]);
		$c11 = explode(",",$c1[1]);
		$c12 = explode(",",$c1[2]);
		$c13 = explode(",",$c1[3]);
		$c14 = explode(",",$c1[4]);
		$c2 = explode(";",$critere->getTpsUtilisation());
		$c20 = explode(",",$c2[0]);
		$c21 = explode(",",$c2[1]);
		$c22 = explode(",",$c2[2]);
		$c23 = explode(",",$c2[3]);
		$c24 = explode(",",$c2[4]);
		$c3 = explode(";",$critere->getNiveauAtteint());
		$c30 = explode(",",$c3[0]);
		$c31 = explode(",",$c3[1]);
		$c32 = explode(",",$c3[2]);
		$c33 = explode(",",$c3[3]);
		$c34 = explode(",",$c3[4]);

		if($notersurFinal == 0){
			$point += 0;
			$pointProgression = 0;
		} 
		else{ if($progression >= $c14[0]){
			$point += 5;
			$pointProgression = 5;
		}
		elseif($progression>=$c13[0] && $progression<$c13[1]){
			$point += 4;
			$pointProgression = 4;
		}
		elseif($progression>=$c12[0] && $progression<$c12[1]){
			$point += 3;
			$pointProgression = 3;
		}
		elseif($progression>=$c11[0] && $progression<$c11[1]){
			$point += 2;
			$pointProgression = 2;
		}
		elseif($progression>=$c10[0] && $progression<$c10[1]){
			$point += 1;
			$pointProgression = 1;
		}
		else{
			$point += 0;
			$pointProgression = 0;
		}}
		if($niveauatteint >= $c34[0]){
			$point += 5;
			$pointNiveau = 5;
		}
		elseif($niveauatteint>=$c33[0] && $niveauatteint<$c33[1]){
			$point += 4;
			$pointNiveau = 4;
		}
		elseif($niveauatteint>=$c32[0] && $niveauatteint<$c32[1]){
			$point += 3;$pointNiveau = 3;
		}
		elseif($niveauatteint>=$c31[0] && $niveauatteint<$c31[1]){
			$point += 2;$pointNiveau = 2;
		}
		elseif($niveauatteint>=$c30[0] && $niveauatteint<$c30[1]){
			$point += 1;$pointNiveau = 1;
		}
		else{
			$point += 0;$pointNiveau = 0;
		}


		if(date_format($tpsUtilisation,"H:i:s") >= gmdate('H:i:s', strval($c24[0]) * 60)){
			$point += 5;
			$pointTps = 5;
		}
		elseif(date_format($tpsUtilisation,"H:i:s")>=gmdate('H:i:s', strval($c23[0]) * 60) && date_format($tpsUtilisation,"H:i:s")<gmdate('H:i:s', strval($c23[1]) * 60)){
			$point += 4;
			$pointTps = 4;
		}
		elseif(date_format($tpsUtilisation,"H:i:s")>=gmdate('H:i:s', strval($c22[0]) * 60) && date_format($tpsUtilisation,"H:i:s")<gmdate('H:i:s', strval($c22[1]) * 60)){
			$point += 3;
			$pointTps = 3;
		}
		elseif(date_format($tpsUtilisation,"H:i:s")>=gmdate('H:i:s', strval($c21[0]) * 60) && date_format($tpsUtilisation,"H:i:s")<gmdate('H:i:s', strval($c21[1]) * 60)){
			$point += 2;
			$pointTps = 2;
		}
		elseif(date_format($tpsUtilisation,"H:i:s")>=gmdate('H:i:s', strval($c20[0]) * 60) && date_format($tpsUtilisation,"H:i:s")<gmdate('H:i:s', strval($c20[1]) * 60)){
			$point += 1;
			$pointTps = 1;
		}
		else{
			$point += 0;
			$pointTps = 0;
		}

		$tps =  $resultat->getTpsTotal()->format('H:i:s');

		return $this->render('etudiant/etudiant.html.twig', [
			'etudiant' => $etudiant,
			'resultat' => $resultat,
			'tps' => $tps,
			'bareme' => $bareme,
			'notetotale' => $point,
			'pointProgression' => $pointProgression,
			'pointNiveau' => $pointNiveau,
			'pointUtilisation' => $pointTps,
			'noterResultatFinal' => $notersurFinal,
			"niveauatteint" => $niveauatteint,
			'allbareme' => $allbareme,
			'user' => $user
		]);
	}

	public function avoirNoteEtudiant($identifiant){
		$point = 0;
		$user = $this->getUser();
		$entityManager = $this->getDoctrine()->getManager();
		$baremeRepository = $entityManager->getRepository(VoltaireBareme::Class);
		$resultatRepository = $entityManager->getRepository(VoltaireResultats::Class);
		$resultatniveauRepository = $entityManager->getRepository(VoltaireResultatNiveau::Class);
		$etudiantRepository = $entityManager->getRepository(VoltaireEtudiant::Class);
		$critereRepository = $entityManager->getRepository(VoltaireCritere::Class);
		$etudiant = $etudiantRepository->findOneBy(["login" => $identifiant]);
		$bareme = $baremeRepository->findOneBy(["id" =>$etudiant->getIdBareme()]);
		$allbareme = $baremeRepository->findAll();
		$critere =  $critereRepository->findOneBy(["idCritere" =>$bareme->getIdCritere()]);
		$resultat = $resultatRepository->findOneBy(["idModule" => 1 , "idEtudiant" => $etudiant->getLogin()]);
		$resultatniveauinitial = $resultatniveauRepository->findOneBy(["idNiveau" => "Évaluation initiale" , "idEtudiant" => $etudiant->getLogin()]);
		$resultatniveaufinal = $resultatniveauRepository->findOneBy(["idNiveau" => "Évaluation finale" , "idEtudiant" => $etudiant->getLogin()]);
		if(!$resultatniveaufinal){
			$notersurFinal = 0;
		}
		else{$progression = $resultatniveaufinal->getScoreEvaluation() - $resultatniveauinitial->getScoreEvaluation(); $notersurFinal =1;}
		$niveauatteint = count($resultatniveauRepository->findBy(["idEtudiant" => $etudiant->getLogin()]));
		$tpsUtilisation = $resultat->getTpsTotal();
		$c1 = explode(";",$critere->getProgression());
		$c10 = explode(",",$c1[0]);
		$c11 = explode(",",$c1[1]);
		$c12 = explode(",",$c1[2]);
		$c13 = explode(",",$c1[3]);
		$c14 = explode(",",$c1[4]);
		$c2 = explode(";",$critere->getTpsUtilisation());
		$c20 = explode(",",$c2[0]);
		$c21 = explode(",",$c2[1]);
		$c22 = explode(",",$c2[2]);
		$c23 = explode(",",$c2[3]);
		$c24 = explode(",",$c2[4]);
		$c3 = explode(";",$critere->getNiveauAtteint());
		$c30 = explode(",",$c3[0]);
		$c31 = explode(",",$c3[1]);
		$c32 = explode(",",$c3[2]);
		$c33 = explode(",",$c3[3]);
		$c34 = explode(",",$c3[4]);

		if($notersurFinal == 0){
			$point += 0;
			$pointProgression = 0;
		} 
		else{ if($progression >= $c14[0]){
			$point += 5;
			$pointProgression = 5;
		}
		elseif($progression>=$c13[0] && $progression<$c13[1]){
			$point += 4;
			$pointProgression = 4;
		}
		elseif($progression>=$c12[0] && $progression<$c12[1]){
			$point += 3;
			$pointProgression = 3;
		}
		elseif($progression>=$c11[0] && $progression<$c11[1]){
			$point += 2;
			$pointProgression = 2;
		}
		elseif($progression>=$c10[0] && $progression<$c10[1]){
			$point += 1;
			$pointProgression = 1;
		}
		else{
			$point += 0;
			$pointProgression = 0;
		}}
		if($niveauatteint >= $c34[0]){
			$point += 5;
			$pointNiveau = 5;
		}
		elseif($niveauatteint>=$c33[0] && $niveauatteint<$c33[1]){
			$point += 4;
			$pointNiveau = 4;
		}
		elseif($niveauatteint>=$c32[0] && $niveauatteint<$c32[1]){
			$point += 3;$pointNiveau = 3;
		}
		elseif($niveauatteint>=$c31[0] && $niveauatteint<$c31[1]){
			$point += 2;$pointNiveau = 2;
		}
		elseif($niveauatteint>=$c30[0] && $niveauatteint<$c30[1]){
			$point += 1;$pointNiveau = 1;
		}
		else{
			$point += 0;$pointNiveau = 0;
		}


		if(date_format($tpsUtilisation,"H:i:s") >= gmdate('H:i:s', strval($c24[0]) * 60)){
			$point += 5;
			$pointTps = 5;
		}
		elseif(date_format($tpsUtilisation,"H:i:s")>=gmdate('H:i:s', strval($c23[0]) * 60) && date_format($tpsUtilisation,"H:i:s")<gmdate('H:i:s', strval($c23[1]) * 60)){
			$point += 4;
			$pointTps = 4;
		}
		elseif(date_format($tpsUtilisation,"H:i:s")>=gmdate('H:i:s', strval($c22[0]) * 60) && date_format($tpsUtilisation,"H:i:s")<gmdate('H:i:s', strval($c22[1]) * 60)){
			$point += 3;
			$pointTps = 3;
		}
		elseif(date_format($tpsUtilisation,"H:i:s")>=gmdate('H:i:s', strval($c21[0]) * 60) && date_format($tpsUtilisation,"H:i:s")<gmdate('H:i:s', strval($c21[1]) * 60)){
			$point += 2;
			$pointTps = 2;
		}
		elseif(date_format($tpsUtilisation,"H:i:s")>=gmdate('H:i:s', strval($c20[0]) * 60) && date_format($tpsUtilisation,"H:i:s")<gmdate('H:i:s', strval($c20[1]) * 60)){
			$point += 1;
			$pointTps = 1;
		}
		else{
			$point += 0;
			$pointTps = 0;
		}

		$tps =  $resultat->getTpsTotal()->format('H:i:s');

		return $point;
	}


	/**
	* @Route("/etudiant/uploadCSV")
	*/
	public function uploadCSV()

	{
		require_once 'C:\Users\rcada\OneDrive\Bureau\VoltaireQ2Project\templates\etudiant\upload.html' ; 

		return new Response();

	}

	/**
	* @Route("/etudiant/upload")
	*/
	public function upload()

	{

		$target_dir = "./";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists and replace
		if (file_exists($target_file)) {
			echo "Désolé, le fichier existe déjà.";
			$uploadOk = 0;
		}
// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Désolé, le fichier est trop grand";
			$uploadOk = 0;
		}
// Allow certain file formats
		if($imageFileType != "csv"){
			echo "Désolé, nous n'acceptons que les fichiers .csv";
			$uploadOk = 0;
		}
// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Désolé, votre fichier n'a pas été exporté.";
// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a bien été exporté. Veuillez patienter le temps que nous mettons a jour la base de donnée... <br>";
				if(preg_match('/\bdetaillees\b/', $_FILES["fileToUpload"]["name"])){
					rename($_FILES["fileToUpload"]["name"],"detaillees.csv");
					EtudiantController::refreshByCSVDetaillees();
				}
				elseif(preg_match('/\bsimples\b/', $_FILES["fileToUpload"]["name"])){
					rename($_FILES["fileToUpload"]["name"],"simple.csv");
					EtudiantController::refreshByCSVSimple();
				}

			} else {
				echo "Désolé, il y a eu une erreur pendant le chargement de votre fichier";
			}
		}
		return new Response();
	}

	/**
	* @Route("/etudiant/changerBareme/{identifiant}",methods={"GET","HEAD"})
	*/
	public function changerBareme($identifiant)

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

	{


	//Variable pour communiquer avec la bdd
		$entityManager = $this->getDoctrine()->getManager();
		$nomBareme = $_GET["nomBareme"];
		$baremeRepository = $entityManager->getRepository(VoltaireBareme::Class);
		$etudiantRepository = $entityManager->getRepository(VoltaireEtudiant::Class);
		$etudiant = $etudiantRepository->findOneBy(["login" => $identifiant]);
		$etudiant->setIdBareme($baremeRepository->findOneBy(["nomBareme" => $nomBareme])->getId());
		$entityManager->persist($etudiant);
		$entityManager->flush();
		echo("Bareme de l'étudiant" . $identifiant . " modifié pour le bareme " . $nomBareme);
		echo("<a href=\"http://localhost:8000/etudiant/noterEtudiant/" . $identifiant . "\" > Retourner sur sa page </a>");

		return new Response();

	}

}
