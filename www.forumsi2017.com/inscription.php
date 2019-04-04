<?php
session_start();
if (isset($_FILES['image']) and ($_FILES['image']['error']== 0) and isset($_POST['nom']) and isset($_POST['Prenoms']) and isset($_POST['email']) and isset($_POST['motpasse']))
{
	echo "string";

$infosfichier =pathinfo($_FILES['image']['name']);
$extension_upload = $infosfichier['extension'];
$extensions_autorisees = array('jpg', 'jpeg', 'gif','png');
if (in_array($extension_upload,$extensions_autorisees))
{
	if (!empty($_POST['nom']) and !empty($_POST['Prenoms']) and !empty($_POST['motpasse']))
{
	try
	{
		$chemin='image/' .basename($_FILES['image']['name']);
		move_uploaded_file($_FILES['image']['tmp_name'], 'image/' .basename($_FILES['image']['name']));
		$base=new PDO('mysql:host=localhost;dbname=baseforum','root','');
		$req=$base->prepare('insert into membres (nom,prenom,email,motpasse,id_image) values(?,?,?,?,?)');
		$req->execute(array($_POST['nom'],$_POST['Prenoms'],$_POST['email'],$_POST['motpasse'],$chemin));
		header("location:index.php");


	}catch(Exception $e)
	{
		die('erreur: '.$e->getmessage());
	}
}else echo "VEUILLEZ REMPLIR TOUS LES CHAMPS";

}else echo "VEUILLEZ CHOISIR UN BON FORMAT DE FICHIER IMAGE";	
	
}else
{
	
}

?>
<!DOCTYPE html>
<html>
<head>

	<title> Mon forum</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
	<header>
		<?php include("menudeconec.php");?>
		<p>
			<em id="repe" style="color: white;">
			<?php echo '<a href="index.php" style="color: white;">Accueil</a> --> Inscription';?>
			</em>
		</p>
		<p id="tab" >
			<em id="tb">Inscription</em>
		</p>	
	</header>
	<section>
		<center>
		<?php if  (isset($_POST['envoyer'])) {
			if (empty($_POST['nom']) or empty($_POST['prenoms'])  or empty($_POST['email']) or empty($_POST['motpasse'])) {
				# code...
				echo "VEULLEZ REMPLIR TOUS LES CHAMPS CORRECTEMENT";
			}
			# code...
		}
		?>
		<br/>
		<br/>
		<form id="formconec" method="post" action="inscription.php" enctype="multipart/form-data">
		
			<div style="display: inline-block;vertical-align: middle;">
			<a id="fbconec" href=""><img src="" style="width: 15px; height: 15px;display: inline-block;vertical-align: middle;"> <span  style="display: inline-block; vertical-align: middle;">S'inscrire avec Facebook</span></a><br/><br/><br/><br/>
			<a id="gconec" href=""><img src="" style="width: 15px; height: 15px;display: inline-block;vertical-align: middle;"> <span  style="display: inline-block; vertical-align: middle;">S'inscrire avec Google   </span></a>
			</div>
			<div class="divc" style="display: inline-block; vertical-align: middle;">
				<label for="nom">Nom</label><br>
				<input  type="text" class="champ" name="nom"><br>
				<label for="Prenoms">Prenoms</label><br>
				<input class="champ" type="text" name="Prenoms"><br>
				<label for="Prenoms">Adresse email</label><br>
				<input class="champ" type="text" name="email"><br>
				<label  for="motpasse">Mot de passe</label><br>
				<input  class="champ" type="password" name="motpasse" ><br>
			</div>

			<fieldset style="display: inline-block; vertical-align: top; margin-left: 50px; height: 170px;">
			<legend><input type="file" name="image" accept="image/*" onchange="loadFile(event)" style="width: 140px;"></legend>
				<img id="output" style="width: 160px;height: 150px;" />
				<script>
				  var loadFile = function(event) {
				    var output = document.getElementById('output');
				    output.src = URL.createObjectURL(event.target.files[0]);
				  };
				</script>
			</fieldset>
			<br>
			<br>
			<input type="checkbox" name="daccord"> J'ai lu et j'accepte les <a  href="">conditions générales d'utilisation</a><br>
			<input id="btenvoie" type="submit" name="envoyer" value="S'inscrire"><br><br>
			
		</form>
		
		</center>
		<br><br><br>
	</section>
	<footer>
		<?php include("pied_de_page.php");?>
	</footer>

</body>
</html>