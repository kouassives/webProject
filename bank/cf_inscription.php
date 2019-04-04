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
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
	<?php include("header.php");?>
	<title>Confirmation Inscription</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>Confirmation_Inscription</li>			
			</div>		
		</div>	
	</div>
	
	<div>
		<div class="container">
			<h3>Confirmation de l'inscription</h3>
			<hr>
			
			<center>
		<div><h4>Linscription du client a été effectué avec succès, Celui ci peut maintenant ouvrir son compte bancaire
		</h4></div >
		</center>

	<?php include("footer.php");?>
    <?php include("javas.php");?>
  </body>
</html>