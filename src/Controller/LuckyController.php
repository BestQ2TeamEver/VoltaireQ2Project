<?php
// src/Controller/LuckyController.php
namespace App\Controller;
require_once 'C:\Users\rcada\OneDrive\Bureau\VoltaireQ2Project\VoltaireQ2Project\src\model\ModelEtudiantComplexe.php';


//Les importations de Sympfony
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class LuckyController extends AbstractController
{
	//La route correspond a l'adresse url a entrer pour y acceder
/**
* @Route("/lucky/number")
*/
public function number()

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

        // $fp is file pointer to file sample.csv
	if (($fp = fopen("C:\\Users\\rcada\\OneDrive\\Bureau\\VoltaireQ2Project\\VoltaireQ2Project\\src\\Controller\\data.csv", "r")) !== FALSE) {
		while (($row = fgetcsv($fp, 1000, ";")) !== FALSE) {
            //Only 0 .  $num = count($row);
            //useless because CSV have one column and c is always only 0.  for($c=0 ; $c< $num; $c++){
			$str = explode(";", $row[0]);
			//explode va faire de str un array qui est row découpée: exemple 1;2;3;4;5 l'array "1","2", etc...
			if($boolean == 0){
				foreach ($str as $s) {
					array_push($nomcolonnes,$s);
					$boolean++;
				}
			}
			$nbColonnes = count($str);
			
			
			array_push($info, $str);
			
			$rowNo++;
		}
		fclose($fp);
	}
	$file = fopen("C:\\Users\\rcada\\OneDrive\\Bureau\\VoltaireQ2Project\\VoltaireQ2Project\\src\\Controller\\result.csv", "w");
	foreach ($info as $ligne) {
		fputcsv($file, $ligne);
	}
	fclose($file);
	foreach ($info as $ligne) {

			$sphère = $ligne[0];
			$groupe = $ligne[1];
			$nom = $ligne[2];
			$prenom = $ligne[3];
			$identifiant = $ligne[4];
			$inscription = $ligne[5];
			$module = $ligne[6];
			$dernutilisation = $ligne[7];
			$tempstotal = $ligne[8];
			$usagefixe = $ligne[9];
			$usagemobile = $ligne[10];
			$scoreevalinit = $ligne[11];
			$tmpsevaluationinit = $ligne[12];
			$niveauinit = $ligne[13];
			$tmpentrainement = $ligne[14];
			$niveauatteint = $ligne[15];
			$dateCV = $ligne[16];
			$model1 = new ModelEtudiantComplexe($sphère,$groupe,$nom,$prenom,$identifiant,$inscription,$module,$dernutilisation,$tempstotal,$usagefixe,$usagemobile,$scoreevalini,$tmpsevaluationinit,$niveauinit,$tmpentrainement,$niveauatteint,$dateCV);
	}

}
}?>