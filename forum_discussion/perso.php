<?php
date_default_timezone_set('GMT');
session_start();
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>Perso</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ?>
	<!-- MENU -->
	<?php include("menu.php") ?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps" align="center">
	<h2>Liste de tous mes sujets et fichier postés</h2>
	<table>
		<?php
			$id_utico=$_SESSION['id'];
			$reqsujet = $bdd -> prepare("SELECT * FROM sujet WHERE Utilisateur=?");
			$reqsujet -> execute(array($id_utico));
			$reqfichier = $bdd -> prepare("SELECT * FROM fichier WHERE id_Auteur_post=?");
			$reqfichier -> execute(array($id_utico));
			$nbsujet =  $reqsujet -> rowcount();
			$nbfichier = $reqfichier -> rowcount(); 
		?>
		<tr bgcolor="Blue">
			<td>Sujets(<?php echo $nbsujet; ?>)</td>
		</tr>
		
		<?php
		while ( $repsujet = $reqsujet ->fetch() )
		{
		?>
			<tr>
				<td><a href="sujet.php?id=<?php echo $repsujet['id_Sujet'];?>"><?php  if (isset($repsujet['libelle_sujet']))echo $repsujet['libelle_sujet'];?></a></td>
			</tr>
		
		<?php
		}
		?>
		<tr bgcolor="Blue">
			<td>Fichiers (<?php echo $nbfichier; ?>)</td>
		</tr>
		<?php
			while ( $repfichier = $reqfichier -> fetch() )
		{
		?>
			<tr>
				<td><a href="<?php echo $repfichier['adress'];?>"><?php  if (isset($repfichier['libelle']))echo $repfichier['libelle'];?></a></td>
			</tr>
		<?php
		}	
		?>

	</table>


	</div>
	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>