<?php
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
$message='';
$solde='';
if(empty($_POST['cpt']) || empty($_POST['versement']))
{
$message='veuillez remplir tout les champs';
}
else
{
$requete = $bdd->prepare('INSERT INTO versements (nom_deposant, numero_compte, montant_verser, date_verssement) VALUES(:nom_deposant, :numero_compte, :montant_verser, :date_verssement)');
$requete->execute(array(
	'nom_deposant'=>$_POST['deposant'],
	'numero_compte'=>$_POST['cpt'],
	'montant_verser'=>$_POST['versement'],
	'date_verssement'=>$_POST['year'],
	));
$requete->closeCursor();
}
$valeur=htmlspecialchars($_POST['cpt']);


$requete = $bdd->query('SELECT somme_compte FROM comptes WHERE numero_compte=\''.$valeur.'\'');

				while($donnees = $requete->fetch())
				{
				$solde=$donnees['somme_compte'];
				}
				$requete->closeCursor();

$requete = $bdd->prepare('UPDATE comptes SET somme_compte = :somme_compte WHERE numero_compte = :numero_compte');
$requete->execute(array(
	'somme_compte' => $_POST['versement']+$solde,
	'numero_compte' => $_POST['cpt'],
	));
$requete->closeCursor();
header('location: Formulaire_versement.php');
exit();
?>