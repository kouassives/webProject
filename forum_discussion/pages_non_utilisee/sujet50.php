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
						<td colspan=2 align=center><h2>oap</h2></td>
					</tr>
					<tr>
					<td  Valign=top> <p>Categorie: TELECOMMUNICATION</p></td>
					<td>jk</td>
					</tr>
					<!-- ON VA ALLER PRENDRE AUSSI LES REPONSE AUX SUJET -->
					<?php
					$reponse = $bdd->query("SELECT * FROM reponse WHERE id_Sujet=50 ORDER BY id_Rep DESC;");
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