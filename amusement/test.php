<?php 
	if (isset($_FILES['file']))
	{
			$name_file=$_FILES['file']['name'];
			$tmp_name=$_FILES['file']['tmp_name'];
			$local_image = "images/";     
			move_uploaded_file($tmp_name,$local_image.$name_file);
	}
	else
	{
		echo "nn";
	}
?>

</body>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css.php" media="all">
</head>
<body>

<form ACTION=""  METHOD="POST" enctype="multipart/form-data">
				<table cellspacing="10">
				<caption><h2>INSCRIPTION</h2></caption>
					<tr>
						<td ALIGN=right><label for="nom">NOM:</label></td>
						<td><input type="text" placeholder="votre nom" name="nom" id="nom" value="<?php if(isset($nom)) {echo $nom;} ?>" ></td>
					<tr>
						<td ALIGN=right><label for="prenoms">PRENOM:</label></td>
						<td><input type="text" placeholder="vos prenoms" name="prenoms" id="prenoms" value="<?php if(isset($prenoms)) {echo $prenoms;} ?>"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="pseudo">PSEUDO:</label></td>
						<td><input type="text" placeholder="votre pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>" ></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="mpd">MOT DE PASSE:</label></td>
						<td><input  type="password" placeholder="votre mot de passe" name="mdp" id="mpd"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="mpd2">CONFIRMATION MOT DE PASSE:</label></td>
						<td><input  type="password" placeholder="confirmer le mot de passe" name="mdp2" id="mpd2"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="email">EMAIL:</label></td>
						<td><input  type="email" placeholder="votre email" name="email" id="email" value="<?php if(isset($email)) {echo $email;} ?>"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="email2">CONFIRMATION EMAIL:</label></td>
						<td><input  type="email" placeholder="confirmer votre email" name="email2" id="email2" value="<?php if(isset($email2)) {echo $email2;} ?>"></td>
					</tr>
					<tr>
						<td ALIGN=right><label for="sexe">SEXE:</label></td>
						<td>M<input type="radio" name="sexe" value="masculin" checked> F<input   type="radio" name="sexe" value="feminin" ></td>
					</tr>
					<tr>
						<td VALIGN=top ALIGN=right><label for="biographie">BIOGRAPHIE:</label></td>
						<td><TEXTAREA placeholder="votre biographie"  rows=5 cols=15 name="biographie" id="biographie" ><?php if(isset($biographie)) {echo $biographie;} ?></TEXTAREA></td>
					</tr>
					<tr>
						<td VALIGN=top ALIGN=right rowspan=5><label for="preference">PREFERENCES</label></td>
					    <td><input type="checkbox" name="chck1" value="RESEAU" checked>RESEAU</td>
					</tr>
					<tr>
					    <td><input type="checkbox" name="chck2" value="TELECOMMUNICATION" >TELECOMMUNICATION</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="chck3" value="DEVELOPPEMENT" >DEVELOPPEMEN</td>
					</tr>
						<td><input type="checkbox" name="chck4" value="SCIENCE INFORMATIQUE" >SCIENCE INFORMATIQUE</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="chck5" value="BASE DE DONNEES" >BASE DE DONNEES</td>
					</tr>
					<tr>
						<td colspan=1><input type="hidden" name="MAX_FILE_SIZE" value="2097152"></td><td><input type="file" name="file"></td>
					</tr>
					<tr>
						<td ALIGN=right ><input type="submit" name="forminscription" value="Enregistrer"></td> <td><input type="reset" value="Annuler"></td>
					</tr>
				</table>
				
				</form>
				
</html>