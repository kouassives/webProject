	<!-- PANNEL DE RECHERCHE -->
	<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

if (isset($_POST['btrech']) )
{
	$rech = htmlspecialchars($_POST['rech']);
	header('Location: rechercher.php?rech='.$rech);
}
?>

	<div id="rech">
		<form ACTION=""  METHOD="POST">
		<input type="submit" name="btrech" value="RECHERCHER"> <input type="text" name="rech" size="15" />
		</form>
		<a href="index.php"><img src="images/ordinateur-bureau-pc-icone-7808-128.png" alt="Logo du site" width="95px"></a>
	</div>
