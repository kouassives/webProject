<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);
#POUR DONNER L'HEURE GMT 
date_default_timezone_set('GMT');

if (isset($_POST['formposter']) )
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$contenu = htmlspecialchars($_POST['contenu']);
	$titre = htmlspecialchars($_POST['titre']);
	$categorie = htmlspecialchars($_POST['categorie']);
	if (!empty($_POST['pseudo']) AND !empty($_POST['titre']) AND !empty($_POST['contenu']) AND !empty($_POST['categorie']) )
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
				$erreur='<p>Sujet posté avec Succès!<p><p><a href="sujet.php?id='.$id_Sujet.'">Cliquez ici</a> pour accéder au sujet</p>';
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
	<?php include('partieentete.php');?>
	<title>POSTER SUJET</title>
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
				<tr class="btpostercacher">
					<td ALIGN=right><label for="pseudo">PSEUDO:</label></td>
					<td><input type="text" placeholder="votre pseudo" name="pseudo" id="pseudo" value="<?php if (!empty($_SESSION['pseudo']) ){echo $_SESSION['pseudo'];} ?>" ></td><!-- ICI ON VA METTRE LE NOM DU L'UTILISATEUR DANS LE CHAMPS PSEUDO SI CELUI CI EST CONNECTE  -->
				</tr>
				<tr class="btpostercacher">
						<td ALIGN=right><label for="nom">TITRE:</label></td>
						<td><input type="text" placeholder="Titre" name="titre" id="titre" value="<?php if(isset($titre)) {echo $titre;} ?>" ></td>
				</tr>
				<tr class="btpostercacher">
					<td><label for="categorie">CATEGORIES</label></td>
					<td><select name ="categorie">
						<option  value ="" ></option>
						<option  value ="RESEAU" <?php if( isset($categorie) AND $categorie== "RESEAU") {echo "selected";} ?> >RESEAU</option>
       					<option  value ="TELECOMMUNICATION" <?php if( isset($categorie) AND $categorie== "TELECOMMUNICATION") {echo "selected";} ?>>TELECOMMUNICATION</option>
       					<option  value ="DEVELOPPEMENT" <?php if( isset($categorie) AND $categorie== "DEVELOPPEMENT") {echo "selected";} ?> >DEVELOPPEMENT</option> 
       					<option  value ="SCIENCE INFORMATIQUE" <?php if( isset($categorie) AND $categorie== "SCIENCE INFORMATIQUE") {echo "selected";} ?> >SCIENCE INFORMATIQUE</option>
       					<option  value ="BASE DE DONNEES" <?php if( isset($categorie) AND $categorie== "BASE DE DONNEES") {echo "selected";} ?> >BASE DE DONNEES</option>       
       				</td>
       			</tr>
				<tr class="btpostercacher">
					<td VALIGN=top ALIGN=right><label for="contenu">CONTENU:</label></td>
					<td><TEXTAREA placeholder="Saisissez"  rows=5 cols=15 name="contenu" id="contenu" ><?php if(isset($contenu)) {echo $contenu;} ?></TEXTAREA></td>
				</tr>
				<tr class="btpostercacher">
						<td ALIGN=right ><input type="submit" name="formposter" value="POSTER"></td> <td><input type="reset" value="Annuler"></td>
				</tr>
				<tr>
					<td  align="center" id="btposterseconnecter" colspan="2"><p style="color: red"><a href="connexion.php">Connectez</a> vous avant de poster un sujet !</p></td>
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