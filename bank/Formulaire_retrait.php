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

if (isset($_POST['valide'])) {

$solde='';
if(empty($_POST['number']) || empty($_POST['retire']))
{
$message='veuillez remplir tout les champs';
}
else
{
$requete = $bdd->prepare('INSERT INTO  retraits (numero_cmpte, montant_retirer, date_retrait) VALUES(:numero_cmpte, :montant_retirer, :date_retrait)');
$requete->execute(array(
	'numero_cmpte'=>$_POST['number'],
	'montant_retirer'=>$_POST['retire'],
	'date_retrait'=>$_POST['day'],
	));

	$message='<font color="#499300">Retrait effectué !</font>';
$requete->closeCursor();
}
$valeur=htmlspecialchars($_POST['number']);


$requete = $bdd->query('SELECT somme_compte FROM comptes WHERE numero_compte=\''.$valeur.'\'');

				while($donnees = $requete->fetch())
				{
				$solde=$donnees['somme_compte'];
				}
				$requete->closeCursor();

$requete = $bdd->prepare('UPDATE comptes SET somme_compte = :somme_compte WHERE numero_compte = :numero_compte');
$requete->execute(array(
	'somme_compte' =>($solde-$_POST['retire']),
	'numero_compte' => $_POST['number'],
	));
$requete->closeCursor();

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>RETRAIT</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>RETRAIT</li>			
			</div>		
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Retrait</h3>
			<hr>
			
			<center>
		<div class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table>
		<TR><TD  bgcolor=white align=center><font color=black>
			
		<form  class="formulaire" method="post" action="" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">FORMULAIRE DE RETRAIT
				</h1>
					<HR color="red" width="350px" size=5>
					<?php 
					if (isset($message))
					{
					echo $message;
					}
					?>
					<p>
					<strong><label for="number">Numerocpt :</label></strong>

					<input type="text" name="number" placeholder="Numero Compte"size=40 />
				</p>
					<p>
					<strong><label for="retire">Montant retiré</label></strong>
			
					<input type="text" name="retire" placeholder="Montant à Retirer"size=40 />
				</p>
					<p>
					<strong><label for="day">DateOperation</label></strong>
					<input type="date" name="day" /></p>
		<input type="submit" value="Valider" name="valide"class="inscrip"/>
		<input type="reset" value="Annuler"  name="annule"class="inscrip"/>
		</form>
		</TR></TD>
		</table>
		</div >
		</center>


	
	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>