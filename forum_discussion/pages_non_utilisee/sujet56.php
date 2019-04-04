<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

if (isset($_POST['btrepondre']) )
{
	$reponse_sujet= htmlspecialchars($_POST['reponse_sujet']);
	if (!empty($_POST['reponse_sujet']))
	{
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		$dh=$date.' '.$heure;
		$temps = new DateTime($dh);
		$dateheure = $temps->format('Y-m-d H:i:s');

		$reqrepondre = $bdd->prepare("INSERT INTO reponse(message,datereponse,id_Sujet) VALUES(?,?,?) ;");
		$reqrepondre -> execute(array($reponse_sujet,$dateheure,56));
		$erreur='<font color="green">Reponse envoyé avec succès !</font>';
	}
	else
	{
		$erreur='<font color="red">Ecrivez votre reponse !</font>';
	}
}

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
						<td colspan=2 align=center><h2>MON PREMIER SITE EN PHP</h2></td>
					</tr>
					<tr>
					<td  Valign=top> <p>Categorie: RESEAU</p></td>
					<td>JE SUIS PASSIONNE</td>
					</tr>
					<!-- ON VA ALLER PRENDRE AUSSI LES REPONSE AUX SUJET -->
					<?php
					$reponse = $bdd->query("SELECT * FROM reponse WHERE id_Sujet=56 ORDER BY id_Rep ASC;");
						$i=0;
						$reponseexist = $reponse->rowCount();
						# SI $reponseexist>0 alors on afficher les reponses
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
						<?php	
						}
						else
						{
						?>
							<td></td><td><p> AUCUNE reponse pour ce sujet</p></td>
						<?php
						}
					?>

					<!-- ON VA DONNERLA POSSIBILITE DE REPONDRE AUX SUJETS-->
						<form ACTION=""  METHOD="POST">
							<tr>
								<td></td><td  align="center"><TEXTAREA placeholder="Votre reponse"  rows=5 cols=30 name="reponse_sujet" id="reponse_sujet" class="btrepondreacacher" ></TEXTAREA></td>
							</tr>
							<tr>
								<td></td><td  align="center" class="btrepondreacacher"><input type="submit" name="btrepondre" value="REPONDRE"><input type="reset" value="Annuler" class="btrepondreacacher"></td>
							</tr>
							<tr>
								<td></td><td  align="center" id="btrepondreseconnecter"><p style="color: red"><a href="connexion.php">Connectez</a> vous avant de repondre !</p></td>
							</tr>
						</form>
						<tr>
						<td></td><td  align="center">
							<?php
								if (isset($erreur))
								{
									echo $erreur;
								}
							?>
						</td>
						</tr>
			</table>
								
	</div>		

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>