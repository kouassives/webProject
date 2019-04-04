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
if (isset($_POST['accorde']))
{

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


$req = $bdd->query('SELECT SUM(montant_octroye) as SOMMEcredit FROM credits WHERE numero_compte=\''.$valeur.'\'');
$rep = $req -> fetch(); 

$reqpaie = $bdd->query('SELECT SUM(Montant_paye) as SOMMEpaie FROM payements WHERE numero_compte=\''.$valeur.'\'');
$reppaie = $reqpaie -> fetch();

$mntrestant=($rep['SOMMEcredit']-$reppaie['SOMMEpaie']);

$reqmiseajour = $bdd->prepare('UPDATE credits SET montant_restant =? WHERE numero_compte= ?');
$reqmiseajour -> execute(array($mntrestant,$_POST['numero']));

			/*	while($donnees = $requete->fetch())
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
*/

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>PAIEMENT</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>Paiement</li>			
			</div>		
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Paiement</h3>
			<hr>
			
			<center>
		<div class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table>
		<TR><TD  bgcolor=white align=center><font color=black>
		
	<!-- ici -->
		<form method="post" action="" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">FORMULAIRE DE PAIEMENT
				</h1><?php 
echo $rep['SOMMEcredit'].' '.$reppaie['SOMMEpaie'].' '.$mntrestant; ?>
				<HR color="red" width="350px" size=5>
					<p>
					<strong><label for="numero">Numerocpt :</label></strong>
						</br></br>
					<input type="text" name="numero" placeholder="Votre Numero compte" size=40 />
				</p>
					<p>
					<strong><label for="Mverse">Montant Versé :</label></strong>
						</br></br>
					<input type="text" name="Mverse" placeholder="Montant Versé"size=40 />
				</p>
						<p>
							<strong><label for="libele">Libelle Garantie</label></strong></br>
							<textarea name="libele" id="publ" rows="4"placeholder="votre libellé ici"
							cols="20"></textarea>
						</p>
				<p>
					<strong><label for="dater">DatePayement  :</label></strong>
					</br></br>
					<input type="date" name="dater" /></p>
		<input type="submit" value="Valider" name="accorde"/>

		</TR></TD>
		</table>
		</div >
		</center>


	
	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>