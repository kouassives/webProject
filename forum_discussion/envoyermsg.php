<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
date_default_timezone_set('GMT');
session_start();
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

if (isset($_POST['envoyermsg']) )
{
	$erreur='';
	$id=htmlspecialchars($_GET['id']);
	$req_recep = $bdd->prepare("SELECT * FROM utilisateur WHERE id_Util=?;");
	$req_recep -> execute(array($id));
	$rep_recep = $req_recep->fetch();

		$objet = htmlspecialchars($_POST['objet']);
		$message = htmlspecialchars($_POST['message']);
		
	if (!empty($_POST['objet']) AND !empty($_POST['message']) )
	{
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		$dh=$date.' '.$heure;
		$temps = new DateTime($dh);
		$dateheure = $temps->format('Y-m-d H:i:s');

		$reqenvmsg = $bdd -> prepare("INSERT INTO messages(id_Expe,id_Recep,objet,message,statu,datepost) VALUES(?,?,?,?,?,?)");
		$reqenvmsg -> execute(array($_SESSION['id'],$id,$objet,$message,0,$dateheure));
		?>
			<script type="text/javascript"> alert("Message envoyé")</script>
		
		<?php
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
	<title>ENVOYER UN MESSAGE</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ?>
	<!-- MENU -->
	<?php include("menu.php") ?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps" align="center">

	<?php
		if (isset($_GET['id']))
		{

			$id=htmlspecialchars($_GET['id']);
			$req_recep = $bdd->prepare("SELECT * FROM utilisateur WHERE id_Util=?;");
			$req_recep -> execute(array($id));
			$rep_recep = $req_recep->fetch();
		?>
		<form action="" method="POST">
			<table>
			<tr align="center">
				<td>Destinataire: </td>
				<td><?php echo $rep_recep['pseudo']; ?></td>
			</tr>
			<tr>
				<td>Objet: </td>
				<td><input type="text" name="objet"/></td>
			</tr>
			<tr>
				<td> Message: </td>
				<td><TEXTAREA placeholder="Votre message"  rows=5 cols=21 name="message"></TEXTAREA></td>
			</tr>
			<tr align="center">
				<td></td>
				<td><input type="submit" name="envoyermsg" value="Envoyer"/> <input type="reset" value="Effacer" /></td>
			</tr>
			</table>

		</form>

		<?php
		}
	?>
	</div>
	
	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>