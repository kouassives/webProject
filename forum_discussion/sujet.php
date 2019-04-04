<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
date_default_timezone_set('GMT');
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);
	#SI DANS L'URL CONTIENT ?id='xxx'
	if (isset($_GET['id']))
	{
		$id_dusujet=(int)$_GET['id'];
		$req_contenu_sujet = $bdd->prepare("SELECT * FROM sujet WHERE id_Sujet=?;");
		$req_contenu_sujet -> execute(array($id_dusujet));
		$donnes_sujet = $req_contenu_sujet->fetch();
		

		$date_post = new DateTime($donnes_sujet['datepost']);
		$date_post_h = $date_post->format('H');
		$date_post_m = $date_post->format('i');
		$date_post_s = $date_post->format('s');
		$date_post_date = $date_post->format('d-m-Y');
		#VERIFIIONS SI LE SUJET AQUI A L'id $_GET['id'] EXISTE
		#ET ON TRAVAILLERA A PARTIR DE CE POINT AVEC $donnes_sujet['id_Sujet'] AU LIEU DE $_GET['id'] et $id_dusujet
		if (!empty($donnes_sujet['id_Sujet']))
		{
			#LE SUJET EXISTE ALORS ON RECUPERER LES INFOS SUR LE PROPRIETAIRE DU SUJET ET LA CATEGORIE DU SUJET
			$req_proprietaire = $bdd->prepare("SELECT * FROM utilisateur WHERE id_Util=?;");
			$req_proprietaire -> execute(array($donnes_sujet['Utilisateur']));
			$donnes_proprietaire = $req_proprietaire->fetch();
			#LES DONNEES DU PROPIRETAIRE SONT DANS $donnes_proprietaire['']
			#ON VA ALLER PRENDRE AUSSI LE NOM DE LA CATEGORIE
			$req_categorie = $bdd->prepare("SELECT * FROM categorie WHERE id_Cat=?;");
			$req_categorie -> execute(array($donnes_sujet['Categorie']));
			$donnes_categorie = $req_categorie->fetch();
			#LES DONNEES DE LA CATEGORIE SONT DANS $donnes_categorie['']
			

		}
		else
		{
			#LE SUJET N'EXISTE PAS
		}

	}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<!--ON VA AFFICHER DANS LE TITRE LE TITRE DU SUJET-->
	<title><?php # C'EST LORSQUE LE SUJET EXISTE QUE LE TITRE EXISTE DONC IL FAUT UN TEST AVANT D'AFFICHER LE TITRE
					 if (!empty($donnes_sujet['id_Sujet'])) {echo $donnes_sujet['libelle_sujet'];} ?></title>
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

