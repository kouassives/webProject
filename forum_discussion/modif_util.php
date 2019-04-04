
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>MODIFIER MES INFORMATIONS</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ?>
	<!-- MENU -->
	<?php include("menu.php") ?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps">

	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

if (isset($_POST['forminscription']) )
{

	if (!empty($_POST['ancienc_mpd']))
	{
		$nom = htmlspecialchars($_POST['nom']);
		$prenoms = htmlspecialchars($_POST['prenoms']);
		$pseudo = $_SESSION['pseudo'];
		$ancienc_mpd = sha1($_POST['ancienc_mpd']);
		$mdp = sha1($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);
		$email = htmlspecialchars($_POST['email']);
		$email2 = htmlspecialchars($_POST['email2']);
		$sexe = htmlspecialchars($_POST['sexe']);
		$biographie = htmlspecialchars($_POST['biographie']);
		$preference = htmlspecialchars($_POST['preference']);
		
				# on continue si taille<=255...
				#vérifions la correspondance des mails
				if ($email == $email2)
				{
					#POUR des risque que utilisateur parte dans le code soucre pour changer le type du email en text, et entrer nimporte quoi qui sera pris par notre email, on utilise la fonction FILTER_VALIDATE_EMAIL
					if (filter_var($email,FILTER_VALIDATE_EMAIL))
					{
						$reqemail = $bdd->prepare("SELECT * FROM utilisateur WHERE email=?");
						$reqemail -> execute(array($email));
						$emailexist = $reqemail->rowCount();
						#si $emailexist <= 1 cela signifie que l'email existe mais sur 1 seul exemplaire, donc c'est ce utilisateur seulement qui le possède alors on peut effectuer les modification sans soucis
						if ($emailexist <= 1)
						{
							#on vérifie si la taille du mot de passe est bonne
							#On va prendre les infos de l'utilisateur pour verifier le mot de passe
							$req_ut = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo=?");
							$req_ut -> execute(array($pseudo));
							$donnes_ut = $req_ut ->fetch();
							
							if($donnes_ut['mdp']==$ancienc_mpd)
							{
								$taillemdp = strlen($mdp);
								if($taillemdp >=5)
								{
									#vérifions la correspondance des mot de passe
									if ($mdp == $mdp2)
									{
										if (empty($_POST['mdp']))
										{
											$mdp=$ancienc_mpd;
										}
									
										$insertuti = $bdd->prepare("UPDATE utilisateur SET nom=?, prenoms=?, mdp=?, email=?, sexe=?, biographie=?, preference=? WHERE pseudo=?");
										$insertuti->execute(array($nom,$prenoms,$mdp,$email,$sexe,$biographie,$preference,$pseudo));
										header('Location: compte.php?pseudo='.$pseudo);
										exit;
									}
									else
									{
										$erreur='<font color="red">Vos mots de passe ne correspondent pas !</font>';
									}
								}
								else
								{
									$erreur='<font color="red">Mot de passe trop court, 5 caractères minimun !</font>';
								}	
							}
							else
							{
								$erreur='<font color="red">L\'ancien mot de passe est incorrect !</font>';
							}

						}
						else
						{
							$erreur='<font color="red">Un utilisateur est déjà inscrit avec ce email !</font>';
						}
					}
					else
					{
						$erreur='<font color="red">Votre adresse mail n\'est pas valide !</font>';
					}
				}
				else
				{
					$erreur='<font color="red">Vos adresses mail ne correspondent pas !</font>';
				}
			


	}
	else
	{
		$erreur='<font color="red">Veulliez à bien remplir tous les champs !</font>';
    }
}

