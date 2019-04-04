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

if(isset($_POST['valider']))
{ 
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
	$message='<font color="#499300">Versement effectué !</font>';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>VERSEMENTS</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>VERSEMENTS</li>			
			</div>		
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Versements</h3>
			<hr>
			
			<center>
		<div class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table>
		<TR><TD  bgcolor=white align=center><font color=black>
			
		<form  class="formulaire" method="post" action="" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">FORMUALIRE DE VERSEMENT
				</h1>
					<HR color="red" width="350px" size=5/>
					<?php 
					if (isset($message))
					{
					echo $message;
					}
					?>
					<p>
					<strong><label for="deposant">Nom déposant :</label></strong>
			
					<input type="text" name="deposant" placeholder="Nom du Deposant"id="deposant" size=40 />
				</p>
					<p>
					<strong><label for="cpt">Numerocpt :</label></strong>

					<input type="text" name="cpt" placeholder="Numero Compte"size=40 />
				</p>
					<p>
					<strong><label for="versement">Montant versé</label></strong>
			
					<input type="text" name="versement" placeholder="Somme Versée"size=40 />
				</p>
				<p>
					<strong><label for="year">DateOperation</label></strong>
					<input type="date" name="year" /></p>
				
		<input type="submit" value="VALIDER" name="valider"/>
		<input type="reset" value="Annuler"  name="annule"/>
		</form>
		</TR></TD>
		</table>
		</div >
		</center>


	
	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>