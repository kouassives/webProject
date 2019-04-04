<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

if (isset($_POST['formposter']) )
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$contenu = htmlspecialchars($_POST['contenu']);
	$titre = htmlspecialchars($_POST['titre']);
	$categorie = htmlspecialchars($_POST['categorie']);
	if (!empty($_POST['pseudo']) AND !empty($_POST['contenu']) AND !empty($_POST['categorie']) )
	{
		#On vérifie si le pseudo existe
			$reqspeudo = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo=?");
			$reqspeudo -> execute(array($pseudo));
			$pseudoexist = $reqspeudo->rowCount();
			if ($pseudoexist == 1 )
			{
				#On va reccuperer l'heure
				$date = date("Y-m-d");
				$heure = date("H:i:s");
				$dh=$date.' '.$heure;
				$temps = new DateTime($dh);
				$dateheure = $temps->format('Y-m-d H:i:s');
				#ON DOIT ALLER RECCUPERER LES id utilisateur et categorie pour les enregistrer. $iduti contient l'id de l'utilisateur
				$uti = $reqspeudo->fetch();
				$iduti = $uti['id_Util'];
				#On fait pareil pour categories $id_cate contient l'id de la categorie 
				$reqcategorie = $bdd->prepare("SELECT * FROM categorie WHERE libelle=?");
				$reqcategorie -> execute(array($categorie));
				$cat = $reqcategorie->fetch();
				$id_cate = $cat['id_Cat'];
				$insertuti = $bdd->prepare("INSERT INTO sujet(libelle_sujet,message,datepost,Categorie,Utilisateur) VALUES(?,?,?,?,?)");
				$insertuti->execute(array($titre,$contenu,$dateheure,$id_cate,$iduti));
				$erreur='Sujet posté avec Succès';
				#RECCUPER L id du sujet pour creer sa page php qui est l'id du dernier sujet posté
				$reqsujet = $bdd->query("SELECT * FROM sujet ORDER BY id_Sujet DESC LIMIT 1");
				$Sujet = $reqsujet->fetch();
				$id_Sujet = $Sujet['id_Sujet'];
				$monfichier = fopen('sujet'.$id_Sujet.'.php', 'w');
				# JE VAIS ECRIRE LE TEXT BRUT DANS LE FICHIER DE LA PAGE PHP QUI DOIT ETRE CREE
				# DANS CE FORMAT TOUT LES ( ' ) devrons etre remplacé par ( \' ) et toutes varaible de notre page mère (celle ci ) sera inseré de la sorte:  '.$categorie.'
				fputs($monfichier,'<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo(\'mysql:host=localhost;dbname=forum1\',\'root\', \'\',$pdo_options);

if (isset($_POST[\'btrepondre\']) )
{
	$reponse_sujet= htmlspecialchars($_POST[\'reponse_sujet\']);
	if (!empty($_POST[\'reponse_sujet\']))
	{
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		$dh=$date.\' \'.$heure;
		$temps = new DateTime($dh);
		$dateheure = $temps->format(\'Y-m-d H:i:s\');

		$reqrepondre = $bdd->prepare("INSERT INTO reponse(message,datereponse,id_Sujet) VALUES(?,?,?) ;");
		$reqrepondre -> execute(array($reponse_sujet,$dateheure,'.$id_Sujet.'));
		$erreur=\'<font color="green">Reponse envoyée avec succès !</font>\';
	}
	else
	{
		$erreur=\'<font color="red">Ecrivez votre reponse !</font>\';
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
			<!-- ECRIVONS SON NOUVEAU POST QU\'IL A FAIT-->


			<table cellspacing="10">
					<tr>
						<td colspan=2 align=center><h2>'.$titre.'</h2></td>
					</tr>
					<tr>
					<td  Valign=top> <p>Categorie: '.$categorie.'</p></td>
					<td>'.$contenu.'</td>
					</tr>
					<!-- ON VA ALLER PRENDRE AUSSI LES REPONSE AUX SUJET -->
					<?php
					$reponse = $bdd->query("SELECT * FROM reponse WHERE id_Sujet='.$id_Sujet.' ORDER BY id_Rep ASC;");
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
									<td ALIGN=right><?php echo \'<p>Reponse \'.$i.\':\' ;?></td>
									<a href=""><td><?php echo $donnees[\'message\'] ;?></td></a>
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
</html>');

			header('Location: sujet'.$id_Sujet.'.php');

			}
			else
			{
				$erreur='<font color="red">Le pseudo n\'existe pas !</font>';
			}
	}
	else
	{
		$erreur='<font color="red">Veulliez à bien remplir tous les champs !</font>';
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
		<div align="center">
			<form ACTION=""  METHOD="POST" enctype="multipart/form-data">
			<table cellspacing="10">
				<tr>
					<td ALIGN=right><label for="pseudo">PSEUDO:</label></td>
					<td><input type="text" placeholder="votre pseudo" name="pseudo" id="pseudo" value="<?php if (!empty($_SESSION['pseudo']) ){echo $_SESSION['pseudo'];} ?>" ></td><!-- ICI ON VA METTRE LE NOM DU L'UTILISATEUR DANS LE CHAMPS PSEUDO SI CELUI CI EST CONNECTE  -->
				</tr>
				<tr>
						<td ALIGN=right><label for="nom">TITRE:</label></td>
						<td><input type="text" placeholder="Titre" name="titre" id="titre" value="<?php if(isset($titre)) {echo $titre;} ?>" ></td>
				</tr>
				<tr>
					<td><label for="categorie">CATEGORIES</label></td>
					<td><select name ="categorie" >
						<option  value ="" ></option>
						<option  value ="RESEAU" >RESEAU</option>
       					<option  value ="TELECOMMUNICATION" >TELECOMMUNICATION</option>
       					<option  value ="DEVELOPPEMENT">DEVELOPPEMENT</option> 
       					<option  value ="SCIENCE INFORMATIQUE">SCIENCE INFORMATIQUE</option>
       					<option  value ="BASE DE DONNEES">BASE DE DONNEES</option>       
       				</td>
       			</tr>
				<tr>
					<td VALIGN=top ALIGN=right><label for="contenu">CONTENU:</label></td>
					<td><TEXTAREA placeholder="Saisissez"  rows=5 cols=15 name="contenu" id="contenu" ><?php if(isset($contenu)) {echo $contenu;} ?></TEXTAREA></td>
				</tr>
				<tr>
						<td ALIGN=right ><input type="submit" name="formposter" value="POSTER"></td> <td><input type="reset" value="Annuler"></td>
				</tr>
				</table>
			</form>
			<?php
					if (isset($erreur))
					{
						echo $erreur;
					}
			?>
		</div>
	</div>		

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>