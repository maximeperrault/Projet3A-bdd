<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Projet Bdd</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		  <link rel="stylesheet" href="style2.css" />
		
    </head>
    <body>
        <h1>Projet Bdd</h1>
        
	
        <p>
           Veuillez entrer les données :<br/>
        </p>
		
<form action="resultat2.php" method="post">
	<p>
		Départ:<input type="text" name="depart" /> <br/>
		Arrivée:<input type="text" name="arrivee" /> <br/>
		Année:<input type="text" name="annee" value="2014" onclick="this.value='';"/> 
		Mois:<!--<input type="text" name="mois" /> -->
		<SELECT name="mois">
		<OPTION VALUE="1">Janvier</OPTION>
		<OPTION VALUE="2">Fevrier</OPTION>
		<OPTION VALUE="3">Mars</OPTION>
		<OPTION VALUE="4">Avril</OPTION>
		<OPTION VALUE="5">Mai</OPTION>
		<OPTION VALUE="6">Juin</OPTION>
		<OPTION VALUE="7">Juillet</OPTION>
		<OPTION VALUE="8">Aout</OPTION>
		<OPTION VALUE="9">Septembre</OPTION>
		<OPTION VALUE="10">Octobre</OPTION>
		<OPTION VALUE="11">Novembre</OPTION>
		<OPTION VALUE="12">Decembre</OPTION>
	</SELECT>
		
		
		Jour:
		<SELECT name="jour">
		
		<OPTION VALUE="1">1</OPTION>
		<OPTION VALUE="2">2</OPTION>
		<OPTION VALUE="3">3</OPTION>
		<OPTION VALUE="4">4</OPTION>
		<OPTION VALUE="5">5</OPTION>
		<OPTION VALUE="6">6</OPTION>
		<OPTION VALUE="7">7</OPTION>
		<OPTION VALUE="8">8</OPTION>
		<OPTION VALUE="9">9</OPTION>
		<OPTION VALUE="10">10</OPTION>
		<OPTION VALUE="11">11</OPTION>
		<OPTION VALUE="12">12</OPTION>
		<OPTION VALUE="13">13</OPTION>
		<OPTION VALUE="14">14</OPTION>
		<OPTION VALUE="15">15</OPTION>
		<OPTION VALUE="16">16</OPTION>
		<OPTION VALUE="17">17</OPTION>
		<OPTION VALUE="18">18</OPTION>
		<OPTION VALUE="19">19</OPTION>
		<OPTION VALUE="20">20</OPTION>
		<OPTION VALUE="21">21</OPTION>
		<OPTION VALUE="22">22</OPTION>
		<OPTION VALUE="23">23</OPTION>
		<OPTION VALUE="24">24</OPTION>
		<OPTION VALUE="25">25</OPTION>
		<OPTION VALUE="26">26</OPTION>
		<OPTION VALUE="27">27</OPTION>
		<OPTION VALUE="28">28</OPTION>
		<OPTION VALUE="29">29</OPTION>
		<OPTION VALUE="30">30</OPTION>
		<OPTION VALUE="31">31</OPTION>
		
		</SELECT>
		<br/> 
		
		
		Avec escales :<input type="checkbox" name="escale" /> <br/> <br/><br/>

		<input type="submit" value="Valider" />
	</p>
</form>

	
<footer>
Projet base de données, année 2013/14 par Coanet Pierre, Laiarinandrasana Dina, Billot Alexandre et Goldstrich Antoine
<footer/>
    </body>
</html>