<?php
date_default_timezone_set('GMT');
session_start();
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

if (isset($_GET['id']))
{
	$idmsg =$_GET['id'];
	$reqmsg = $bdd -> prepare("SELECT * FROM messages WHERE id=?");
	$reqmsg -> execute(array($idmsg));
	$repmsg =  $reqmsg -> fetch();
	/*marquer les messages lu*/

	$reqmarquerlu = $bdd -> prepare("UPDATE messages SET statu=? WHERE id=?");
	$reqmarquerlu -> execute(array(1,$_GET['id']));
				
	
	/* cherchons qui des deux interlocuteur est le connecté*/
	
	if($_SESSION['id']==$repmsg['id_Recep'])
	{
		$id_rec=$_SESSION['id'];
		$id_ex=$repmsg['id_Expe'];
		$test=1; /*Quand le l'expediteur est celi du message courant*/
	}
	else
	{
		$test=0;
		$id_rec=$_SESSION['id'];
		$id_ex=$repmsg['id_Recep'];
	}


	/*RECCUPEREATION DES INFOS DES INTERLOCUTEURS*/
	/* le recepteur (connecté)*/
	$req_Recep = $bdd -> prepare("SELECT * FROM utilisateur WHERE id_Util=?");
	$req_Recep -> execute(array($repmsg['id_Recep']));
	$rep_Recep =  $req_Recep -> fetch();
	/* le exepditeur (interlocuteur)*/
	$req_Expe = $bdd -> prepare("SELECT * FROM utilisateur WHERE id_Util=?");
	$req_Expe -> execute(array($repmsg['id_Expe']));
	$rep_Expe =  $req_Expe -> fetch();	

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>CONVERSATION</title>
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
		<?php 
		if(isset($_GET['id']))
		{
			$reqlistemsg = $bdd -> prepare("SELECT * FROM messages WHERE id_Expe=? AND id_Recep=? OR id_Expe=? AND id_Recep=? ORDER BY id ASC");
			$reqlistemsg -> execute(array($id_ex,$id_rec,$id_rec,$id_ex));	
			

			?>
			<table cellspacing="10" class="table_sujet">
						<tr>
							<td colspan=2 align=center><h2>Conversation avec <?php if($test==1) echo $rep_Expe['pseudo']; else echo $rep_Recep['pseudo'];?></h2></td>
						</tr>
						<tr>
							<td Valign=top> Detais</td>
							<td Valign=top> Messages</td>
						</tr>
			<?php

			while ($replistemsg = $reqlistemsg -> fetch())
			{
				
				$date_post = new DateTime($replistemsg['datepost']);
				$date_post_h = $date_post->format('H');
				$date_post_m = $date_post->format('i');
				$date_post_s = $date_post->format('s');
				$date_post_date = $date_post->format('d-m-Y');

				$reqexpe = $bdd -> prepare("SELECT * FROM utilisateur WHERE id_Util=?");
				$reqexpe -> execute(array($replistemsg['id_Expe']));
				$repexpe = $reqexpe -> fetch();

			?>	
					<tr>
						<td  Valign=top>
						
						<p>Envoyé par <a href="compte.php?pseudo=<?php echo $repexpe['pseudo'] ;?>">	<?php echo $repexpe['pseudo'] ;?></a></p>
						<p><?php echo $date_post_h.'h'.$date_post_m.'min'.$date_post_s.'s '.$date_post_date ?><?php if($repexpe['statu']==1) echo "<p>Connecté(e)</p>"; else echo "<p>hors ligne(e)</p>"; ?> </p></td>
						<td><!-- ON ECRIS LA LE COPRS DU SUJET --><div align="left">Objet:<?php echo $replistemsg['objet']; ?></div><?php echo $replistemsg['message']; ?></td>
					</tr>
			<?php 
			}
			/* REPONDRE */
			if (isset($_POST['btrepondre']) )
			{
				$reponse_sujet= htmlspecialchars($_POST['reponse_sujet']);
				$objet= htmlspecialchars($_POST['objet']);
				
				if (!empty($_POST['reponse_sujet']))
				{
					$date = date("Y-m-d");
					$heure = date("H:i:s");
					$dh=$date.' '.$heure;
					$temps = new DateTime($dh);
					$dateheure = $temps->format('Y-m-d H:i:s');

					$reqrepondre = $bdd->prepare("INSERT INTO messages(id_Expe,id_Recep,objet,message,statu,datepost) VALUES(?,?,?,?,?,?)");
					$reqrepondre -> execute(array($id_rec,$id_ex,$objet,$reponse_sujet,0,$dateheure));
					$erreur='<font color="green">Reponse envoyée avec succès !</font>';
				}
				else
				{
					$erreur='<font color="red">Ecrivez votre reponse !</font>';
				}
			}
?>
			<form ACTION=""  METHOD="POST">
							<tr>
								<td></td><td  align="center">Objet <input  type="text" name="objet" value="<?php echo 'Re('.$repmsg['objet'].')';?>" class="btrepondreacacher" /></td>
							</tr>
							
							<tr>
								<td></td><td  align="center"><TEXTAREA placeholder="Votre reponse"  rows=n cols=m name="reponse_sujet" id="reponse_sujet" class="btrepondreacacher" ></TEXTAREA></td>
							</tr>
							<tr>
								<td></td><td  align="center" class="btrepondreacacher"><input type="submit" name="btrepondre" value="REPONDRE"><input type="reset" value="Annuler" class="btrepondreacacher"></td>
							</tr>
							<tr>
								<td  align="center" id="btposterseconnecter" colspan="2"><p style="color: red"><a href="connexion.php">Connectez</a> vous avant de repondre au sujet !</p></td>
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
		<?php
		}
		else
		{
			echo "Page non trouvée";
		}
		?>
	</div>		

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>