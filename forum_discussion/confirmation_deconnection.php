<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);
session_start();

#DESTRUCTION DU STATUS CONNECTé dans la base de donnees
if (!empty($_SESSION['pseudo']))
{
	$req_pour_statu = $bdd->prepare("UPDATE utilisateur set statu=0 WHERE pseudo=?");
	$req_pour_statu -> execute(array($_SESSION['pseudo']));
	session_unset(); 
	session_destroy(); 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>DECONNEXION</title>
</head>
<body onload="destroy_seesion();">
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ?>
	<!-- MENU -->
	<?php include("menu.php") ?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps">
		<!-- CORPS PRINCIPALE DE LA PAGE-->
		<section> <center></br></br><p>Vous êtes bien déconnecté </p></center></section>
	</div>

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>
	

</div>
</body>
</html>