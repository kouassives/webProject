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

	$message='';

if(empty($_POST['number']) || empty($_POST['octroye']) || empty($_POST['raison']) || empty($_POST['libelle']) || empty($_POST['valeur']))
		{
	$message='<strong style="color:red"> veuillez remplir tous les  champs</strong>';
		}
		else
		{
			$ncpt=htmlspecialchars($_POST['number']);
			$reqnclt = $bdd -> prepare('SELECT numero_client FROM comptes WHERE numero_compte=?');
			$reqnclt -> execute(array($ncpt));
			$repnclt = $reqnclt -> fetch();

	$reponse = $bdd->prepare('INSERT INTO credits (numero_client, numero_compte, montant_octroye, Raison_social, libelle_garantie, valeur_garantie, date_valeur, echance) VALUES(:numero_client, :numero_compte, :montant_octroye, :Raison_social, :libelle_garantie, :valeur_garantie, :date_valeur, :echance)'); 
	$reponse->execute(array(
	'numero_client'=>$repnclt['numero_client'],
	'numero_compte'=>$_POST['number'],
	'montant_octroye'=>$_POST['octroye'],
	'Raison_social'=>$_POST['raison'],
	'libelle_garantie'=>$_POST['libelle'],
	'valeur_garantie'=>$_POST['valeur'],
	'date_valeur'=>$_POST['dater'],
	'echance'=>$_POST['echeance']
	));
	$reponse->closeCursor();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>CREDIT</title>
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
			
			<center>
		<div class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table>
		<TR><TD  bgcolor=white align=center><font color=black>
		
	<!-- ici -->
		<form method="post" action="" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">FORMULAIRE DE CREDIT
				</h1>
				<HR color="red" width="350px" size=5>
					<p>
					<strong><label for="number">Numerocpt :</label></strong>
						</br></br>
					<input type="text" name="number" placeholder="Numero de compte" size=40 />
				</p>
					<p>
					<strong><label for="octroye">Montant octroyé :</label></strong>
						</br></br>
					<input type="text" name="octroye" placeholder="Montant Octroyé"size=40 />
				</p>
				<p>
					<strong><label for="raison">Raison-Social :</label></strong>
						</br></br>
					<input type="text" name="raison"  placeholder="Raison social"size=40 /></P>
					<p>
							<strong><label for="libelle">Libelle Garantie</label></strong></br>
							<textarea name="libelle" id="publ" rows="4"placeholder="votre libellé ici"
							cols="20"></textarea>
						</p>
						<p>
					<strong><label for="valeur">Valeur Garantie :</label></strong>
						</br></br>
					<input type="text" name="valeur" placeholder="Valeur Garantie"size=40 /></P>
				<p>
					<strong><label for="dater">DateValeur  :</label></strong>
					</br></br>
					<input type="date" name="dater" /></p>
						<p>
					<strong><label for="echeance">DateEchance :</label></strong>
					</br></br>
					<input type="date" name="echeance" /></p></br>
		<input type="submit" value="Valider" name="accorde "class="inscrip"/>
		</form>
		
		</TR></TD>
		</table>
		</div >
		</center>


	
	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>