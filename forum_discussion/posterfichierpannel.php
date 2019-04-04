<?php
	if(empty($_SESSION['pseudo']))
	{
		echo '<p style="color: red"><a href="connexion.php">Connectez</a> vous avant de poster un fichier !</p>';
	}
	?>

	<!-- Ce div sera pas afficher quand l'utilisateur n'est pas connecté et cela est geré avec notre fichier css.php-->
	<div align="center" class="btpostercacher">
	
	<?php
	if (isset($_POST['btuploadfile']))
	{
		if (!empty($_POST['titre']))
		{
			if (!empty($_POST['categorie']))
			{
				$titre=htmlspecialchars($_POST['titre']);
				# code...
				if (isset($_FILES['file']) AND !empty($_FILES['file']['name']))
				{
					$pseudo=$_SESSION['pseudo'];
					$categorie=$_POST['categorie'];
					$name_file=$_FILES['file']['name'];
					$tmp_name=$_FILES['file']['tmp_name'];
					$local_image = "fichiers/";     
					move_uploaded_file($tmp_name,$local_image.$pseudo.$name_file);
					#on recupere id de lutilisateur avec $pseudo
					$req_iduti = $bdd -> prepare('SELECT id_Util FROM utilisateur WHERE pseudo=?');
					$req_iduti -> execute(array($pseudo));
					$donnees_iduti = $req_iduti -> fetch();
					#on recupere l'id de la categorie
					$req_idcat = $bdd -> prepare('SELECT id_Cat FROM categorie WHERE libelle=?');
					$req_idcat -> execute(array($categorie));
					$donnees_cat = $req_idcat -> fetch();

					#on recupere lheure
					$date = date("Y-m-d");
					$heure = date("H:i:s");
					$dh=$date.' '.$heure;
					$temps = new DateTime($dh);
					$dateheure = $temps->format('Y-m-d H:i:s');

					#Enregostrement dans la table fichiers
					$req_insert_fichier= $bdd -> prepare('INSERT INTO fichier(libelle,datepost,adress,id_Cat,id_Auteur_post) VALUES(?,?,?,?,?) ');
					$ans_fichier = $req_insert_fichier -> execute(array($titre,$dateheure,$local_image.$pseudo.$name_file,$donnees_cat['id_Cat'],$donnees_iduti['id_Util']));
				}
				else
				{
					$erreur='<font color="red">Vous n\'avez chargé aucun fichier !</font>';
				}
			}
			else
			{
				$erreur='<font color="red">Vous n\'avez pas selectionné de Categorie !</font>';
			}
		}
		else
		{
			$erreur='<font color="red">Veulliez à bien remplir tous les champs !</font>';
		}
	}
	?>
	
	<form method="POST" action="" enctype="multipart/form-data" style="text-align: center " >
	<label for="titre">POSTER</label><input type="text" name="titre" id="titre" placeholder="Donnez un titre au ficher" />

	<select name ="categorie" >
       <option  value ="RESEAU">RESEAU</option>
       <option  value ="TELECOMMUNICATION" >TELECOMMUNICATION</option>
       <option  value ="DEVELOPPEMENT">DEVELOPPEMENT</option> 
       <option  value ="SCIENCE INFORMATIQUE">SCIENCE INFORMATIQUE</option> 
       <option  value ="BASE DE DONNEES">BASE DE DONNEES</option>        
	</select>
	<input type="hidden" name="MAX_FILE_SIZE" value="2097152"/><input type="file" name="file"/>
	<input type="submit" name="btuploadfile"/>
	</form>
	<?php
		if(isset($erreur))
		{
			echo $erreur;
		}
	?>
	</div>