<?php 


if(isset($_POST['Recherche'])) { 

					$date = mktime(0, 0, 0, $_POST['mois'],$_POST['jour'], $_POST['annee']);
					$jour=date("l", $date);
					$jour_num=date("d" ,$date);
					
					$joursem = array('dimanche','lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');	
					$mois_nom=array('','janvier','février','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
echo"Votre jour de départ est le ".$joursem[$jour_num]." ".$_POST['jour']."<br/> du mois de ".$mois_nom[$_POST['mois']]." ".$_POST['annee']."<br/>";

    $bdd = mysql_connect ('localhost', 'root', '');// On ce connecte a la BDD  
    mysql_select_db ('projet_bdd', $bdd); //

$sql = "SELECT DISTINCT v.num_vol as VOL,UPPER(a.nom) as DEPART,UPPER(b.nom) as ARRIVEE,v.heure_depart, v.temps_vol as DUREE, a.fuseau as fuseau_depart, b.fuseau as fuseau_arrivee FROM vol v 
INNER JOIN aeroport a ON a.code_aeroport=v.aeroport_depart 
INNER JOIN aeroport b ON b.code_aeroport=v.aeroport_arrivee 
WHERE (a.ville = '".$_POST["depart"]."'  or v.aeroport_depart = '".$_POST["depart"]."') and (b.ville = '".$_POST["arrivee"]."' or v.aeroport_arrivee = '".$_POST["arrivee"]."' ) AND INSTR(jours, '".$jour_num."') != 0 ";

$resultat=mysql_query($sql) or die ('erreur bdd :<br>'.$sql.'<br>'.mysql_error());//On lance la requete et on demande d'afficher l'erreur si il y a.

	$nbLigne=mysql_num_rows($resultat);





	}

?> <tbody>

   <tr>

<?php

for($i=0;$i<$nbLigne,$reponse = mysql_fetch_assoc($resultat);$i++)
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


mysql_close();
?>


