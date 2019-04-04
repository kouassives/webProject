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
	<title>COMPTE UTILISATEUR</title>
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
			if (!empty($donnes_util['pseudo']))
			{
				#L'UTILISATEUR EXISTE ALORS ON RECUPERE LES INFOS POUR LES AFFICHER SEULEMENT SI IL EST CONNECTé
				if (!empty($_SESSION['pseudo']))
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
						<td  ALIGN=right>EMAIL :</td><td><?php echo $donnes_util['email']; ?></td>
					</tr>
					<tr>
						<td  ALIGN=right>BIOGRAPHIE :</td><td><?php echo $donnes_util['biographie']; ?></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><a href="envoyermsg.php?id=<?php echo $donnes_util['id_Util'];?>">Envoyer un message</a></td>
					</tr>
					</table>
					
					</center>
					</div>
				<?php
				}
				else
				{

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