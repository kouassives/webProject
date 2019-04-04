<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta charset="utf-8">
	<title>INSCRIPTION</title>
	<link rel="stylesheet" type="text/css" href="css.php">
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ?>
	<!-- MENU -->
	<?php include("menu.php") ?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps">
			<!-- corps pour message posté-->
			<!-- ECRIVONS SON NOUVEAU POST QU'IL A FAIT-->


			<table cellspacing="10">
				<caption><h2>JOLIEEEEE</h2></caption>
					<tr>
					<td> <p align=top>Categorie: DEVELOPPEMENT</p></td>
					<td>UUID_SHORT()

Returns a “short” universal identifier as a 64-bit unsigned integer. Values returned by UUID_SHORT() differ from the string-format 128-bit identifiers returned by the UUID() function and have different uniqueness properties. The value of UUID_SHORT() is guaranteed to be unique if the following conditions hold:

The server_id value of the current server is between 0 and 255 and is unique among your set of master and slave servers

You do not set back the system time for your server host between mysqld restarts

You invoke UUID_SHORT() on average fewer than 16 million times per second between mysqld restarts

The UUID_SHORT() return value is constructed this way:</td>
					</tr>
			</table>
								
	</div>		

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>