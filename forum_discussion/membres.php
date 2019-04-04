<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);
#POUR DONNER L'HEURE GMT 
date_default_timezone_set('GMT');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>LISTE DES MEMBRES</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ;?>
	<!-- MENU -->
	<?php include("menu.php") ;?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps" align="center">
	<!-- ACCEUIL PAGE POUR UN CONNECTE-->
	

	<?php
	$req_membres = $bdd -> prepare('SELECT * FROM utilisateur ORDER BY statu DESC');
	$req_membres -> execute(array());
	$membre_exist = $req_membres -> rowcount();
	if($membre_exist==0)
	{?>
		<tr>
			<td>Aucun utilisateur inscrit</td>
		</tr>
	<?php
	}
	else
	{?>
			<table>
			<tr>
			<td>Pseudo</td><td>status</td>
			</tr>
	<?php
		while($donnees_membres= $req_membres -> fetch())
		{
		?>
			<tr>
			<td><a href="compte.php?pseudo=<?php echo $donnees_membres['pseudo'];?>"><?php echo $donnees_membres['pseudo'];?></a></td>
			<td><?php if ($donnees_membres['statu']) echo "Connecté(e)" ; else echo "Non connecté(e)" ;?></td>
			</tr>
		<?php
		}?>
			</table>
		<?php	
	}
	?>
	
	</div>

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>