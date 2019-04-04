<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
date_default_timezone_set('GMT');
$bdd = new pdo('mysql:host=127.0.0.1;dbname=forum1', 'root','');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>BOITE DE RECEPTION</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ;?>
	<!-- MENU -->
	<?php include("menu.php") ;?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps" align="center">
	<!-- ACCEUIL PAGE POUR UN CONNECTE-->
	<table class="table_boite_reception">
	<?php 
		$reqmsg = $bdd->prepare("SELECT * FROM messages WHERE id_Recep= ? AND statu= 0 ORDER BY id desc");
	$reqmsg -> execute(array($_SESSION['id']));
		$nbmsgnonlu = $reqmsg->rowcount();
	?>
	<tr>
			<td>Contenu</td>
			<td>Expéditeur</td>
			<td>Date</td>
	</tr>
	<tr>
			<td colspan="3">Messages non lus (<?php echo $nbmsgnonlu;?>)</td>
	</tr>

	<?php

	while ($repmsg = $reqmsg -> fetch())
	{
		$reqexep = $bdd->prepare("SELECT pseudo FROM utilisateur WHERE id_Util= ?");
		$reqexep -> execute(array($repmsg['id_Expe']));
		$repexep = $reqexep ->fetch();


		$date_post = new DateTime($repmsg['datepost']);
		$date_post_h = $date_post->format('H');
		$date_post_m = $date_post->format('i');
		$date_post_s = $date_post->format('s');
		$date_post_date = $date_post->format('d-m-Y');
		
		?>

		
		

		<tr bgcolor="green">
			<td><a href="messages.php?id=<?php echo $repmsg['id'] ?>"><?php echo $repmsg['objet'];?></a></td>
			<td><a href="compte.php?pseudo=<?php echo $repexep['pseudo'] ;?>"> <?php echo $repexep['pseudo']?></a></td>
			<td><?php echo $date_post_h.'h'.$date_post_m.'min'.$date_post_h.'s '.$date_post_date ;?></td>
		</tr>
	<?php 
	/*fermeture du while */
	}
	$reqmsg = $bdd->prepare("SELECT * FROM messages WHERE id_Recep= ? AND statu=1 ORDER BY id desc");
	$reqmsg -> execute(array($_SESSION['id']));
	$nbmsglu = $reqmsg->rowcount();
	?>

	<tr>
			<td colspan="3">Messages lus (<?php echo $nbmsglu;?>)</td>
	</tr>

	<?php
	

	while ($repmsg = $reqmsg -> fetch())
	{
		$reqexep = $bdd->prepare("SELECT pseudo FROM utilisateur WHERE id_Util= ?");
		$reqexep -> execute(array($repmsg['id_Expe']));
		$repexep = $reqexep ->fetch();


		$date_post = new DateTime($repmsg['datepost']);
		$date_post_h = $date_post->format('H');
		$date_post_m = $date_post->format('i');
		$date_post_s = $date_post->format('s');
		$date_post_date = $date_post->format('d-m-Y');
		
		?>

		
		

		<tr>
			<td><a href="messages.php?id=<?php echo $repmsg['id'] ?>"><?php echo $repmsg['objet'];?></a></td>
			<td><a href="compte.php?pseudo=<?php echo $repexep['pseudo'] ;?>"> <?php echo $repexep['pseudo']?></a></td>
			<td><?php echo $date_post_h.'h'.$date_post_m.'min'.$date_post_h.'s '.$date_post_date ;?></td>
		</tr>
	<?php 
	/*fermeture du while */
	}
	?>


	</table>	

	</div>		

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>