	<?php 
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
		<title>
		creation compte
		</title>
	</head>
	
	<body>
		<div id="contenu">
		<?php include("header.php");?>
			
<?php 
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
if(isset($_POST['verifie']))
{	
  $requete = $bdd->query('SELECT numero_client,raison_social FROM clients WHERE numero_cardteId=\'' . $_POST['cltcni'] . '\'');
  while($donnees=$requete->fetch()) 
  {
  	$valeur1=$donnees['numero_client'];
	$valeur2=$donnees['raison_social'];
	echo '<p><em style="color:red">Numero Client</em>'.'<strong>'.'&nbsp&nbsp'.$valeur1.'</strong></p>';
	echo '<p><em style="color:red">Raison Social</em>'.'<strong>'.'&nbsp&nbsp'.$valeur2.'</strong></p>';
  }
  	$requete->closeCursor();
  }
?>
	<center><div id="projet">
	<table border=1 >
		<TR><TD  bgcolor=white align=center><font color=black>
				
			<form method="post" action="traitement_creation_compte.php">
				<h1 style="color:green">Ouverture Compte</h1>
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
	
			</table border=1>
		</div></center>
	<HR color="red" width="100%" size=7>
		
		<?php include("footer.php");?>
	</div>
	</body>
</html>