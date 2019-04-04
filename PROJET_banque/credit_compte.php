<?php 
session_start();
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
	srand();
	$rand = rand(100, 1000);
	$message='';

if(empty($_POST['number']) || empty($_POST['octroye']) || empty($_POST['raison']) || empty($_POST['libelle']) || empty($_POST['valeur']))
		{
	$message='<strong style="color:red"> veuillez remplir tous les  champs</strong>';
		}
		else
		{
	$reponse = $bdd->prepare('INSERT INTO credits (numero_client, numero_compte, montant_octroye, Raison_social, libelle_garantie, valeur_garantie, date_valeur, echance) VALUES(:numero_client, :numero_compte, :montant_octroye, :Raison_social, :libelle_garantie, :valeur_garantie, :date_valeur, :echance)'); 
	$reponse->execute(array(
	'numero_client'=>'BC'.$rand,
	'numero_compte'=>$_POST['number'],
	'montant_octroye'=>$_POST['octroye'],
	'Raison_social'=>$_POST['raison'],
	'libelle_garantie'=>$_POST['libelle'],
	'valeur_garantie'=>$_POST['valeur'],
	'date_valeur'=>$_POST['dater'],
	'echance'=>$_POST['echeance']
	));
	$reponse->closeCursor();
	}
	header('location: Formulaire_credit.php');
	exit();
?>