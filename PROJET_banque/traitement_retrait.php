<?php
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$solde='';
if(empty($_POST['number']) || empty($_POST['retire']))
{
$message='veuillez remplir tout les champs';
}
else
{
$requete = $bdd->prepare('INSERT INTO  retraits (numero_cmpte, montant_retirer, date_retrait) VALUES(:numero_cmpte, :montant_retirer, :date_retrait)');
$requete->execute(array(
	'numero_cmpte'=>$_POST['number'],
	'montant_retirer'=>$_POST['retire'],
	'date_retrait'=>$_POST['day'],
	));
$requete->closeCursor();
}
$valeur=htmlspecialchars($_POST['number']);


$requete = $bdd->query('SELECT somme_compte FROM comptes WHERE numero_compte=\''.$valeur.'\'');

				while($donnees = $requete->fetch())
				{
				$solde=$donnees['somme_compte'];
				}
				$requete->closeCursor();

$requete = $bdd->prepare('UPDATE comptes SET somme_compte = :somme_compte WHERE numero_compte = :numero_compte');
$requete->execute(array(
	'somme_compte' =>($solde-$_POST['retire']),
	'numero_compte' => $_POST['number'],
	));
$requete->closeCursor();
header('location: Formulaire_retrait.php');
exit();
?>