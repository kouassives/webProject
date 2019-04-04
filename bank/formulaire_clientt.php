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
   <title>VERSEMENTS</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>Credit</li>			
			</div>		
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Credit</h3>
			<hr>
		</div>
			<center>
		<div class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table>
		<TR><TD  bgcolor=white align=center><font color=black>
		
	<!-- ici -->
	<form action="" id="recherche" method="POST">
 
<input name="recher" type="text" placeholder="Montant_client..." required />
<input class="loupe" type="submit" name="valider" value="Rechercher" />
 
</form></br>
<h4>les recherches se font par le montant des soldes des clients inscrits ou le Numero de compte ou le Numero de Pièce  </h4>
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
		
		
		</TR></TD>
		</table>
		</div >
		</center>

	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>