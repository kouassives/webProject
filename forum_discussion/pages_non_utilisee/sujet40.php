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
				<caption><h2>LILI</h2></caption>
					<tr>
					<td  Valign=top> <p>Categorie: SCIENCE INFORMATIQUE</p></td>
					<td>Et c'est là que se trouve la solution à tous nos problèmes ! Sans rentrer dans les détails parce qu'il n'est pas question de faire un cours sur Linux ici, voilà comment ça fonctionne : il y a trois types de personnes qui ont le droit de lire/modifier des fichiers.

Le propriétaire : c'est l'utilisateur sous Linux qui a créé le fichier. Lui, il a en général tous les droits : lire, écrire, exécuter.
Selon les droits qu'il possède, le premier chiffre du CHMOD change. Ici, c'est 7 : ça veut dire qu'il a tous les droits.
Le groupe : ça ne nous concerne pas trop là non plus. Ce sont les droits du groupe d'utilisateurs auquel appartient le fichier. Cela correspond au deuxième chiffre du CHMOD (ici : 7).
Permissions publiques : ah ! Là, ça devient intéressant. Les permissions publiques concernent tout le monde, c'est-à-dire même vos fichiers PHP. C'est le troisième chiffre du CHMOD (par défaut 5, il faut mettre cette valeur à 7).</td>
					</tr>
					<!-- ON VA ALLER PRENDRE AUSSI LES REPONSE AUX SUJET -->
					<?php
					$reponse = $bdd->query("SELECT * FROM reponse WHERE id_Sujet=40 ORDER BY id_Rep DESC;");
						$i=0;
						$reponseexist = $reponse->rowCount();
						if ($reponseexist>0)
						{	
							while ($donnees = $reponse->fetch())
							{
								$i++;
							?>
								<tr>
									<td ALIGN=right><?php echo '<p>Reponse '.$i.':' ;?></td>
									<a href=""><td><?php echo $donnees['message'] ;?></td></a>
								<tr>
							<?php
							}
						}
						else
						{
						?>
							echo '<p> AUCUNE reponse pour ce sujet</p>';
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