
<?php 
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
	srand();
	$rand = rand(1000, 10000);
$requete = $bdd->prepare('INSERT INTO comptes(numero_compte, numero_client, numero_cardteId , raison_social, somme_compte, date_Ouverture, type_compte) VALUES(:numero_compte, :numero_client, :numero_cardteId, :raison_social, :somme_compte, NOW(), :type_compte)');
$requete->execute(array(
	'numero_compte'=>'@CL'.$rand,
	'numero_client'=>$_POST['cltcni'],
	'numero_cardteId'=>$_POST['numeroclt'],
	'raison_social'=>$_POST['social'],
	'somme_compte'=>$_POST['somme'],
	'type_compte'=>$_POST['compte'],
	));
header('location: creation_de_compte.php');
 exit();
?>