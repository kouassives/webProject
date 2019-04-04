<?php 
session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>EMPRUNTS</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>Emprunts</li>			
			</div>		
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Listes Des Emprunts</h3>
			<hr>
		</div>
			<center>
		<div class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table>
		<TR><TD  bgcolor=white align=center><font color=black>
		
	<!-- ici -->
	<?php

try
{  
$bdd= new PDO('mysql:host=localhost;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
$reponse = $bdd->query('SELECT * FROM clients,credits WHERE credits.numero_client=clients.numero_client');

				while($donnees = $reponse->fetch())
				{
				
				echo '<img src="'.$donnees['ID_image'].'"style="width:100px; height:100px;"/>'.'<h2 style="color:red ">'.'<strong>'.strtoupper($donnees['nom_postulant']).'<strong>'.'</h2>'.'<h2 style="color:green">Nclient:&nbsp &nbsp'.'<a  style="list-style-type:none "href="Formulaire_client1.php?Nclient='.$donnees['numero_client'].'" title="Cliquer ici pour plus d\'informations">'.$donnees['numero_client'].'</a>'.'</h2>'.'<h2 style="color:green"> Profession:&nbsp &nbsp'.$donnees['profession'].'</h2>'.'Montant emprunté : '.$donnees['montant_octroye'].' </br> Date Emprunt :'.$donnees['date_valeur'] .' </br> Date de Echéance :'.$donnees['echance'] .' <hr/ width=100% color=white size=3>';
					
				}
				$reponse->closeCursor();
					
?>
		
		</TR></TD>
		</table>
		</div >
		</center>

	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>