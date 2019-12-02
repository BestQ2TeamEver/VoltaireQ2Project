<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\VoltaireCritere;
use App\Entity\VoltaireBareme;

class BaremeController extends AbstractController
{
    /**
     * @Route("/bareme", name="bareme")
     */
    public function index()
    {
    	return $this->render('bareme/index.html.twig', [
    		'controller_name' => 'BaremeController',
    	]);
    }

    /**
     * @Route("/bareme/creerbareme", name="creer bareme")
     */
    public function creerbareme()
    {
    	require_once 'C:\Users\rcada\OneDrive\Bureau\VoltaireQ2Project\templates\etudiant\bareme.php';
    	return new Response();
    }

    /**
     * @Route("/bareme/verifybareme", name="verifier bareme")
     */
    public function verifybareme()
    {
    	$paramfin1 = $_GET['1param52'];
    	$paramfin2 = $_GET['2param52'];
    	$paramfin3 = $_GET['3param52'];

    	if((strcmp($_GET['1param52'],"") == 0) || (strcmp($_GET['2param52'],"") == 0) || (strcmp($_GET['3param52'],"") == 0)){
    		if(!($_GET['1param11'] < $_GET['1param12']) || !($_GET['1param12'] <= $_GET['1param21']) || !($_GET['1param21'] < $_GET['1param22']) || !($_GET['1param22'] <= $_GET['1param31']) || !($_GET['1param31'] < $_GET['1param32']) ||!($_GET['1param32'] <= $_GET['1param41']) || !($_GET['1param41'] < $_GET['1param42']) || !($_GET['1param42'] <= $_GET['1param51']) ||
    		!($_GET['2param11'] < $_GET['2param12']) || !($_GET['2param12'] <= $_GET['2param21']) || !($_GET['2param21'] < $_GET['2param22']) || !($_GET['2param22'] <= $_GET['2param31']) || !($_GET['2param31'] < $_GET['2param32']) ||!($_GET['2param32'] <= $_GET['2param41']) || !($_GET['2param41'] < $_GET['2param42']) || !($_GET['2param42'] <= $_GET['2param51']) ||
    		!($_GET['3param11'] < $_GET['3param12']) || !($_GET['3param12'] <= $_GET['3param21']) || !($_GET['3param21'] < $_GET['3param22']) || !($_GET['3param22'] <= $_GET['3param31']) || !($_GET['3param31'] < $_GET['3param32']) ||!($_GET['3param32'] <= $_GET['3param41']) || !($_GET['3param41'] < $_GET['3param42']) || !($_GET['3param42'] <= $_GET['3param51'])){
    			echo("Il y a un problème !, la création du barème est impossible, reessayez.");
    		echo ("<a href= http://localhost:8000/bareme/creerbareme> Recreer un bareme ! </a>");
    		}else{
    			BaremeController::verifiedbareme();
    		}
    	}
    	elseif((strcmp($_GET['1param12'],"") == 0) || (strcmp($_GET['1param22'],"") == 0) || (strcmp($_GET['1param32'],"") == 0) || (strcmp($_GET['1param42'],"") == 0)  ||
    		(strcmp($_GET['2param12'],"") == 0) || (strcmp($_GET['2param22'],"") == 0) || (strcmp($_GET['2param32'],"") == 0) || (strcmp($_GET['2param42'],"") == 0)  ||
    		(strcmp($_GET['3param12'],"") == 0) || (strcmp($_GET['3param22'],"") == 0)|| (strcmp($_GET['3param32'],"") == 0) || (strcmp($_GET['3param42'],"") == 0)) {
    		echo("Il y a un problème !, la création du barème est impossible, reessayez.");
    		echo ("<a href= http://localhost:8000/bareme/creerbareme> Recreer un bareme ! </a>");}	
    	elseif( !($_GET['1param11'] < $_GET['1param12']) || !($_GET['1param12'] <= $_GET['1param21']) || !($_GET['1param21'] < $_GET['1param22']) || !($_GET['1param22'] <= $_GET['1param31']) || !($_GET['1param31'] < $_GET['1param32']) ||!($_GET['1param32'] <= $_GET['1param41']) || !($_GET['1param41'] < $_GET['1param42']) || !($_GET['1param42'] <= $_GET['1param51']) || !($_GET['1param51'] < $_GET['1param52']) || 
    		!($_GET['2param11'] < $_GET['2param12']) || !($_GET['2param12'] <= $_GET['2param21']) || !($_GET['2param21'] < $_GET['2param22']) || !($_GET['2param22'] <= $_GET['2param31']) || !($_GET['2param31'] < $_GET['2param32']) ||!($_GET['2param32'] <= $_GET['2param41']) || !($_GET['2param41'] < $_GET['2param42']) || !($_GET['2param42'] <= $_GET['2param51']) || !($_GET['2param51'] < $_GET['2param52']) || 
    		!($_GET['3param11'] < $_GET['3param12']) || !($_GET['3param12'] <= $_GET['3param21']) || !($_GET['3param21'] < $_GET['3param22']) || !($_GET['3param22'] <= $_GET['3param31']) || !($_GET['3param31'] < $_GET['3param32']) ||!($_GET['3param32'] <= $_GET['3param41']) || !($_GET['3param41'] < $_GET['3param42']) || !($_GET['3param42'] <= $_GET['3param51']) || !($_GET['3param51'] < $_GET['1param52'])){
    		echo("Il y a un problème avec l'attribution des critères, avez vous bien vérifié que tous les criteres sont dans l'ordre croissant?");
    		echo ("<a href= http://localhost:8000/bareme/creerbareme> Recreer un bareme ! </a>");
    	}	
    	else{
    		echo("bareme verifié");
    		BaremeController::verifiedbareme();
    	}

    	return new Response();
    }


