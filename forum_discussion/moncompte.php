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
	<title>MON COMPTE</title>
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
		#SI DANS L'URL CONTIENT ?pseudo='xxx'
		if (isset($_GET['pseudo']))
		{
			$pseudo=htmlspecialchars($_GET['pseudo']);
			$req_util = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo=?;");
			$req_util -> execute(array($pseudo));
			$donnes_util = $req_util->fetch();
			#VERIFIIONS SI LUTILISATEUR QUI A QUI A L'id $_GET['pseudo'] EXISTE
			#ET ON TRAVAILLERA A PARTIR DE CE POINT AVEC $donnes_util['pseudo'] AU LIEU DE $_GET['pseudo'] et $pseudo
			if (isset($_POST['btavatar']))
			{
				if (isset($_FILES['file']))
				{
					ob_start();
					array_map('unlink', glob($donnes_util['avatar']));
					ob_end_clean();
					
					$name_file=$_FILES['file']['name'];
					$tmp_name=$_FILES['file']['tmp_name'];
					$local_image = "images/avatar/";     
					move_uploaded_file($tmp_name,$local_image.$pseudo.'.png');
												
					$reqavatar = $bdd->prepare("UPDATE utilisateur set avatar=? WHERE pseudo=?");
					$reqavatar->execute(array($local_image.$pseudo.'.png',$donnes_util['pseudo']));
					#Pour effacer des fichier en PHP  on utilise array_map('unlink', glob("images/avatar/angeoFAN.PNG"));
					#array_map('unlink', glob("images/avatar/*.PNG")); Supprime tous les fichiers ayant l'extention .png
					$erreur='<p color="green">Envoyé</p>';
				}

			}
			#Je reprendre encore la requette pour metre à jour les données à  afficher dans ce que suit
			$pseudo=htmlspecialchars($_GET['pseudo']);
			$req_util = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo=?;");
			$req_util -> execute(array($pseudo));
			$donnes_util = $req_util->fetch();

			if (!empty($donnes_util['pseudo']))
			{
				#L'UTILISATEUR EXISTE ALORS ON RECUPERE LES INFOS POUR LES AFFICHER SEULEMENT SI IL EST CONNECTé
				if (!empty($_SESSION['pseudo']))
				{
					if ($_SESSION['pseudo'] == $donnes_util['pseudo'] )
					{

				?>
					<div id="presentation_utilisateur">
					<center>
					<table>

					<tr>
						<td  ALIGN=right>NOM :</td><td><?php echo $donnes_util['nom']; ?></td><td rowspan="4"><img src="<?php echo $donnes_util['avatar']; ?>" alt="avatar" height="200" width="150"></td>
					</tr>
					<tr>
						<td ALIGN=right>PRENOMS :</td><td><?php echo $donnes_util['prenoms']; ?></td>
					</tr>
					<tr>
						<td  ALIGN=right>PSEUDO :</td><td><?php echo $donnes_util['pseudo']; ?></td>
					</tr>
					<tr>
						<td  ALIGN=right>SEXE :</td><td><?php if ($donnes_util['sexe']=="m") echo "Masculin"; else echo "Féminin"; ?></td>
					</tr>
					<tr>
						<td  ALIGN=right>EMAIL :</td><td><?php echo $donnes_util['email']; ?></td>
					</tr>
					<tr>
						<td  ALIGN=right>BIOGRAPHIE :</td><td><?php echo $donnes_util['biographie']; ?></td>
					</tr>
					</table>
					<form method="post" action="" enctype="multipart/form-data">
						<table>
							<tr>
								<td colspan="2" align="center"><a href="modif_util.php?pseudo=<?php echo $_SESSION['pseudo'] ;?>">MODIFIER LES INFORMATIONS</a></td>
							</tr>
							<tr>
							<td>MODIFER L'AVATAR<input type="hidden" name="MAX_FILE_SIZE" value="2097152"/></td>
							<td><input type="file" name="file"><input type="submit" name="btavatar"></td>
							</tr>
						</table>
					</form>
					<?php if (isset($erreur)) echo '<p ALIGN="center"><font color="green">'.$erreur.'</font></p>'; ?>
					</center>
					</div>
				<?php

					}
					else
					{
						echo '<p ALIGN="center"><font color="red">Vous tentez d\'accéder à une page qui n\'est pas la votre !</font></p>';
					}
				}
				else
				{
					echo '<p ALIGN="center"><font color="red">Vous devez être connecté(e) bien avant d\'accéder à cette page !</font></p>';
				}
			}
			else
			{
				echo '<p>Aucun utilisateur n\'est enregistré sous ce pseudo !';
			}

		}
	?>

	</div>

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>