<?php
// Stockage des noms de jours et mois en français
$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
// Initialisation date de naissance
$naissance = mktime(0, 0, 0, 04, 19, 1993);
// Date de naissance en français
$naissance_fr = date("d", $naissance)." ".$mois[date("n", $naissance)]." ".date("Y", $naissance);
// Affichage
echo 'Tu est né le '.$naissance_fr.', c\'était donc un <b>'.$jour[date("w", $naissance)].'</b>';
?>  