    public function verifiedBareme(){
    	$paramfin1 = $_GET['1param52'];
    	$paramfin2 = $_GET['2param52'];
    	$paramfin3 = $_GET['3param52'];
    	echo("Etes vous sur de vouloir creer le barême ");
    	if(isset($_GET['favori'])){echo("(mis en favori)");
    		}
    		echo(" avec : <br> <ul>"); 
    		echo("<li> Pour la progression : <ul>" );
    		echo("<li> 1pt attribué pour une progression de " . $_GET['1param11'] . "% à " . $_GET['1param12'] . "%.");
    		echo("<li> 2pts attribués pour une progression de " . $_GET['1param21'] . "% à " . $_GET['1param22'] . "%.");
    		echo("<li> 3pts attribués pour une progression de " . $_GET['1param31'] . "% à " . $_GET['1param32'] . "%.");
    		echo("<li> 4pts attribués pour une progression de " . $_GET['1param41'] . "% à " . $_GET['1param42'] . "%.");
    		if(strcmp($paramfin1,"") == 0){
    			echo("<li> 5pts attribué pour une progression supérieure à  " . $_GET['1param51'] . "%. </ul>");
    		}
    		else { echo("<li> 5pts attribué pour une progression de " . $_GET['1param51'] . "% à " . $_GET['1param52'] . "%. </ul>");} 
    		echo("<li> Pour le temps d'entrainement : <ul> ");
    		echo("<li> 1pt attribué pour un temps total de " . $_GET['2param11'] . "minutes à " . $_GET['2param12'] . "minutes.");
    		echo("<li> 2pts attribués pour un temps total de " . $_GET['2param21'] . "minutes à " . $_GET['2param22'] . "minutes.");
    		echo("<li> 3pts attribués pour un temps total de " . $_GET['2param31'] . "minutes à " . $_GET['2param32'] . "minutes.");
    		echo("<li> 4pts attribués pour un temps total de " . $_GET['2param41'] . "minutes à " . $_GET['2param42'] . "minutes.");
    		if(strcmp($paramfin2,"") == 0){
    			echo("<li> 5pts attribués pour un temps total de plus de " . $_GET['2param51'] . "minutes. </ul>");
    		}
    		else{
    			echo("<li> 5pts attribués pour un temps total de " . $_GET['2param51'] . "minutes à " . $_GET['2param52'] . "minutes. </ul>");
    		}
    		echo("<li> Pour les nombres de niveau acquis : <ul>" );
    		echo("<li> 1pt attribué pour un nombre de niveau acquis entre " . $_GET['3param11'] . " et " . $_GET['3param12'] . ".");
    		echo("<li> 2pts attribué pour un nombre de niveau acquis entre " . $_GET['3param21'] . " et " . $_GET['3param22'] . ".");
    		echo("<li> 3pts attribué pour un nombre de niveau acquis entre " . $_GET['3param31'] . " et " . $_GET['3param32'] . ".");
    		echo("<li> 4pts attribué pour un nombre de niveau acquis entre " . $_GET['3param41'] . " et " . $_GET['3param42'] . ".");
    		if(strcmp($paramfin3,"") == 0){
    			echo("<li> 5pts attribué pour un nombre de niveau acquis supérieur à " . $_GET['3param51'] . " . </ul> ");
    		}
    		else{
    			echo("<li> 5pts attribué pour un nombre de niveau acquis entre " . $_GET['3param51'] . " et " . $_GET['3param52'] . ". </ul>");
    		}

    		echo("</ul>");

    		if(array_key_exists('Valider', $_POST)) { 
            BaremeController::validerBareme(); 
        	} 

        	echo("<form method=\"post\"> 
        <input type=\"submit\" name=\"Valider\"
                class=\"button\" value=\"Valider\" /> 
    </form> ");
    }
    public function reformulerCriteres(){
    	$criteres = array();
    	$critere1 = strval($_GET['1param11']) .",". strval($_GET['1param12']).";" .  strval($_GET['1param21']) . ",".  strval($_GET['1param22']) . ";" .  strval($_GET['1param31']) .",".  strval($_GET['1param32']) .";".  strval($_GET['1param41']) . "," .  strval($_GET['1param42']) .";".  strval($_GET['1param51']) .",". strval($_GET['1param52']);
    	$critere2 = strval($_GET['2param11']) .",". strval($_GET['2param12']).";" .  strval($_GET['2param21']) . ",".  strval($_GET['2param22']) . ";" .  strval($_GET['2param31']) .",".  strval($_GET['2param32']) .";".  strval($_GET['2param41']) . "," .  strval($_GET['2param42']) .";".  strval($_GET['2param51']) .",". strval($_GET['2param52']);
    	$critere3 = strval($_GET['3param11']) .",". strval($_GET['3param12']).";" .  strval($_GET['3param21']) . ",".  strval($_GET['3param22']) . ";" .  strval($_GET['3param31']) .",".  strval($_GET['3param32']) .";".  strval($_GET['3param41']) . "," .  strval($_GET['3param42']) .";".  strval($_GET['3param51']) .",". strval($_GET['3param52']);
    	array_push($criteres, $critere1);
    	array_push($criteres, $critere2);
    	array_push($criteres, $critere3);
    	return $criteres;
    }
    
    public function validerBareme(){ 
    	if(isset($_GET['favori'])){$favori = 1;}
    	else{$favori=0;}
    		$entityManager = $this->getDoctrine()->getManager();
    		$repository = $this->getDoctrine()->getRepository(VoltaireCritere::class);
            $criteres = BaremeController::reformulerCriteres();
            $critere = new VoltaireCritere();
            $critere->setProgression($criteres[0]);
            $critere->setTpsUtilisation($criteres[1]);
            $critere->setNiveauAtteint($criteres[2]);
            $critere->setEvaluationFinale(20);
            $entityManager->persist($critere);
            $entityManager->flush();
            $product = $repository->findOneBy([
            	'progression' => $criteres[0],
            	'tpsUtilisation' => $criteres[1],
            	'niveauAtteint' => $criteres[2],
            ]);
            $bareme = new VoltaireBareme();
            $bareme->setNomBareme($_GET['nom']);
            $bareme->setFavoriBareme($favori);
            $bareme->setIdCritere( $product->getIdCritere());
            $entityManager->persist($bareme);
            $entityManager->flush();
            echo("Bareme validé ! <a href= \"http://localhost:8000/etudiant\" > Retourner sur la page d'accueil </a>");

        }

    public function nextIdCritere(){
    	return $repository->createQueryBuilder('u')
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult();
    } 

}
