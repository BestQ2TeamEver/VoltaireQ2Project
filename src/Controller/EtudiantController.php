<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etudiant;

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
	* @Route("/etudiant/createbycsv")
	*/
	public function create()

//Cette fonction lit le fichier csv Complexe de base et le découpe en objet ligne corespondant aux informations des etudiants, qui sont ensuite sauvegardées dans un fichier csv (Pas vraiment fonctionnel) et sauvegardés dans la bdd.

{
	$rowNo = 1;
	$boolean = 0;
	$nomcolonnes = array();
	$info = array();

	//zone de declaration des colonnes de l'objet
	$sphère = "";
	$groupe = "";
	$nom = "";
	$prenom = "";
	$identifiant = "";
	$inscription = "";
	$module = "";
	$dernutilisation = "";
	$tempstotal = "";
	$usagefixe = "";
	$usagemobile = "";
	$scoreevalinit = "";
	$tmpsevaluationinit = "";
	$niveauinit = "";
	$tmpentrainement = "";
	$niveauatteint = "";
	$dateCV = "";

	//Variable pour communiquer avec la bdd
	$entityManager = $this->getDoctrine()->getManager();

        // $fp is file pointer to file sample.csv
	if (($fp1 = fopen((__DIR__)."\\datasimple.csv", "r") && ($fp2 = fopen((__DIR__)."\\datadetail.csv","r"))) !== FALSE) {
		while (($row = fgetcsv($fp1, 1000, ";")) !== FALSE) {
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
				$etudiant = new Etudiant();
				$etudiant->setGroupe($str[1]);
				$etudiant->setIdentifiant($str[4]);
				$etudiant->setNom($str[2]);
				$etudiant->setPrenom($str[3]);
				$etudiant->setSphere($str[0]);
				$etudiant->setModule($str[6]);
				$etudiant->setDerniereUtilisation($str[7]);
				$etudiant->setNiveauAtteint($str[13]);
				$etudiant->setTempsEntrainement($str[14]);
				$etudiant->setTempsTotal($str[8]);
				$etudiant->setInscription($str[5]);
				$etudiant->setUsageFixe($str[9]);
				$etudiant->setUsageMobile($str[10]);
				$etudiant->setScoreEvalutationInitiale($str[11]);
				$etudiant->setTempsEvaluationInitiale($str[12]);
				$etudiant->setNiveauInitial($str[13]);
				$etudiant->setDateCV($str[16]);
				//Dire a doctrine qu'on veut faire des actions sur cet element(sauvegarder)
				$entityManager->persist($etudiant);
				//Commit et push les evenements.
				$entityManager->flush();

			}
			
			$rowNo++;
		}
		fclose($fp);
		echo($rowNo);
	}
	

	return new Response();
	

}
/**
	* @Route("/etudiant/refreshbycsv")
	*/
	public function refresh()

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
	$time = $time+1;
	sleep(20);
}

	

	return new Response();
	

}
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
