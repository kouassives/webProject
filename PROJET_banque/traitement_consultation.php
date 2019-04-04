<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
		<title>
		consultation
		</title>
	</head>
	
	<body>
		
		<?php include("header.php");?>
			<HR color="red" width="100%" size=7>
	
		<center><div blackground-color="white"   height="600px"  width="850px">
<?php 
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
$nbres=$_POST['compte'];


$requete = $bdd->query('SELECT type_compte,somme_compte FROM comptes WHERE numero_compte=\''.$nbres.'\'');

  while($donnees = $requete->fetch()) 
  {
 echo '<p><strong style="color:DarkBlue">Numero Compte :</strong>'.'<strong>'.strtoupper($nbres).'<strong><p>';
echo '<p><strong style="color:DarkBlue">Type De Compte :</strong>'.'<strong>'.'&nbsp&nbsp'.strtoupper($donnees['type_compte']).' </strong></p>';
echo '<p><strong style="color:DarkBlue">Solde Du Compte :</strong>'.'<strong>'.'&nbsp&nbsp'.strtoupper($donnees['somme_compte']).'FrCFA</strong></p>';
  }
 $requete->closeCursor();


?>
	
		</div></center>


	</body>
</html>	