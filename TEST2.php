
		   	<?php 


if(isset($_POST['Recherche'])) { 

					$date = mktime(0, 0, 0, $_POST['mois'],$_POST['jour'], $_POST['annee']);
					$jour=date("l", $date);
					$jour_num=date("d" ,$date);
					
					$joursem = array('dimanche','lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');	
					$mois_nom=array('','janvier','février','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
echo"Votre jour de départ est le ".$joursem[$jour_num]." ".$_POST['jour']."<br/> du mois de ".$mois_nom[$_POST['mois']]." ".$_POST['annee']."<br/>";

    $bdd = mysql_connect ('localhost', 'root', '');// On se connecte a la BDD  
    mysql_select_db ('projet_bdd', $bdd); // selection de la base projet_bdd

$sql = "SELECT DISTINCT v.num_vol as VOL,a.nom as DEPART,b.nom as ARRIVEE,v.heure_depart, v.temps_vol as DUREE, a.fuseau as fuseau_depart, b.fuseau as fuseau_arrivee FROM vol v 
INNER JOIN aeroport a ON a.code_aeroport=v.aeroport_depart 
INNER JOIN aeroport b ON b.code_aeroport=v.aeroport_arrivee 
WHERE (a.ville = '".$_POST["depart"]."'  or v.aeroport_depart = '".$_POST["depart"]."') and (b.ville = '".$_POST["arrivee"]."' or v.aeroport_arrivee = '".$_POST["arrivee"]."' ) AND INSTR(jours, '".$jour_num."') != 0 ";

	$resultat=mysql_query($sql) or die ('erreur bdd :<br>'.$sql.'<br>'.mysql_error());//On lance la requete et on demande d'afficher l'erreur si il y a.

	$nbLigne=mysql_num_rows($resultat);

	}

?>

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

	<section>

	<form method = "post">	
		<table id="Requête">
			<h1>Votre destination</h1>
			<tr>
				<td><label for="Départ"></label></td>
				<td><input type="text" name="depart" placeholder="Départ"/></td>
				<td><label for="Arrivée"></label></td>
				<td><input type="text" name="arrivee" placeholder="Arrivée"/></td>
			</tr>
		</table>
		
		<h1>Votre date de départ</h1>
		
			<div id="div1">
			<h2>Jour</h2>
			<select name="jour" size="1" tabindex="1">
				<option value="tous1">Tous</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>
			</div>
			
			<div id="div2">
			<h2>Mois</h2>
			<select name="mois" size="1" tabindex="1">
				<option value="tous2">Tous</option>
				<option value="1">Janvier</option>
				<option value="2">Février</option>
				<option value="3">Mars</option>
				<option value="4">Avril</option>
				<option value="5">Mai</option>
				<option value="6">Juin</option>
				<option value="7">Juillet</option>
				<option value="8">Août</option>
				<option value="9">Septembre</option>
				<option value="10">Octobre</option>
				<option value="11">Novembre</option>
				<option value="12">Décembre</option>
			</select>
			</div>
			
			<div id="div3">
			<h2>Année</h2>
			<select name="annee" size="1" tabindex="1">
				<option value="toutes">Toutes</option>
				<option value="2000">2000</option>
				<option value="2001">2001</option>
				<option value="2002">2002</option>
				<option value="2003">2003</option>
				<option value="2004">2004</option>
				<option value="2005">2005</option>
				<option value="2006">2006</option>
				<option value="2007">2007</option>				
				<option value="2008">2008</option>
				<option value="2009">2009</option>
				<option value="2010">2010</option>
				<option value="2011">2011</option>
				<option value="2012">2012</option>
				<option value="2013">2013</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
			</select>
			</div>
			
			<div id="div4">
			<input type="submit" name="Recherche" value="Recherche" id="Recherche"/>
			<a href="AirEsiea2.php"id="Nouvelle_Recherche">Nouvelle Recherche<a/>
			</div>
	</form>
	
	<div style="height: 200px; overflow: auto;" id="Wrap_Table">
	<table id="Resultat">
		<thead>
       		<tr>
           		<th>Vol</th>
           		<th>Départ</th>
          		<th>Arrivée</th>
          		<th>Heure de départ</th>
          		<th>Heure d'arrivée</th>
          		<th>Compagnie Aérienne</th>
       		</tr>
   		</thead>

   		<tfoot>
   		</tfoot>
   		
   		<tbody>

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


mysql_close($bdd);
?>

   		
   </table>
   </div>
	
	</section>
	
	</body>
	
	
	<footer>
		
	</footer>
</html>
