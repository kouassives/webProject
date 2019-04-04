<?php

session_start();
if (isset($_POST['pseudo']) and  isset($_POST['motpasse']))
{
	if (!empty($_POST['pseudo']) and  !empty($_POST['motpasse']))
	{
			try
			{
				$base=new PDO('mysql:host=localhost;dbname=baseforum','root','');
			}
			catch(Exception $e)
			{
				die('erreur: '.$e->getmessage());
			}
				$req=$base->prepare('select id,id_image,nom from membres where nom=? and motpasse=?');
				$req->execute(array($_POST['pseudo'],$_POST['motpasse']));
				if ($reponse=$req->fetch())
				{
					$_SESSION['pseudo'] = $_POST['pseudo'];
					$_SESSION['id'] = $reponse['id'];
					$_SESSION['motpasse'] = $_POST['motpasse'];
					$_SESSION['id_image'] = $reponse['id_image'];
					header("location:index.php");
				}
				else
				{
					$req2=$base->prepare('select id,id_image,nom from membres where email=? and motpasse=?');
					$req2->execute(array($_POST['pseudo'],$_POST['motpasse']));
					
					if ($reponse=$req2->fetch())
				{
					$_SESSION['pseudo'] = $reponse['nom'];
					$_SESSION['id'] = $reponse['id'];
					$_SESSION['motpasse'] = $_POST['motpasse'];
					$_SESSION['id_image'] = $reponse['id_image'];
					header("location:index.php");
				}
				else
				{
					echo 'pseudo ou mot de passe incorrect';
				}
				}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Mon forum</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
	<header>
		<?php include("menudeconec.php");?>
		<p>
			<em id="repe" style="color: white;">
			<?php echo '<a href="index.php" style="color: white;">Accueil</a> --> Connexion';?>
			</em>
		</p>
		<p id="tab" >
			<em id="tb">Connexion</em>
		</p>	
	</header>
	<section>

		<center>
		<form id="fomconec" method="post" action="connexion.php">
			<a id="fbconec" href=""><img src="" style="width: 15px; height: 15px;display: inline-block;vertical-align: middle;"> <span  style="display: inline-block; vertical-align: middle;">Se connecter avec Facebook</span> </a>
			<div class="divc">
				<label for="pseudo">Pseudo </label><br>
				<input class="champ" type="text" name="pseudo" ><br>
			</div><br><br>
			<a id="gconec"  href=""><img src="" style="width: 15px; height: 15px;display: inline-block;vertical-align: middle;"> <span  style="display: inline-block; vertical-align: middle;">Se connecter avec Google</a>
			<div class="divc">
				<label for="motpasse">Mot de passe</label><br>
				<input class="champ" type="password" name="motpasse"><br>
			</div>
			<br>
			<br>
				<a href="" style="display: inline-block; margin-left: 730px; ">Mot de passe oublié</a><br>
			
			<input id="btenvoie" type="submit" name="envoyer" value="Se connecter"><br><br>
			
		</form>
		<p >Pas encore membre?<a  href="inscription.php">Inscrivez-vous gratuitement</a></p>
		</center>
		<br><br><br>
	</section>
	<footer>
		<?php include("pied_de_page.php");?>
	</footer>

</body>
</html>