<?php 
		if (isset($_POST['forminscription']))
		{
			if ( !empty($POST['nom']) and !empty($POST['pseudo']) and !empty($POST['mpd']) and !empty($POST['email']) )
			{
				echo 'ok';
			}
			else
			{
				echo 'erreur';
			}
		}
	?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta charset="utf-8">
	<title>INSCRIPTION</title>
	<link rel="stylesheet" type="text/css" href="1.css">
</head>
<body>
<div id="block_page">

	<!-- ENTETE-->
	<?php include("entete.php"); ?>
	<!-- PANNEL DE RECHERCHE -->
	<?php include("pannel_rechercher.php"); ?>
	<!-- MENU -->
	<?php include("menu.php"); ?>

	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<section>
		<FORM  ACTION=""  METHOD="POST">
		<div>
		<pre>
		<b>
		<h2>INSCRIPTION</h2>
		<label for="nom">NOM:</label>    <input type="text" name="nom" id="nom" size=15>	<label for="prenoms">PRENOM:</label><input type="text" name="prenoms" id="prenoms" size=20>

		<label for="pseudo">PSEUDO:</label> <input type="text" name="pseudo" id="pseudo" size=30>

		<label for="mpd">MOT DE PASSE: <input type="password" name="mdp" id="mpd" size=20></label> <label for="niveau">	 NIVEAU: <select name ="niveau" > 
		       <option  value ="" > </option>
		       <option  value ="licence" > LICENCE </option>
		       <option  value ="licence" > BTS </option>
		       <option  value ="licence" > MATSTER </option>
		       <option  value ="bts"> DOCTORAT </option></select></label>
		
		<label for="mail">EMAIL:	<input type="email" name="mail" size=30></label>

		<label for="sexe">SEXE:</label> M<input   type="radio" name="sexe" value="masculin" checked > <label for="sexe">SEXE:</label> F</label><input   type="radio" name="sexe" value="feminin" >

		<p style="display: inline-block;vertical-align: top"><label for="nom_du_champ"style="display: inline-block;vertical-align: top">BIOGRAPHIE</label><TEXTAREA name="nom_du_champ?" rows=5 cols=15 style="display: inline-block;vertical-align: top"></TEXTAREA></p>		<p style="display: inline-block;vertical-align: top;"><label for="preference">PREFERENCES</label>
     <input type="checkbox" name="chk1" value="TELECOMMUNICATION" >RESEAUX
     <input type="checkbox" name="chk2" value="DEVELOPPEMENT" >TELECOMMUNICATION
     <input type="checkbox" name="chk3" value="DEVELOPPEMENT" >DEVELOPPEMENT
     <input type="checkbox" name="chk4" value="DEVELOPPEMENT" >SCIENCE INFORMATIQUE
     <input type="checkbox" name="chk5" value="DEVELOPPEMENT" >BASE DE DONNEES

		</p>

		<input type="submit" name="forminscription" value="Enregistrer">  <input type="reset" value="Annuler">
		</b>							
		</pre>
		</form>
	</section>
	

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>