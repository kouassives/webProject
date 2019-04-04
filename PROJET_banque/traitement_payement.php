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
$rand = rand(100, 1000);
$solde1='';
$solde2='';
if(empty($_POST['numero']) || empty($_POST['Mverse']) || empty($_POST['libele']))
{
$message='veuillez remplir tout les champs';
}
else
{
$requete = $bdd->prepare('INSERT INTO  payements (numero_client,numero_compte, Montant_paye, libelle, Date_paye) VALUES(:numero_client, :numero_compte, :Montant_paye, :libelle, :Date_paye)');
$requete->execute(array(
	'numero_client'=>'BC'.$rand,
	'numero_compte'=>$_POST['numero'],
	'Montant_paye'=>$_POST['Mverse'],
	'libelle'=>$_POST['libele'],
	'Date_paye'=>$_POST['dater'],
	));
$requete->closeCursor();
}
$valeur=htmlspecialchars($_POST['numero']);


$requete = $bdd->query('SELECT montant_octroye,valeur_garantie FROM credits WHERE numero_compte=\''.$valeur.'\'');

				while($donnees = $requete->fetch())
				{
				$solde1=$donnees['montant_octroye'];
				$solde2=$donnees['valeur_garantie'];
				}
				$requete->closeCursor();
				echo "$solde1";
				echo "$solde2";
$requete = $bdd->prepare('UPDATE credits SET montant_octroye = :montant_octroye, valeur_garantie = :valeur_garantie WHERE numero_compte= :numero_compte');
$requete->execute(array(
	'montant_octroye' =>($solde1-$_POST['Mverse']),
	'valeur_garantie' =>($solde2-$_POST['Mverse']),
	'numero_compte' => $_POST['numero']
	));
$requete->closeCursor();
header('location: Formulaire_payement.php');
exit();
?>