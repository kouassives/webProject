<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
		<title>
		credits
		</title>
	</head>
	
	<body>
		<div id="contenu">
		
		<?php include("header.php");?>
		<HR width=100% color=red>
				<?php

try
{  
$bdd= new PDO('mysql:host=localhost;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
$reponse = $bdd->query('SELECT clients.nom_postulant, clients.profession, clients'.'sexe, clients'.'ID_image,
								clients'.'numero_compte,Payements'.'Montant_paye
								'.'FROM clients
								inner join Payements
								on clients'.'numero_client= payements'.'numero_client
								WHERE payements.som');

				while($donnees = $reponse->fetch())
				{
				
				echo '<img src="images/'.$donnees['ID_image'].'"style="width:100px; height:100px;"/>'.'<h2 style="color:red ">'.'<strong>'.strtoupper($donnees['nom_postulant']).'<strong>'.'</h2>'.'<h2 style="color:green">Nclient:&nbsp &nbsp'.'<a  style="list-style-type:none "href="Formulaire_client1.php?Nclient='.$donnees['numero_client'].'" title="Cliquer ici pour plus d\'informations">'.$donnees['numero_client'].'</a>'.'</h2>'.'<h2 style="color:green"> Profession:&nbsp &nbsp'.$donnees['profession'].'</h2>'.'<hr/ width=100% color=white size=3>';
					
				}
				$reponse->closeCursor();
					
?>
		
		<?php include("footer.php");?>
	</div>
	</body>
</html>