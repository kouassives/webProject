<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$bdd = new pdo('mysql:host=127.0.0.1;dbname=forum1', 'root','');
#ON RECUPERE TOUT LES CATEGORIES POUR LES LISTER
$reqcateg = $bdd->query("SELECT * FROM categorie;");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>SUJETS-CATEGORIES</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ;?>
	<!-- MENU -->
	<?php include("menu.php") ;?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps">
				<div align="center"><h3>LISTES DES CATEGORIES DE SUJETS</h3></div>
				<table cellpadding=10 cellspacing=5 class="table_sujet">
		<?php
				while($categ = $reqcateg->fetch())
				{
					?>
					
					<tr>
						<td colspan="3"><a href="sujets.php?cat=<?php echo $categ['id_Cat'];  ?>"><h3><?php echo $categ['libelle'];  ?></h3></a></td>
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