<?php 
session_start();
if (isset($_GET['id_categ']))
{
	$_SESSION['id_categ']=$_GET['id_categ'];
}
if (isset($_GET['page']))
{
	$_SESSION['page']=$_GET['page'];
}
if (isset($_POST['ajout']) and isset($_POST['titre']) and isset($_POST['contenu']))
{


	if (!empty($_POST['titre']) and !empty($_POST['contenu']) and !empty($_SESSION['id_categ']))
{
	try
	{


		$base=new PDO('mysql:host=localhost;dbname=baseforum','root','');
		$req=$base->prepare('insert into sujets (id_categ,titre,auteur,id_auteur,contenu,date_creation) values(?,?,?,?,?,?)');
		$req->execute(array($_SESSION['id_categ'],$_POST['titre'],$_SESSION['pseudo'],$_SESSION['id'],$_POST['contenu'],date ("Y-m-d H:i:s", time())));

		unset($_POST);
	}catch(Exception $e)
	{
		die('erreur: '.$e->getmessage());
	}
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body >
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
			<?php echo '<a href="index.php" style="color: white;">Accueil</a>-->'.$_SESSION['page'].'-->Sujets';?>
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
$id_categ=$_SESSION['id_categ'];
$page=$_SESSION['page'];
$nbr=($page-1)*4;
$req = $bdd->query("SELECT id, titre,auteur, contenu,DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM sujets where id_categ=$id_categ ORDER BY date_creation DESC LIMIT $nbr,4");
while ($donnees = $req->fetch())
{
	try
{
$bdd2 = new PDO('mysql:host=localhost;dbname=baseforum', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$id=$donnees['id'] ;
// On récupère les 5 derniers billets
$req2 = $bdd2->query('SELECT count(commentaire) as nbr,DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM commentaires  where id_sujets= '.$donnees['id']);
$req3 = $bdd2->query("SELECT auteur ,DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM commentaires  where	 id_sujets=$id ORDER BY date_commentaire DESC");
$donnees2 = $req2->fetch();
$donnees3 = $req3->fetch();
?>

<center>
<a class="liencom" href="commentaires.php?sujet=<?php echo $donnees['id'];?>">
<table>
	<tr>
		<td><strong style="font-size: 13px;"><?php echo htmlspecialchars($donnees['titre']);?></strong></td>
		<td rowspan="2"><span style=""> <?php echo $donnees2['nbr']; ?> messages</span></td>
		<td><span style=""> Dernier message </span></td>
	</tr>

	<tr>
		<td> Par <?php echo htmlspecialchars($donnees['auteur']);?> <?php echo $donnees['date_creation_fr']; ?></td>
		<td><span style=""> par <?php echo $donnees3['auteur'];?> <?php echo $donnees3['date_creation_fr'];?></span></td>
	</tr>
</table>

</a>
	
<?php 

}
$req->closeCursor();
 ?>
 <br>
 <?php
 	 try
	{
	$bdd4 = new PDO('mysql:host=localhost;dbname=baseforum', 'root', '');
	}
	catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}
	// On récupère les 5 derniers billets
	$id_categ=$_SESSION['id_categ'];
	$req4 = $bdd4->query("SELECT count(*) as nbr_sujet FROM sujets where id_categ=$id_categ");
	$donnees4 = $req4->fetch();
	$num=0;
	for ($i=0; $i <$donnees4['nbr_sujet'] ; $i+=4) { 
		$num++;

		if ($_SESSION['page']==$num)
		{
		?>
		<span href="sujets.php?page=<?php echo $num;?>" style="padding-left: 10px;padding-right: 10px;padding-bottom: 5px;padding-top: 5px;display: inline-block;background-color: rgb(128,128,128);color: white;"><?php echo $num?></span> 
		<?php
		}
		else
		{
		?>
		<a href="sujets.php?page=<?php echo $num;?>" style="padding-left: 10px;padding-right: 10px;padding-bottom: 5px;padding-top: 5px;display: inline-block;background-color: rgb(237,91,39);"><?php echo $num?></a>

		<?php
		}
	}
	?>
	
	<br><br>
	<?php if (isset($_POST['creer'])) {

		?>
	<form style="display: inline-block;margin-bottom: 50px; width: 80%;" method="post" action="sujets.php" >

		<table class="" >
			<tr >
				<td><input  type="text" class="champ" name="titre" maxlength="40" placeholder="Titre" style="width: 99%;"><br>
				<textarea rows="12" cols="119" name="contenu" style="width: 99%;"></textarea>
				</td>
			</tr>
	
		</table>
		<span style="margin-left: 72%;">
		<input type="submit" name="ajout" value="Envoyer" style="background-color: blue;color: white; border-radius: 5px 5px 5px 5px;">
		</span>
	</form>
<br>
<br>
<?php
} // Fin de la boucle des billets
else
{
	if (!empty($_SESSION['pseudo']))
	{
?>

	<form action="" method="post" style="margin-left: 56%;" >
	<input type="submit" name="creer" value="creer sujet" style="background-color: blue;color: white; border-radius: 5px 5px 5px 5px;">
	</form>
	<br>
	<br>

<?php
	}
}
?>
		</center>
		<br><br><br><br><br><br><br><br><br>
	</section>
	<footer >
		<?php include("pied_de_page.php");?>
	</footer>

</body>
</html>