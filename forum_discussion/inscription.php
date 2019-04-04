<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

if (isset($_POST['forminscription']) )
{

		$nom = htmlspecialchars($_POST['nom']);
		$prenoms = htmlspecialchars($_POST['prenoms']);
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdp = sha1($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);
		$email = htmlspecialchars($_POST['email']);
		$email2 = htmlspecialchars($_POST['email2']);
		$sexe = htmlspecialchars($_POST['sexe']);
		$biographie = htmlspecialchars($_POST['biographie']);
		$preference = htmlspecialchars($_POST['preference']);
		
	if (!empty($_POST['nom']) AND !empty($_POST['prenoms']) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['sexe']) AND !empty($_POST['preference']) )
	{
		#on vérifie si taille du pseudo est bonne
		$taillepseudo = strlen($_POST['pseudo']);
		$taillemdp = strlen($_POST['mdp']);
		if (($taillepseudo >= 3) AND ($taillepseudo <= 255))
		{
			#On vérifie si le pseudo existe
			$reqspeudo = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo=?");
			$reqspeudo -> execute(array($pseudo));
			$pseudoexist = $reqspeudo->rowCount();
			if ($pseudoexist == 0)
			{
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
						if ($emailexist == 0)
						{
							#vérifions la correspondance des mot de passe
							if($taillemdp >=5 )
							{
								if ($mdp == $mdp2)
								{
									#JIL FAUT ENCORE ETUDIER CE CODE CAR LE ISSET DONNE TJRS 1, donc on enregistrera meme si lutilisateur n'envois pas d'image
									if (isset($_FILES['file']))
									{
										// nom de l'image est $name_file=$_FILES['file']['name'];
										$tmp_name=$_FILES['file']['tmp_name'];
										$local_image = "images/avatar/";     
										move_uploaded_file($tmp_name,$local_image.$pseudo.'.png');
									
										$insertuti = $bdd->prepare("INSERT INTO utilisateur(nom,prenoms,pseudo,mdp,email,sexe,biographie,preference,avatar) VALUES(?,?,?,?,?,?,?,?,?)");
										$insertuti->execute(array($nom,$prenoms,$pseudo,$mdp,$email,$sexe,$biographie,$preference,$local_image.$pseudo.'.png'));
										header('Location: confirmation_inscription.php');
										exit;
									}

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
				$erreur='<font color="red">Le speudo existe déjà !</font>';
			}
		}
		else
		{
			$erreur='<font color="red">Pour le SPEUDO 3 caractères minimum et 255 caractères maximum !</font>';
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
	<title>INSCRIPTION</title>
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
		<section>
			<div align="center">
				<form ACTION=""  METHOD="POST" enctype="multipart/form-data">
				<!-- enctype="multipart/form-data" concerne l'enregistrement de l'image-->
				<table cellspacing="10">
				<caption><h2>INSCRIPTION</h2></caption>
					<tr>
						<td ALIGN=right><label for="nom">NOM:</label></td>
						<td><input type="text" placeholder="votre nom" name="nom" id="nom" value="<?php if(isset($nom)) {echo $nom;} ?>" ></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="prenoms">PRENOM:</label></td>
						<td><input type="text" placeholder="vos prenoms" name="prenoms" id="prenoms" value="<?php if(isset($prenoms)) {echo $prenoms;} ?>"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="pseudo">PSEUDO:</label></td>
						<td><input type="text" placeholder="votre pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>" ></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="mpd">MOT DE PASSE:</label></td>
						<td><input  type="password" placeholder="votre mot de passe" name="mdp" id="mpd"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="mpd2">CONFIRMATION MOT DE PASSE:</label></td>
						<td><input  type="password" placeholder="confirmer le mot de passe" name="mdp2" id="mpd2"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="email">EMAIL:</label></td>
						<td><input  type="email" placeholder="votre email" name="email" id="email" value="<?php if(isset($email)) {echo $email;} ?>"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="email2">CONFIRMATION EMAIL:</label></td>
						<td><input  type="email" placeholder="confirmer votre email" name="email2" id="email2" value="<?php if(isset($email2)) {echo $email2;} ?>"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="sexe">SEXE:</label></td>
						<td>M<input type="radio" name="sexe" value="masculin" checked> F<input   type="radio" name="sexe" value="feminin" ></td>
					</tr>
					<tr>
						<td VALIGN=top ALIGN=right><label for="biographie">BIOGRAPHIE:</label></td>
						<td><TEXTAREA placeholder="votre biographie"  rows=5 cols=15 name="biographie" id="biographie" ><?php if(isset($biographie)) {echo $biographie;} ?></TEXTAREA></td>
					</tr>
					<tr>
						<td VALIGN=top ALIGN=right rowspan=5><label for="preference">PREFERENCES</label></td>
					    <td><input type="radio" name="preference" value="RESEAU" checked>RESEAU</td>
					</tr>
					<tr>
					    <td><input type="radio" name="preference" value="TELECOMMUNICATION" >TELECOMMUNICATION</td>
					</tr>
					<tr>
						<td><input type="radio" name="preference" value="DEVELOPPEMENT" >DEVELOPPEMENT</td>
					</tr>
						<td><input type="radio" name="preference" value="SCIENCE INFORMATIQUE" >SCIENCE INFORMATIQUE</td>
					</tr>
					<tr>
						<td><input type="radio" name="preference" value="BASE DE DONNEES" >BASE DE DONNEES</td>
					</tr>
					<tr>
						<td><input type="hidden" name="MAX_FILE_SIZE" value="2097152"></td><td><input type="file" name="file"></td>
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
		</section>
	</div>

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>