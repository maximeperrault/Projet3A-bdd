<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<link rel="stylesheet" href="AirEsiea.css" />
		<title>AirEsiea.com</title>
		<style type='text/css'>
			td.headcol {width:auto;}
 		</style>
	</head>
	
	<body>
		<header>
			<img src="img/Logo.png" alt="Logo" id="Logo" >
		</header>
		
		<?php
		
if(isset($_POST['Recherche'])) { 

$verif=0;


	if(isset($_POST['depart']) && isset($_POST['arrivee']) && isset($_POST['annee']) && isset($_POST['mois']) && isset($_POST['jour'])) { // existence
		
		if(!empty($_POST['depart']) && !empty($_POST['arrivee']) && !empty($_POST['annee']) && !empty($_POST['mois']) && !empty($_POST['jour'])) {// non-vide
			
			if($_POST['jour']<=31 && $_POST['jour']>=1 && $_POST['mois']>=1 && $_POST['mois']<=12 && $_POST['annee']>=2000 && $_POST['annee']<=3000) {// bornes
			
				if(checkdate($_POST['jour'],$_POST['mois'], $_POST['annee'])) // cohérence de la date
				{
					$jour=date("l", mktime(0, 0, 0, $_POST['mois'],$_POST['jour'], $_POST['annee']));
					$jour_num=date("N" ,mktime(0, 0, 0, $_POST['mois'],$_POST['jour'], $_POST['annee']));
					
					$joursem = array('dimanche','lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');	
					$mois_nom=array('','janvier','février','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');


					//echo'Votre jour de départ est le '.$joursem[$jour_num].' '.$_POST["jour"].'<br/> du mois de '.$mois_nom[$_POST["mois"]].' '.$_POST["annee"].'<br/>';
				
$verif=1;

				}
			}
$bdd = new PDO('mysql:host=localhost;dbname=projetbdd', 'root', ''); // connexion en PDO à la base de donnée mysql

$sql = "SELECT DISTINCT v.num_vol as VOL,a.nom as DEPART,b.nom as ARRIVEE,v.heure_depart, v.temps_vol as DUREE, a.fuseau as fuseau_depart, b.fuseau as fuseau_arrivee FROM vol v 
INNER JOIN aeroport a ON a.code_aeroport=v.aeroport_depart 
INNER JOIN aeroport b ON b.code_aeroport=v.aeroport_arrivee 
WHERE (a.ville = ? or v.aeroport_depart = ?) and (b.ville = ? or v.aeroport_arrivee = ?) AND INSTR(jours, :jour_num) != 0 ";


$sql = $bdd->prepare($sql); // prepare la requête 
$sql->execute(array('depart' => $_POST["depart"], 'arrivee' => $_POST["arrivee"], 'jour_num' => $jour_num));// envoie la requête

$nbLigne = $sql -> rowCount();
$reponse = $sql -> fetch(); // affiche ligne par ligne
		}	
	}
}
?> <section><tbody>

   <tr>

<?php

for($i=0;$i<$nbLigne,$reponse;$i++)
    {
?>
  <td >  <?php  echo $reponse['num_vol']; ?> <td/>  

  <td >  <?php	echo $reponse['DEPART']; ?> <td/>

  <td >	 <?php	echo $reponse['ARRIVEE']; ?> <td/>
		
  <td >	 <?php	echo $reponse['heure_depart']; ?> <td/>	

	 <?php  $duration_min = $reponse['DUREE']%60;

  	        $duration_heure = (int)($reponse['DUREE']/60);
								//Affichage de la durée
	if($duration_min<10) {

		echo $duration_heure.":0".$duration_min;

        } else {

		echo $duration_heure.":".$duration_min;
	       }

 	?>	
  <td >	<?php

	list($heure, $min, $sec) = explode(":", $reponse['heure_depart']); //on separe 
						
	$min_final=($reponse['DUREE']+$min) % 60;	

	$heure_final=(int)((($reponse['DUREE']+$min)/60)+$heure+$reponse['fuseau_depart']+$reponse['fuseau_arrive'])%24;
						
	//Affichage de l'heure d'arrivée dans le fuseau horaire de l'arrivee

	if($min_final<10) {

		echo $heure_final.":0".$min_final;

	} else {

		echo $heure_final.":".$min_final;
		}					
	?>

 <td/>
<td> <!-- COMPAGNIE AERIENNE --> <td/>
 <tr/> 

<tbody/>
 <?php			
	}


$sql->closeCursor(); // ferme la requête 
?>


