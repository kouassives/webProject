<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$bdd = new pdo('mysql:host=127.0.0.1;dbname=forum1', 'root','');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>REGLEMENTS</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ;?>
	<!-- MENU -->
	<?php include("menu.php") ;?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps">
	<!--Le REGLEMENT-->
	<table>
		<tr>
			<td id="reglement">Le site Science-informatique.com (SIC) propose à tous ses membres de discuter sur un espace communautaire appelé forum.
Afin que tout se passe pour le mieux, il convient de respecter ces quelques règles simples :
Avant de poster un message, vérifiez à l'aide du Moteur de recherche que celui-ci n'a pas déjà été posté et regardez si les réponses apportées peuvent vous aider à résoudre votre problème.
Ce forum utilise la langue française. Évitez le langage SMS et l'abus de majuscules ;)
Restez poli(e). Les insultes et autres provocations ne mèneront à rien, et puis la bonne ambiance est de mise sur SIC :)
Choisissez un titre explicite pour décrire votre problème, pour que tout le monde puisse vous aider et regarde votre topic.
Postez votre sujet dans une seule rubrique. Si vous vous êtes trompé(e), vous pouvez envoyer un message aux modérateurs (en cliquant sur le lien prévenir les modérateurs).
Précisez votre configuration matérielle dans votre profil et non dans le corps du message (elle sera supprimée) sauf si vous dépannez l'ordinateur de quelqu'un d'autre que vous (merci de le préciser dans ce cas).
Ne postez pas d'"annonces" ni de message publicitaire. Les SPAM SEO sont interdits.
Les liens de téléchargement de logiciels piratés ou qui enfreignent la loi sont interdits.</td>
		</tr>

	</table>
		
	</div>		

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>