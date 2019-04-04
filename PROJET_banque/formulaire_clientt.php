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
		
		<?php include("header.php");?>
		<HR width=100% color=red>
<form action="" id="recherche" method="POST">
 
<input name="recher" type="text" placeholder="Montant_client..." required />
<input class="loupe" type="submit" name="valider"value="" />
 
</form></br>
<h4>les recherches se font par le montant des soldes des clients inscrits </h4>
<center><div>
	<?php
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
	$nom=htmlspecialchars($_POST['recher']);
	$reponse = $bdd->query('SELECT DISTINCT * FROM clients,comptes WHERE comptes.numero_client=clients.numero_client');
	$trouve=0;
				while($donnees = $reponse->fetch())
				{

					if($donnees['somme_compte']==$nom || $donnees['numero_compte']==$nom
						|| $donnees['numero_cardteId']==$nom)
					{
				
				echo '<img src="'.$donnees['ID_image'].'"style="width:100px; height:100px;"/>'.'<h2 style="color:red ">'.'<strong>'.strtoupper($donnees['nom_postulant']).'<strong>'.'</h2>'.'<h2 style="color:green"> Profession:&nbsp &nbsp'.$donnees['profession'].'</h2>'.'<h2 style="color:green"> Montants:&nbsp &nbsp'.$donnees['somme_compte'].'</h2>'.'<hr/ width=100% color=white size=3>';
				$trouve=1;
					}
				}
				if ($trouve==0)
				{
					echo "Aucune somme ne corrsespond";
				}
					
				$reponse->closeCursor();


}
	?>
</div></center>
	</body>
</html>