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

if (isset($_POST['consulte']))
{
$nbres=$_POST['compte'];


$requete = $bdd->query('SELECT type_compte,somme_compte FROM comptes WHERE numero_compte=\''.$nbres.'\'');

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>CONSULTATION</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>Consulation</li>			
			</div>		
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Consulation</h3>
			<hr>
			
			<center>
		<div class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table>
		<TR><TD  bgcolor=white align=center><font color=black>
			<form method="post" action="" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green"> Formulaire de consultation
				</h1>
					<HR color="red" width="350px" size=5>
					
					<p>
					<strong><label for="compte">Numero du compte :</label></strong>

					
					<input type="text" id="compte" name="compte" placeholder="Numero Compte" size=40 /></p>
				
		<input type="submit" value="consulter" name="consulte" class="inscrip"/>
			</form>
		</TR></TD>
		</table>
		</div >
		<div>
			<?php
  if (isset($_POST['consulte']))
{
  while($donnees = $requete->fetch()) 
  {
 echo '<p><strong style="color:DarkBlue">Numero Compte :</strong>'.'<strong>'.strtoupper($nbres).'<strong><p>';
echo '<p><strong style="color:DarkBlue">Type De Compte :</strong>'.'<strong>'.'&nbsp&nbsp'.strtoupper($donnees['type_compte']).' </strong></p>';
echo '<p><strong style="color:DarkBlue">Solde Du Compte :</strong>'.'<strong>'.'&nbsp&nbsp'.strtoupper($donnees['somme_compte']).'FrCFA</strong></p>';
  }
 $requete->closeCursor();
}
?>

		</div>

		</center>


	
	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>