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
					<tr>
						<td colspan=2 align=center><h2>SA VA</h2></td>
					</tr>
					<tr>
					<td  Valign=top> <p>Categorie: DEVELOPPEMENT</p></td>
					<td>Si vous rentrez 777 comme valeur pour le CHMOD, cela signifie que tous les programmes du serveur ont le droit de modifier le fichier, notamment PHP. Il faut donc rentrer 777 Si vous rentrez 777 comme valeur pour le CHMOD, cela signifie que tous les programmes du serveur ont le droit de modifier le fichier, notamment PHP. Il faut donc rentrer 777 pour que PHP puisse modifier le fichier en question.

Vous pouvez aussi modifier le CHMOD d'un dossier. Cela déterminera si on a le droit de lire/écrire dans ce dossier.
Cela vous sera notamment utile si vous avez besoin de créer des fichiers dans un dossier en PHP.
Pour ceux qui veulent en savoir plus sur les CHMOD, je traite le sujet beaucoup plus en détail dans mon cours sur Linux. N'hésitez pas à aller lire le tutoriel si le sujet vous intéresse.

Ouvrir et fermer un fichier
Avant de lire/écrire dans un fichier, il faut d'abord l'ouvrir.

Commencez par créer un fichier compteur.txt (par exemple). Envoyez-le sur votre serveur avec votre logiciel FTP, et appliquez-lui un CHMOD à 777 comme on vient d'apprendre à le faire.

Maintenant, on va créer un fichier PHP qui va travailler sur compteur.txt.
Votre mission, si vous l'acceptez : compter le nombre de fois qu'une page a été vue sur votre site et enregistrer ce nombre dans ce fichier.

Voici comment nous allons procéder :

Si vous rentrez 777 comme valeur pour le CHMOD, cela signifie que tous les programmes du serveur ont le droit de modifier le fichier, notamment PHP. Il faut donc rentrer 777 pour que PHP puisse modifier le fichier en question. Vous pouvez aussi modifier le CHMOD d'un dossier. Cela déterminera si on a le droit de lire/écrire dans ce dossier. Cela vous sera notamment utile si vous avez besoin de créer des fichiers dans un dossier en PHP. Pour ceux qui veulent en savoir plus sur les CHMOD, je traite le sujet beaucoup plus en détail dans mon cours sur Linux. N'hésitez pas à aller lire le tutoriel si le sujet vous intéresse. Ouvrir et fermer un fichier Avant de lire/écrire dans un fichier, il faut d'abord l'ouvrir. Commencez par créer un fichier compteur.txt (par exemple). Envoyez-le sur votre serveur avec votre logiciel FTP, et appliquez-lui un CHMOD à 777 comme on vient d'apprendre à le faire. Maintenant, on va créer un fichier PHP qui va travailler sur compteur.txt. Votre mission, si vous l'acceptez : compter le nombre de fois qu'une page a été vue sur votre site et enregistrer ce nombre dans ce fichier. Voici comment nous allons procéder </td>
					</tr>
					<!-- ON VA ALLER PRENDRE AUSSI LES REPONSE AUX SUJET -->
					<?php
					$reponse = $bdd->query("SELECT * FROM reponse WHERE id_Sujet=43 ORDER BY id_Rep DESC;");
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
							<td></td><td><p> AUCUNE reponse pour ce sujet</p></td>
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