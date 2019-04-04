<?php 
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>OUVERTURE COMPTE</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>Ouvrir compte</li>			
			</div>		
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Ouverture de compte</h3>
			<hr>
			
		<?php 
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
if (isset($_POST['valider']))
{
	srand();
	$rand = rand(1000, 10000);
$requete = $bdd->prepare('INSERT INTO comptes(numero_compte, numero_client, numero_cardteId , raison_social, somme_compte, date_Ouverture, type_compte) VALUES(:numero_compte, :numero_client, :numero_cardteId, :raison_social, :somme_compte, NOW(), :type_compte)');
$requete->execute(array(
	'numero_compte'=>'@CL'.$rand,
	'numero_client'=>$_POST['numeroclt'],
	'numero_cardteId'=>$_POST['cltcni'],
	'raison_social'=>$_POST['social'],
	'somme_compte'=>$_POST['somme'],
	'type_compte'=>$_POST['compte'],
	));
header('location: cf_crea_compte.php');
 exit();
}

if(isset($_POST['verifie']) AND !empty($_POST['cltcni']))
{	
$confirme=htmlspecialchars($_POST['cltcni']);
  $requete = $bdd->query('SELECT numero_client,raison_social FROM clients WHERE numero_cardteId=\''.$confirme.'\'');
  while($donnees=$requete->fetch()) 
  {
  	$valeur1=$donnees['numero_client'];
	$valeur2=$donnees['raison_social'];
	echo '<p><em style="color:blue">Numero Client :</em>'.'<strong>'.'&nbsp&nbsp'.$valeur1.'</strong></p>';
	echo '<p><em style="color:blue">Raison Social :</em>'.'<strong>'.'&nbsp&nbsp'.$valeur2.'</strong></p>';
  }
  	$requete->closeCursor();
  }
  
?>

		<center>
		<div class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
			<table>
		<TR><TD  bgcolor=white align=center><font color=black>
				
			<form class="formulaire" method="post" action="">
				<h1 style="color:green">Formulaire d'ouverture</h1>
			<HR color="red" width="350px" size=5>
			<p><strong><label for="cltcni">CNI du client</label></strong>
			</br>
			<input type="text" name="cltcni" id="cltcni" / placeholder="numero CNI"></br>
			<input type="submit" value="Verifier" name="verifie"class="inscrip"/>
			</p>
			<p><strong><label for="numeroclt">Numero Du client</label></strong>
			</br></br>
			<input type="text" name="numeroclt" id="numeroclt"value=""placeholder="numero client" />
			</p>
	<p>
				<strong><label for="social">Raison social</label></strong>
				</br></br>
				<input type="text" name="social" id="social" value="" placeholder="raison social"/>
			</p>
		<p>
				<strong><label for="somme">Somme en cpte/client</label></strong>
				</br></br>
				<input type="text" name="somme" id="somme" placeholder="somme compte"/>
			</p>
			<p>
					<strong><label for="compte">Type de Cpte</label></strong>
					</br></br>
						<select name="compte" id="compte">
							<option value="epargne">epargne</option>
							<option value="courant">courant</option>

						</select>
			</p>
			
			<input type="submit" value="Valider"  name="valider"class="inscrip"/>
			
			</form>
			</TR></TD>
	
			</table>

		</div >
		</center>


	<?php include("footer.php") ?>
    <?php include("javas.php");?>
	
  </body>
</html>