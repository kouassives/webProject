<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>RECHERCHE</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ?>
	<!-- MENU -->
	<?php include("menu.php") ?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps">
	<?php
		if (isset($_GET['rech']))
		{
			$rech=htmlspecialchars($_GET['rech']);
			#REQUETTTE POUR UTILISATEUR
			$req_rech_user = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo LIKE ? OR nom LIKE ? OR prenoms LIKE ? ;");
			$req_rech_user -> execute(array('%'.$rech.'%','%'.$rech.'%','%'.$rech.'%'));
			$donnees_rech_user_existe = $req_rech_user->rowcount();

			#REQUETTTE POUR SUJET
			$req_rech_sujet = $bdd->prepare("SELECT * FROM sujet WHERE libelle_sujet LIKE ? OR message LIKE ? ;");
			$req_rech_sujet -> execute(array('%'.$rech.'%','%'.$rech.'%'));
			$donnees_rech_sujet_existe = $req_rech_sujet->rowcount();

			#REQUETTTE POUR FICHIER
			$req_rech_fichier = $bdd->prepare("SELECT * FROM fichier WHERE libelle LIKE ? ;");
			$req_rech_fichier -> execute(array('%'.$rech.'%'));
			$req_rech_fichier_existe = $req_rech_fichier->rowcount();
			
			#VERIFIIONS SI LA REQUETTE A RAPPORTé des resultats Utilisateur
			if ( $donnees_rech_user_existe )
			{
			?>
			<table align="center">
			<tr>
				<th>Resulats des Utilisateur dont le pseudo ou le nom ou le prenom contient <?php echo $rech;?></th>
			</tr>
			<?php
				while ($donness_rech_user=$req_rech_user -> fetch())
				{
				?>
					<tr>
						<td align="center"><a href="compte.php?pseudo=<?php echo $donness_rech_user['pseudo'] ;?>"><?php echo $donness_rech_user['pseudo'];?></a></td>
					</tr>
				<?php
				}
			?>
			</table>
			<?php
			}
			else
			{

			}

			#VERIFIIONS SI LA REQUETTE A RAPPORTé des resultats de SUJET
			if ( $donnees_rech_sujet_existe )
			{
			?>
			<table align="center">
			<tr>
				<th>Resulats des sujets contenant <?php echo $rech;?></th>
			</tr>
			<?php
				while ($donness_rech_sujet=$req_rech_sujet -> fetch())
				{
				?>
					<tr>
						<td align="center"><a href="sujet.php?id=<?php echo $donness_rech_sujet['id_Sujet'] ;?>"><?php echo $donness_rech_sujet['libelle_sujet'];?></a></td>
					</tr>
				<?php
				}
			?>
			</table>
			<?php
			}
			else
			{

			}

			#VERIFIIONS SI LA REQUETTE A RAPPORTé des resultats Fichier
			if ( $req_rech_fichier_existe )
			{
			?>
			<table align="center">
			<tr>
				<th>Resulats des Fichiers dont le nom contient <?php echo $rech;?></th>
			</tr>
			<?php
				while ($donness_rech_fichier=$req_rech_fichier -> fetch())
				{
				?>
					<tr>
						<td align="center"><a href="<?php echo $donness_rech_fichier['adress'] ;?>"><?php echo $donness_rech_fichier['libelle'];?></a></td>
					</tr>
				<?php
				}
			?>
			</table>
			<?php
			}
			else
			{

			}



		}
		else
		{

		}
	?>
	</div>

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>