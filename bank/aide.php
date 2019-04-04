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
	
	<div>
		<p  style="position: relative;width:800px; height:150px;top:30px ;font-size:21px;font-family: system-ui; box-shadow: 6px 6px 0px green;  border-radius: 15px 10px 15px 10px;color:black">Credit mutuel est une micro-finance Banque qui permet à tous sociétaires d'ouvrir</br>
		un compte d'epagne oubien un compte courant. L'ouverture d'un compte se faire d'abord </br>
	après avoir effecuer une inscription totale et comptète de votre coordonnees suivit d'une photo d'identité.</p></br>
<p style="position: relative;width:800px; height:120px;top:30px ;font-size:21px;font-family: system-ui; box-shadow: 6px 6px 0px green;  border-radius: 15px 10px 15px 10px;color:black">Tous clients ayant effectuer une inscription à la possibilité de faire son ouverture de compte.  </br>
Une ouverture de compte se fait obligatoirement avec une sommme de 10.000 f rcfa comme somme compte</p></br>
<p style="position: relative;width:800px;  height:70px;top:30px ;font-size:21px;font-family: system-ui; box-shadow: 6px 6px 0px green;  border-radius: 15px 10px 15px 10px;color:black">Vous avez la possibilé de faire des retraits, des versements après l'ouverture de compte</br>
</p></br>
<p style="position: relative;width:800px; height:100px;top:30px ;font-size:21px;font-family: system-ui; box-shadow: 6px 6px 0px green;  border-radius: 15px 10px 15px 10px;color:black"> Nous donnons la possibilités à tous nos clients d'octroyer des prèts banquaires mais tout en suivants </br>
certains processus visa-vi du solde de votre compte banquaire</p>

			</center>
		</div>

		
		</TR></TD>
		</table>
		</div >
		</center>

	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>