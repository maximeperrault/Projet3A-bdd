<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Projet Bdd</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		  <link rel="stylesheet" href="style2.css" />
		
    </head>
    <body>
        <h1>Projet Bdd</h1>
        
<!--	<main>-->
<?php 
$verif=0;


	if(	isset($_POST['depart']) && isset($_POST['arrivee']) && isset($_POST['annee']) && isset($_POST['mois']) && isset($_POST['jour']))//est ce que les variables existe ?
		
		if(	!empty($_POST['depart']) && !empty($_POST['arrivee']) && !empty($_POST['annee']) && !empty($_POST['mois']) && !empty($_POST['jour']))// est ce que les variables sont valides ?(vide)
			
			if($_POST['jour']<=31 && $_POST['jour']>=1 && $_POST['mois']>=1 && $_POST['mois']<=12 && $_POST['annee']>=2000 && $_POST['annee']<=3000)// on détermine les variables possibles
			
				if(checkdate($_POST['jour'],$_POST['mois'], $_POST['annee']))//est ce que la date est coherent 
				{
					echo"Votre gare de départ est ".$_POST['depart']."<br/>";// htmlspecialchars("$_POST['dep']", ENT_QUOTES);
					echo"Votre gare d'arrivée est ".$_POST['arrivee']."<br/>";// 	
					
					//echo"Votre heure de départ est à ".$_POST['heure'].":".$_POST['mois']." !<br/>";//
					
					$jour=date("l", mktime(0, 0, 0, $_POST['mois'],$_POST['jour'], $_POST['annee']));
					$jour_num=date("N" ,mktime(0, 0, 0, $_POST['mois'],$_POST['jour'], $_POST['annee']));
					//echo "jour num =".$jour_num ;
					$joursem = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi','dimanche');	
					$mois_nom=array('janvier','janvier','février','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
					echo"Votre jour de départ est le ".$joursem[$jour_num]." ".$_POST['jour']."<br/> du mois de ".$mois_nom[$_POST['mois']]." ".$_POST['annee']."<br/>";
				
				$verif=1;
			}
				
    $base = mysql_connect ('localhost', 'root', '');// On ce connecte a la BDD  '.$i'
    mysql_select_db ('projetbdd', $base);
	
	
	$sql='SELECT a.nom as depart, b.nom as arrive , f.heure_depart, f.temps_vol, a.fuseau as fuseau_depart, b.fuseau as fuseau_arrive FROM vol f 
	INNER JOIN aeroport a ON f.aeroport_depart=a.code_aeroport INNER JOIN aeroport b ON f.aeroport_arrivee=b.code_aeroport 
	WHERE (aeroport_depart="'.$_POST['depart'].'" OR a.ville="'.$_POST['depart'].'") AND (aeroport_arrivee="'.$_POST['arrivee'].'" OR b.ville="'.$_POST['aeroport_arrivee'].'") AND INSTR(jours, '.$jour_num.') != 0'  ;
	$resultat=mysql_query($sql) or die ('erreur bdd :<br>'.$sql.'<br>'.mysql_error());//On lance la requete et on demande d'afficher l'erreur si il y a.

	echo"<br/>".$NbrLigne=mysql_num_rows($resultat)." Resultats" ;
	// echo "nombre des résultats:".$NbrLigne;
	
	
	?>
<!--	</main>-->
	
	<h3>Votre résultat de recherche :<br/></h3>
		<!--  	<p>500 premiers resultats.<p/>Commentaire -->
	<table border="1" width="400">
	
	
	
<?php
	
	$NbrCol=5;

?>
	<tbody>
	
	<?php		
					for($j=0;$j<$NbrCol;$j++)
						{
			?>
				<td style="background:#A7A37E;">
			<?php 
				//echo mysql_field_name($resultat, $j);	 
				if($j==0){echo"Aéroport de départ:";}
				if($j==1){echo"Aéroport d'arrivée:";}
				if($j==2){echo"Départ à:";}
				if($j==3){echo"durée du vol:";}
				if($j==4){echo"Arrivée à:";}
			?>
				</td>
			<?php 		}
				
					
?>
	</tbody>
	<tbody>
	<?php		
	
	
	for($i=0;$i<$NbrLigne,$data = mysql_fetch_assoc($resultat);$i++)
    {
		?>	<td >	<?php
						echo $data['depart'];
		?>	<td/>

			<?php
						echo $data['arrivee'];
			?>
		
		<td >	<?php
						echo $data['heure_arrivee'];
		?>	<td/>	

			<?php
						$duration_min=$data['temps_vol']%60;
						$duration_heure=(int)($data['temps_vol']/60);
					//Affichage de la durée
						if($duration_min<10)
							echo $duration_heure.":0".$duration_min.":00";
						else
							echo $duration_heure.":".$duration_min.":00";
						
		?>	
				<td >	
			<?php
					list($heure, $min, $sec) = explode(":", $data['heure_arrivee']); //on separe 
						
						$min_final=($data['temps_vol']+$min)%60;	
						$heure_final=(int)((($data['temps_vol']+$min)/60)+$heure+$data['fuseau_depart']+$data['fuseau_arrive'])%24;
						
						//Affichage de l'heure d'arrivée dans le fuseaux horaire de la destination
						if($min_final<10)
							echo $heure_final.":0".$min_final.":00";
						else
							echo $heure_final.":".$min_final.":00";
							
	?></tbody>	<?php			
	}
?>

<table/>

<?php
	
	mysql_close();

			

				if($verif==0){
						echo"Erreur de saisie. Veuillez effectuer une nouvelle requéte.";
						 header( 'Location: http://localhost/projet_bdd/recherche.php' ) ; 
				}
	?>

	
	<br/>
	<br/>
	<a href=recherche.php> Nouvelle recherche </a>
	
	<br/>
<footer>
Projet base de données, année 2013/14 par Coanet Pierre, Laiarinandrasana Dina, Billot Alexandre et Goldstrich Antoine
<footer/>
    </body>
</html>