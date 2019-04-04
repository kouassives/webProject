<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>LIVRE D'OR</title>
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ;?>
	<!-- MENU -->
	<?php include("menu.php") ;?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps">
	<div align="center">
	<!-- LIVRE D'OR -->
	<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=127.0.0.1;dbname=forum1','root', '',$pdo_options);
date_default_timezone_set('GMT');

if (isset($_POST['bt_subi_form']))
{
	$message=$_POST['message'];
	if (!empty($_POST['message']))
	{
			#On va reccuperer l'heure
				$date = date("Y-m-d");
				$heure = date("H:i:s");
				$dh=$date.' '.$heure;
				$temps = new DateTime($dh);
				$dateheure = $temps->format('Y-m-d H:i:s');
		if (!empty($_SESSION['pseudo']))
		{
			$pseudo=$_SESSION['pseudo'];
			$req_inserer = $bdd -> prepare('INSERT INTO livredor(pseu,message,datepost) VALUES (?,?,?)');
			$req_inserer -> execute(array($pseudo,$message,$dateheure));
		}
		else
		{
			$req_inserer = $bdd -> prepare('INSERT INTO livredor(pseu,message,datepost) VALUES ("invité",?,?)');
			$req_inserer -> execute(array($message,$dateheure));
		}
	}
	else
	{
		$erreur='<font color="red">Ecrivez votre message !</font>';
	}
	
}

?>
	<form method="post" action="">
        <p>Notre site vous plaît ? Laissez-nous un message !</p>
        <p>
            Message :<br />
            <textarea name="message" rows="8" cols="35"></textarea><br />
            <input type="submit" name="bt_subi_form" value="Envoyer" />
        </p>
    </form>
    <?php
    if(isset($erreur))
    {
    	echo $erreur;
    }
    ?>


	<?php
	//On va verifier si la variable categorie $_GET['cat'] et la variable $_GET['page'] sont bien entrée dans la barre d'adresses
	// Si la categorie n'est pas saisie on affiche un message " OOps ! Adresse non valide "	
	
	if (isset($_GET['page']) AND !empty($_GET['page']))
		{
			$page = intval($_GET['page']);
		    // On récupère le numéro de la page indiqué dans l'adresse (livredor.php?page=4)
		}
		else // La variable n'existe pas, c'est la première fois qu'on charge la page
		{
		        $page = 1; // On se met sur la page 1 (par défaut)
		}
		?>
			
		 
			<p class="pages">
		 
			<?php

				// On écrit les liens vers chacune des pages
				// -----------------------------------------
				 
				// On met dans une variable le nombre de messages qu'on veut par page
				$nombreDeMessagesParPage = 10; // Essayez de changer ce nombre pour voir :o)
				// On récupère le nombre total de messages
				$retour = $bdd->query('SELECT COUNT(*) AS nb_messages FROM livredor');
				$donnees = $retour->fetch();
				$totalDesMessages = $donnees['nb_messages'];
				// On calcule le nombre de pages à créer
				$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
				// Puis on fait une boucle pour écrire les liens vers chacune des pages
			?>
				<table class="table_sujet">
					<tr>
						<td class="classred">PAGE</td>
				<?php
				for ($i = 1 ; $i <= $nombreDePages ; $i++)
				{
					?>
					<td class="classred"><a class="classred" href="livredor.php?<?php echo 'page='.$i; ?>"> <?php echo $i ?></a></td>

					<?php
				}
				?>
				</table>
				 
				 
				<?php

				// Maintenant, on va afficher les messages
				// ---------------------------------------
				 
				// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
				$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
				 
				$req_livredor = $bdd->query('SELECT * FROM livredor ORDER BY id DESC LIMIT ' . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);
				?>
				<table cellpadding=10 cellspacing=5 class="table_sujet">
				<tr>
					<td class="classred"><strong>AUTOR</strong></td>
					<td class="classblue"><strong>POST</strong></td>
				</tr>
				<tr></tr>
				<tr></tr>
				 <?php
				while ($donnees_livredor = $req_livredor->fetch())
				{
				$date_post = new DateTime($donnees_livredor['datepost']);
				$date_post_h = $date_post->format('H');
				$date_post_m = $date_post->format('i');
				$date_post_s = $date_post->format('s');
				$date_post_date = $date_post->format('d-m-Y');
				?>
				        
					        <tr>
						        <td class="classblue"><?php if ($donnees_livredor['pseu'] != "invité") echo '<a href="compte.php?pseudo='.$donnees_livredor['pseu'].'">';?><?php echo $donnees_livredor['pseu']?><?php if ($donnees_livredor['pseu'] != "invité") echo '</a>';?></br><?php echo $date_post_h.'h'.$date_post_m.'min'.$date_post_s.'s '.$date_post_date;?></td>
						        <td><?php echo $donnees_livredor['message']?></td>
					        </tr>
				        
				<?php
				}
				?>
				</table>
				</div>
	</div>		

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>