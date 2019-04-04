<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);
#POUR DONNER L'HEURE GMT 
date_default_timezone_set('GMT');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include('partieentete.php');?>
	<title>TELECHARGEMENT</title>
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
	
	<?php include('posterfichierpannel.php') ?>

	<?php 
		
	//On va verifier si la variable categorie $_GET['cat'] et la variable $_GET['page'] sont bien entrée dans la barre d'adresses
	// Si la categorie n'est pas saisie on affiche un message " OOps ! Adresse non valide "	
	
	if (isset($_GET['page']) AND !empty($_GET['page']))
		{
			$page = intval($_GET['page']);
		    // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
		}
		else // La variable n'existe pas, c'est la première fois qu'on charge la page
		{
		        $page = 1; // On se met sur la page 1 (par défaut)
		}

		if ( isset($_GET['cat']) )
		{
			if(empty($_GET['cat']))
			{
				$_GET['cat']=1;	
			}
			$cat=htmlspecialchars($_GET['cat']);

			$req_nom_cat = $bdd -> prepare('SELECT * FROM categorie WHERE id_Cat=?');
			$req_nom_cat -> execute(array($cat));
			$donnees_nom_cat = $req_nom_cat -> fetch();

			$reqfichier = $bdd -> prepare('SELECT * FROM fichier WHERE id_Cat=?');
			$reqfichier -> execute(array($cat));
			$nbfichier= $reqfichier -> rowcount();
			if ($nbfichier==0)
			{
				echo '<p style="text-align: center"> Aucun fichier dans la catégorie '.$donnees_nom_cat['libelle'].'</p>';
			}
			else
			{
			?>
			
		 
			<p class="pages">
		 
			<?php
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new pdo('mysql:host=127.0.0.1;dbname=forum1','root', '',$pdo_options);

				// On écrit les liens vers chacune des pages
				// -----------------------------------------
				 
				// On met dans une variable le nombre de messages qu'on veut par page
				$nombreDeMessagesParPage = 10; // Essayez de changer ce nombre pour voir :o)
				// On récupère le nombre total de messages
				$retour = $bdd->prepare('SELECT COUNT(*) AS nb_messages FROM fichier  WHERE id_Cat=?');
				$retour ->execute(array($cat));
				$donnees = $retour->fetch();
				$totalDesMessages = $donnees['nb_messages'];
				// On calcule le nombre de pages à créer
				$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
				// Puis on fait une boucle pour écrire les liens vers chacune des pages
				?>
				<table class="table_sujet">
				<?php
					$req_cat = $bdd -> prepare('SELECT * FROM categorie WHERE id_Cat=?');
					$req_cat -> execute(array($cat));
					$donnees_cat = $req_cat -> fetch();
				?>
					<tr>
						<th colspan="2"><h4><?php echo $donnees_cat['libelle']; ?></h4></th>
					</tr>
					<tr>
						<td>PAGES</td>
				<?php
				for ($i = 1 ; $i <= $nombreDePages ; $i++)
				{
					?>
					<td><a href="telechargement.php?cat=<?php echo $cat.'&amp;page='.$i; ?>"> <?php echo $i ?></a></td>

					<?php
				}
				?>
				</table>
				 
				 
				<?php

				// Maintenant, on va afficher les messages
				// ---------------------------------------
				 
				// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
				$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
				 
				$req_fichier = $bdd->prepare('SELECT * FROM fichier WHERE id_Cat=? ORDER BY id_fich DESC LIMIT ' . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);
				$req_fichier->execute(array($cat));

				?>
				<table cellpadding=10 cellspacing=5 class="table_sujet">
				<tr>
					<td class="classred"><strong>AUTEUR DU POST</strong></td>
					<td class="classred"><strong>NOM FICHIER</strong></td>
				</tr>
				<tr></tr>
				<tr></tr>
				 <?php
				while ($donnees_fichier = $req_fichier->fetch())
				{
						$req_utilisateur = $bdd->prepare('SELECT * FROM utilisateur WHERE id_Util=?');
				        $req_utilisateur -> execute(array($donnees_fichier['id_Auteur_post']));
				        $donnees_utilisateur = $req_utilisateur -> fetch();
				        ?>
				        
					        <tr>
						        <td class="classblue"><a href="compte.php?pseudo=<?php echo $donnees_utilisateur['pseudo'];?>"><?php echo $donnees_utilisateur['pseudo'];?></a><?php if($donnees_utilisateur['statu']==1) echo "<p>Connecté(e)</p>"; else echo "<p>hors ligne(e)</p>"; ?></td>
						        <td><a href="<?php echo $donnees_fichier['adress']; ?>"><?php echo $donnees_fichier['libelle']?></a></td>
					        </tr>
				        
				<?php
				}
				?>
				</table>
				<?php	
			}
		}
		else
		{

		}
			?>
			</table>
		
	</div>

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>