<?php
#POUR L'OPTION REPONDRE ON DOIT LE METTRE ICI APRES LE MENU CAR C'est DANS LE MENU QUAND LA SESSION DEMARE
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

		$reqrepondre = $bdd->prepare("INSERT INTO reponse(message,datereponse,id_Utilisateur,id_Sujet) VALUES(?,?,?,?) ;");
		$reqrepondre -> execute(array($reponse_sujet,$dateheure,$_SESSION['id'],$donnes_sujet['id_Sujet']));
		$erreur='<font color="green">Reponse envoyée avec succès !</font>';
	}
	else
	{
		$erreur='<font color="red">Ecrivez votre reponse !</font>';
	}
}
?>
			
			<table cellspacing="10" class="table_sujet">
					<tr>
						<td colspan=2 align=center><h2><?php # C'EST LORSQUE LE SUJET EXISTE QUE LE TITRE EXISTE DONC IL FAUT UN TEST AVANT D'AFFICHER LE TITRE
					 if (!empty($donnes_sujet['id_Sujet'])) {echo $donnes_sujet['libelle_sujet'];} ?></h2></td>
					</tr>
					<tr>
					<td  Valign=top> <p><!-- ON ECRIS LA CATEGORIE DU SUJET-->Categorie: <?php # C'EST LORSQUE LE SUJET EXISTE QUE LA CATEGORIE EXISTE DONC IL FAUT UN TEST AVANT D'AFFICHER LA CATEGORIE
					 if (!empty($donnes_sujet['id_Sujet'])) {echo $donnes_categorie['libelle'];} ?></p><p>Posté par <a href="compte.php?pseudo=<?php echo $donnes_proprietaire['pseudo'];?>"><?php echo $donnes_proprietaire['pseudo'];?></a> </p><p><?php echo $date_post_h.'h'.$date_post_m.'min'.$date_post_s.'s '.$date_post_date ?><?php if($donnes_proprietaire['statu']==1) echo "<p>Connecté(e)</p>"; else echo "<p>hors ligne(e)</p>"; ?> </p></td>
					<td><!-- ON ECRIS LA LE COPRS DU SUJET --><?php echo $donnes_sujet['message']; ?> </td>
					</tr>
					<!-- ON VA ALLER PRENDRE AUSSI LES REPONSE AUX SUJET -->
					<?php
					$req_reponse = $bdd->prepare("SELECT * FROM reponse WHERE id_Sujet=? ORDER BY id_Rep ASC;");
					$req_reponse -> execute(array($donnes_sujet['id_Sujet']));

						$i=0;
						$reponseexist = $req_reponse->rowCount();
						# SI $reponseexist>0 alors on afficher les reponses
						if ($reponseexist>0)
						{	
							while ($reponseaffich = $req_reponse->fetch())
							{
								$i++;
								#DANS CETTE BOUCLE while chaque donnee de reponse est contenu dans $reponseaffich['']
								#ON VA RECUPERER LE NOM DE L'UTILISATEUR QUI A REPONDU avec id_Utilisateur qui est dans reponse
								$req_reponse_pseudo = $bdd->prepare("SELECT * FROM utilisateur WHERE id_Util=?;");
								$req_reponse_pseudo -> execute(array($reponseaffich['id_Utilisateur']));
								$reponse_pseudo_date = $req_reponse_pseudo->fetch();
								$temps = new DateTime($reponseaffich['datereponse']);
								$dateheure_h = $temps->format('H');
								$dateheure_m = $temps->format('i');
								$dateheure_s = $temps->format('s');
								$dateheure_date = $temps->format('d-m-Y');
								

							?>
								<tr>
									<td ALIGN=right><?php echo '<p>Réponse de <a href="compte.php?pseudo='.$reponse_pseudo_date['pseudo'].'">'.$reponse_pseudo_date['pseudo'].'</a> :</br>'.$dateheure_h.'h'.$dateheure_m.'min'.$dateheure_s.'s '.$dateheure_date.'</p>' ;?><?php if($reponse_pseudo_date['statu']==1) echo "<p>Connecté(e)</p>"; else echo "<p>hors ligne(e)</p>"; ?></td>
									<a href=""><td><?php echo $reponseaffich['message'] ;?></td></a>
								<tr>
							<?php
							}
							?>
						<?php	
						}
						else
						{
						?>
							<td></td><td><p> Aucune reponse pour ce sujet</p></td>
						<?php
						}
					?>

					<!-- ON VA DONNERLA POSSIBILITE DE REPONDRE AUX SUJETS-->
						<form ACTION=""  METHOD="POST">
							<tr>
								<td></td><td  align="center"><TEXTAREA placeholder="Votre reponse"  rows=n cols=m name="reponse_sujet" id="reponse_sujet" class="btrepondreacacher" ></TEXTAREA></td>
							</tr>
							<tr>
								<td></td><td  align="center" class="btrepondreacacher"><input type="submit" name="btrepondre" value="REPONDRE"><input type="reset" value="Annuler" class="btrepondreacacher"></td>
							</tr>
							<tr>
								<td  align="center" id="btposterseconnecter" colspan="2"><p style="color: red"><a href="connexion.php">Connectez</a> vous avant de repondre au sujet !</p></td>
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