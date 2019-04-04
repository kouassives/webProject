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
						<td colspan=2 align=center><h2>JOIE</h2></td>
					</tr>
					<tr>
					<td  Valign=top> <p>Categorie: DEVELOPPEMENT</p></td>
					<td>Il faut indiquer à fgets le fichier à lire. On lui donne notre variable $monfichier qui lui permettra de l'identifier.
fgets renvoie toute la ligne (la fonction arrête la lecture au premier saut de ligne). Donc notre variable $ligne devrait contenir la première ligne du fichier.

Et si mon fichier fait quinze lignes, comment je fais pour toutes les lire ?
Il faut faire une boucle. Un premier fgets vous donnera la première ligne. Au second tour de boucle, le prochain appel à fgets renverra la deuxième ligne, et ainsi de suite.

C'est un peu lourd, mais si on stocke assez peu d'informations dans le fichier, cela peut suffire. Sinon, si on a beaucoup d'informations à stocker, on préfèrera utiliser une base de données (on en parlera dans la prochaine partie).

Écrire

Pour l'écriture, on n'a qu'une seule possibilité : utiliser fputs.
Cette fonction va écrire la ligne que vous voulez dans le fichier.

Elle s'utilise comme ceci :

&lt;?php fputs($monfichier, 'Texte à écrire'); ?&gt;
Toutefois, il faut savoir où l'on écrit le texte. En effet, le fonctionnement d'un fichier est assez étrange…

Vous l'ouvrez avec fopen.
Vous lisez par exemple la première ligne avec fgets.
Oui mais voilà : maintenant, le « curseur » de PHP se trouve à la fin de la première ligne (vu qu'il vient de lire la première ligne), comme dans la figure suivante.
Le curseur de PHP est à la fin de la première ligne
Le curseur de PHP est à la fin de la première ligne
Si vous faites un fputs juste après, il va écrire à la suite ! Pour éviter ça, on va utiliser la fonction fseek qui va replacer le curseur où l'on veut dans le fichier. En l'occurence, on va replacer le curseur au début du fichier en faisant :
fseek($monfichier, 0);
Notre curseur sera alors repositionné au début, voyez donc la figure suivante.</td>
					</tr>
					<!-- ON VA ALLER PRENDRE AUSSI LES REPONSE AUX SUJET -->
					<?php
					$reponse = $bdd->query("SELECT * FROM reponse WHERE id_Sujet=49 ORDER BY id_Rep DESC;");
						$i=0;
						$reponseexist = $reponse->rowCount();
						#<!-- SI $reponseexist>0 alors on afficher les reponses-->
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
							?>
							<!-- ON DONNER LA POSSIBILITE DE REPONDRE AUX SUJETS-->
							<form ACTION=""  METHOD="POST">
								
								<table>
									<tr>
										<td><TEXTAREA placeholder="Votre reponse"  rows=5 cols=15 name="reponse_sujet" id="reponse_sujet" ></TEXTAREA></td>
										<td ALIGN=right ><input type="submit" name="btrepondre" value="REPONDRE"></td>
										<td><input type="reset" value="Annuler"></td>
									</tr>
								</table>
							</form>
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