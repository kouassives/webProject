<?php 
session_start();
$erreur=0;
if (isset($_GET['sujet']))
{
	if (!empty($_GET['sujet']))
{
	$_SESSION['sujet']=$_GET['sujet'];
}

}

if ( isset($_POST['envoyer']) and isset($_POST['coment']))
{
	if ( !empty($_POST['coment']))
{
	try
	{
		
		if (!empty($_SESSION['id']))
					{
		$base=new PDO('mysql:host=localhost;dbname=baseforum','root','');
		$req=$base->prepare('insert into Commentaires (id_sujets,auteur,id_auteur,Commentaire,date_commentaire) values(?,?,?,?,?)');
		$req->execute(array($_SESSION['sujet'],$_SESSION['pseudo'],$_SESSION['id'],$_POST['coment'],date ("Y-m-d H:i:s", time())));
	
	   }
	   else
	   {
		   	$base5=new PDO('mysql:host=localhost;dbname=baseforum','root','');
			$req5 = $base5->query("SELECT id FROM membres WHERE nom='anonyme'");
			$donnees = $req5->fetch();

	   		$base=new PDO('mysql:host=localhost;dbname=baseforum','root','');
			$req=$base->prepare('insert into Commentaires (id_sujets,auteur,id_auteur,Commentaire,date_commentaire) values(?,?,?,?,?)');
			$req->execute(array($_SESSION['sujet'],'anonyme',$donnees['id'],$_POST['coment'],date ("Y-m-d H:i:s", time())));
			unset($_POST);
	   }

	}catch(Exception $e)
	{
		die('erreur: '.$e->getmessage());
	}

}
else
{
	$erreur=1;
}
	
}else
{
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title> Mon forum</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<?php 
			if (!empty($_SESSION['pseudo']))
			{
				 include("menuconec.php");
			}
			else
			{
				include("menudeconec.php");
			}
		?>
		<p>
			<em id="repe">
			<?php 
			if (empty($_GET['sujet']))
			{
				echo '<a href="index.php" style="color: white;">Accueil</a>-->'.$_SESSION['page'].'-->Sujet '.$_SESSION['sujet'].'-->Commentaires';
			}
			else
			{
				echo '<a href="index.php" style="color: white;">Accueil</a>-->'.$_SESSION['page'].'-->Sujet '.$_GET['sujet'].'-->Commentaires';
			} 
			?>
			</em>
		</p>
		<p id="tab">
			<span>Forum</span> 
		</p>
	</header>

	<section>
	<?php
	if (!empty($_SESSION['pseudo']))
			{
				include("Menu.php") ;
			} ?>
<?php
// Connexion à la base de données
try
{
$bdd = new PDO('mysql:host=localhost;dbname=baseforum', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
// On récupère les 5 derniers billets
$req = $bdd->prepare('SELECT id, id_auteur,titre,auteur, contenu,DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM sujets WHERE id = ?');
if (empty($_GET['sujet']))
{
	$req->execute(array($_SESSION['sujet']));
}
else
{
	$req->execute(array($_GET['sujet']));
}
$donnees = $req->fetch();
	$id_image=$donnees['id_auteur'];
	$base6=new PDO('mysql:host=localhost;dbname=baseforum','root','');
	$req6 = $base6->query("SELECT id_image FROM membres WHERE id=$id_image");
	$donneesimag = $req6->fetch();

?>

<center>
<h1 style="color: black;background-color: rgba(150,150,150,0.3);width: 62.2%;margin: 0;"><?php echo htmlspecialchars($donnees['titre']); ?> </h1>

<a class="liencom" href="">
<table>
	<tr>
		<td> </td>

	</tr>
	<tr>
		<td ><center><strong ><?php echo htmlspecialchars($donnees['auteur']); ?></strong> </center></td>
		
		<td><span style=" opacity: 0.6;"><?php echo $donnees['date_creation_fr']; ?></span></td>
	</tr>
	<tr>
	
		<td ><center><img src=" <?php echo $donneesimag['id_image'] ;?>" style="width: 100px;height: 100px;"></center></td>
		
		<td><span ><?php echo $donnees['contenu'];?></span></td>
	</tr>
</table>

</a>

<br>
<?php
$req->closeCursor();
?>
<?php
 // Important : on libère le curseur pour la prochaine requête
// Récupération des commentaires
$req = $bdd->prepare('SELECT auteur,id_auteur, commentaire,DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_sujets = ? ORDER BY
date_commentaire');
if (empty($_GET['sujet']))
{
	$req->execute(array($_SESSION['sujet']));
}
else
{
	$req->execute(array($_GET['sujet']));
}
$couleur="";
$i=0;
while ($donnees = $req->fetch())
{
	$id_image=$donnees['id_auteur'];
	$base6=new PDO('mysql:host=localhost;dbname=baseforum','root','');
	$req6 = $base6->query("SELECT id_image FROM membres WHERE id=$id_image");
	$donneesimag = $req6->fetch();
	$box="";
	if ($i%2==0)
	{
		$couleur="background-color: rgba(238,238,238,0.6);";
		
	}
	else
	{
		$couleur="background-color: rgba(255,255,255,0.3)";
		$box="0px 0px 0px 0px white";
	}
	$i++;
?>
<table class="liencom" style="<?php echo $couleur?>;box-shadow: <?php echo $box;?>;">
	<tr >
		<td ><center><strong ><?php echo htmlspecialchars($donnees['auteur']); ?></strong></center> </td>
		<td><pre>      </pre></td>
		<td><br><span style=" opacity: 0.6;"><?php echo $donnees['date_commentaire_fr']; ?></span></td>
	</tr>
	<tr>
		<td style="display: inline-block;vertical-align: top;"><center><img src="<?php echo $donneesimag['id_image'] ;?>" style="width: 100px;height: 100px;margin-left: 18px;"></center></td>
		
		<td><pre>      </pre></td>
		<td ><p style="word-wrap: break-word;display: inline-block;vertical-align: top;"><?php echo nl2br(htmlspecialchars($donnees['commentaire']));?></p></td>
	</tr>
</table>
<?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>
<?php 
	if($erreur==1) 
	{
		echo "VEUILLEZ REMPLIR TOUS LES CHAMPS";
		$erreur=0;
	}
?>
<form style="display: inline-block;margin-bottom: 50px; width: 80%;" method="post" action="" >
<center>
		<table class="" >
			<tr >
				<td><textarea rows="12" cols="117" name="coment" style="box-shadow: 0px 3px 2px black inset;"></textarea></td>
			</tr>
	
		</table>
		
	</fieldset>
	</center>
	<span style="margin-left: 71%;">
		<input type="submit" name="envoyer" value="Répondre" style="background-color: blue;color: white; border-radius: 5px 5px 5px 5px;">
		</span>
</form>
<br><br>
</center>
<br><br><br>
	</section>
	<footer>
		<?php include("pied_de_page.php");?>
	</footer>

</body>
</html>