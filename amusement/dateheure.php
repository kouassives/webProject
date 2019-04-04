<?php
$date = date("Y-m-d");
$heure = date("H:i:s");
$dh=$date.' '.$heure;
Print("Nous sommes le $date et il est $heure");
Print("Nous sommes le $dh");
$date = new DateTime($dh);
$resultT = $date->format('Y-m-d H:i:s'); #RECUPER TOUS
$resultY = $date->format('Y'); #RECUPER L'année
$resultM = $date->format('m'); #RECUPER Le MOIS 
echo ' TOUS '.$resultT.' ANNEE '.$resultY.' MOIS '.$resultM;
?>