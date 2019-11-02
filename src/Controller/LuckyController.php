<?php
// src/Controller/LuckyController.php
namespace App\Controller;


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
{
	$rowNo = 1;
	$boolean = 0;
	$nomcolonnes = array();
	$info = array();
        // $fp is file pointer to file sample.csv
	if (($fp = fopen("C:\\Users\\rcada\\OneDrive\\Bureau\\VoltaireQ2Project\\VoltaireQ2Project\\src\\Controller\\data.csv", "r")) !== FALSE) {
		while (($row = fgetcsv($fp, 1000, ";")) !== FALSE) {
            //Only 0 .  $num = count($row);
            //useless because CSV have one column and c is always only 0.  for($c=0 ; $c< $num; $c++){
			$str = explode(";", $row[0]);
			if($boolean == 0){
				foreach ($str as $s) {
					array_push($nomcolonnes,$s);
					$boolean++;
				}
			}
			$rowexploded = count($str);
			$donnees = array();
			echo "<p> Line $rowNo <br /></p>\n";
			if($rowNo>1){
				for ($c=0; $c < $rowexploded; $c++) {
					array_push($donnees,$str[$c]);
					echo "$str[$c]<br>";
				}
			}
			array_push($info, $donnees);
			
			$rowNo++;
		}
		fclose($fp);
	}
	$file = fopen("C:\\Users\\rcada\\OneDrive\\Bureau\\VoltaireQ2Project\\VoltaireQ2Project\\src\\Controller\\result.csv", "w");
	foreach ($info as $ligne) {
		fputcsv($file, $ligne);
	}
	fclose($file);

}
}?>