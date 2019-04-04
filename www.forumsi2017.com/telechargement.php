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
			<?php echo '<a href="index.php" style="color: white;">Accueil</a> --> telechargement';?>
			</em>
		</p>
		<p id="tab" >
			<em id="tb">téléchargement</em>
		</p>	
	</header>
	<section>

		<center>
		<form id="fomconec" method="post" action="connexion.php">
			<a id="fbconec" href=""><img src="" style="width: 15px; height: 15px;display: inline-block;vertical-align: middle;"> <span  style="display: inline-block; vertical-align: middle;">cours format PDF et  DOC </span> </a><br>
			<div class="divc"><br>
			
				<font color="white">
				ces cours sont des cour de la licence 3.<br>
				Ils permettent donc aux etudiants de la <br>
				licence de pourvoir télécharger tous les <br>
				des différents professuers d'ici et d'ailleurs<br> 
				en vue de les imprimerplutard. Merci à tous<br>
			     pour les différent projets de fin de cycle.<br>
			</font>
			
			                    
		   
			<br>
			<a id="gconec"  href=""><img src="" style="width: 15px; height: 15px;display: inline-block;vertical-align: middle;"> <span  style="display: inline-block; vertical-align: middle;">les tutoriels ou vidéos</a>
			<div class="divc">
				
				
			</div>
			<br>
			<br>
			
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