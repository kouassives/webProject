<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>FORUM DE DISCUSSION</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ?>
	<!-- MENU -->
	<?php include("menu.php") ?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps">
		<!-- CORPS DE L'INDEX QU'ON PEUT CHANGER FACILEMENT A NOTRE AISE DANS corpsindex.php -->	
		<?php include("corpsindex.php") ?>
	</div>
	<!-- PIED DE PAGE-->
	<?php include("pied_page.php") ?>

</div>
</body>
</html>