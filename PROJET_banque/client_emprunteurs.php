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
				
				echo '<img src="'.$donnees['ID_image'].'"style="width:100px; height:100px;"/>'.'<h2 style="color:red ">'.'<strong>'.strtoupper($donnees['nom_postulant']).'<strong>'.'</h2>'.'<h2 style="color:green">Nclient:&nbsp &nbsp'.'<a  style="list-style-type:none "href="Formulaire_client1.php?Nclient='.$donnees['numero_client'].'" title="Cliquer ici pour plus d\'informations">'.$donnees['numero_client'].'</a>'.'</h2>'.'<h2 style="color:green"> Profession:&nbsp &nbsp'.$donnees['profession'].'</h2>'.'<hr/ width=100% color=white size=3>';
					
				}
				$reponse->closeCursor();
					
?>