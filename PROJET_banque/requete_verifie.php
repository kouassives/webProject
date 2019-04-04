<?php 
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
if(isset($_POST['verifie']))
{
  $requete = $bdd->query('SELECT numero_client,raison_social FROM clients WHERE numero_cardteId=\''.$nbre.'\'');
  while($donnees=$requete->fetch()) 
  {
  	$valeur1=$donnees['numero_client'];
	$valeur2=$donnees['raison_social'];
	echo '<p><em style="color:red">Numero Client</em>'.'<strong>'.'&nbsp&nbsp'.$valeur1.'</strong></p>';
	echo '<p><em style="color:red">Raison Social</em>'.'<strong>'.'&nbsp&nbsp'.$valeur2.'</strong></p>';
  }
  }
 
?>