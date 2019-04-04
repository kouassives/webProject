<?php

try
{  
$bdd= new PDO('mysql:host=localhost;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
$reponse = $bdd->query('SELECT numero_compte, numero_client,somme_compte,type_compte FROM comptes WHERE numero_client=\''.$_GET['Nclient'].'\'');

				while($donnees = $reponse->fetch())
				{
				
				echo '<h1 style="color:#000000 ">'.'<strong>'.$donnees['numero_compte'];
					
				}
				$reponse->closeCursor();
			
?>