?>

		<section>
		<?php
		#SI DANS L'URL CONTIENT ?pseudo='xxx'
		if (isset($_GET['pseudo']))
		{
			$pseudo=htmlspecialchars($_GET['pseudo']);
			$req_util = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo=?;");
			$req_util -> execute(array($pseudo));
			$donnes_util = $req_util->fetch();
			#VERIFIIONS SI LUTILISATEUR QUI A QUI A L'id $_GET['pseudo'] EXISTE
			#ET ON TRAVAILLERA A PARTIR DE CE POINT AVEC $donnes_util['pseudo'] AU LIEU DE $_GET['pseudo'] et $pseudo
			if (!empty($donnes_util['pseudo']))
			{
				#L'UTILISATEUR EXISTE ALORS ON RECUPERE LES INFOS POUR LES AFFICHER SEULEMENT SI IL EST CONNECTé
				if (!empty($_SESSION['pseudo']))
				{
					#ON va vérifier que l'utilisateur dont on veut modifier les infos est celui connecté
					if($_SESSION['pseudo']==$donnes_util['pseudo'])
					{
					?>
					<div align="center">
						<form ACTION=""  METHOD="POST">
						<!-- enctype="multipart/form-data" concerne l'enregistrement de l'image-->
						<table cellspacing="10">
						<caption><h2>MODIFICATIONS</h2></caption>
							<tr>
								<td ALIGN=right><label for="nom">NOM:</label></td>
								<td><input type="text" placeholder="votre nom" name="nom" id="nom" value="<?php if(isset($nom)) {echo $nom;} else {echo $donnes_util['nom'];} ?>" ></td>
							</tr>
							<tr>
								<td ALIGN=right><label for="prenoms">PRENOM:</label></td>
								<td><input type="text" placeholder="vos prenoms" name="prenoms" id="prenoms" value="<?php if(isset($prenoms)) {echo $prenoms;} else {echo $donnes_util['prenoms'];} ?>"></td>
							</tr>
							<tr>
								<td ALIGN=right><label for="pseudo">PSEUDO:</label></td>
								<td><input type="text" placeholder="votre pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} else {echo $donnes_util['pseudo'];} ?>" > Pseudo inchangeable</td>
							</tr>
							<tr>
								<td ALIGN=right><label for="ancienc_mpd">MOT DE PASSE ACTUEL:</label></td>
								<td><input  type="password" placeholder="votre mot de passe actuel" name="ancienc_mpd" id="mpd"> ? Obligatoire</td>
							</tr>
							<tr>
								<td ALIGN=right><label for="mpd">NOUEVAU MOT DE PASSE:</label></td>
								<td><input  type="password" placeholder="votre nouveau mot de passe" name="mdp" id="mpd"> ? Facultatif</td>
							</tr>
							<tr>
								<td ALIGN=right><label for="mpd2">CONFIRMATION MOT DE PASSE:</label></td>
								<td><input  type="password" placeholder="confirmer le mot de passe" name="mdp2" id="mpd2"> ? Facultatif</td>
							</tr>
							<tr>
								<td ALIGN=right><label for="email">EMAIL:</label></td>
								<td><input  type="email" placeholder="votre email" name="email" id="email" value="<?php if(isset($email)) {echo $email;} else {echo $donnes_util['email'];} ?>"></td>
							</tr>
							<tr>
								<td ALIGN=right><label for="email2">CONFIRMATION EMAIL:</label></td>
								<td><input  type="email" placeholder="confirmer votre email" name="email2" id="email2" value="<?php if(isset($email2)) {echo $email2;} else {echo $donnes_util['email'];} ?>"></td>
							</tr>
							<tr>
								<td ALIGN=right><label for="sexe">SEXE:</label></td>
								<td>M<input type="radio" name="sexe" value="masculin" <?php if($donnes_util['sexe']=="m") {echo "checked";} ?> > F<input   type="radio" name="sexe" value="feminin"  <?php if($donnes_util['sexe']=="f") {echo "checked";} ?>></td>
							</tr>
							<tr>
								<td VALIGN=top ALIGN=right><label for="biographie">BIOGRAPHIE:</label></td>
								<td><TEXTAREA placeholder="votre biographie"  rows=5 cols=15 name="biographie" id="biographie" ><?php if(isset($biographie)) {echo $biographie;} else {echo $donnes_util['biographie'];} ?></TEXTAREA></td>
							</tr>
							<tr>
								<td VALIGN=top ALIGN=right rowspan=5><label for="preference">PREFERENCES</label></td>
							    <td><input type="radio" name="preference" value="RESEAU" <?php if(isset($preference) AND $preference=="RESEAU") echo "checked"; ?> >RESEAU</td>
							    <td rowspan="5">|</br>|</br>|</br>|</br>? Obligatoire</br>|</br>|</br>|</br>|</td>
							</tr>
							<tr>
							    <td><input type="radio" name="preference" value="TELECOMMUNICATION" <?php if(isset($preference) AND $preference=="TELECOMMUNICATION") echo "checked"; ?> >TELECOMMUNICATION</td>
							</tr>
							<tr>
								<td><input type="radio" name="preference" value="DEVELOPPEMENT" <?php if(isset($preference) AND $preference=="DEVELOPPEMENT") echo "checked"; ?>  >DEVELOPPEMENT</td>
							</tr>
								<td><input type="radio" name="preference" value="SCIENCE INFORMATIQUE" <?php if(isset($preference) AND $preference=="SCIENCE INFORMATIQUE") echo "checked"; ?> >SCIENCE INFORMATIQUE</td>
							</tr>
							<tr>
								<td><input type="radio" name="preference" value="BASE DE DONNEES" <?php if(isset($preference) AND $preference=="BASE DE DONNEES") echo "checked"; ?> >BASE DE DONNEES</td>
							</tr>
							<tr>
								<td ALIGN=right ><input type="submit" name="forminscription" value="Enregistrer"></td> <td><input type="reset" value="Annuler"></td>
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
					<?php
					}
					else
					{
						echo '<p style="color: red; text-align:center;">Vous tentez de modifier les informations d\'un autre utilisateur, ce qui est impossible !</p>' ;
					}
				}
				else
				{
					echo '<p style="color: red; text-align:center;"><a href="connexion.php">Connectez</a> vous avant de repondre au sujet !</p>' ;
				}
			}
			else
			{
				echo '<p style="color: red; text-align:center;">Aucun utilisateur n\'est enregistré sous ce pseudo !</p>';
			}

		}
		?>
		</section>
	</div>

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>