<?php
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}

if(isset($_POST['valide']))
{
	$compte=htmlspecialchars($_POST['compte']);
	/* RECUPERATION DE L'ID*/
	$requete = $bdd->prepare("SELECT * FROM clients,comptes WHERE comptes.numero_compte = ? AND comptes.numero_client=clients.numero_client");
	$requete->execute(array($compte));
	$repinfo = $requete -> fetch(); 
	$traiter=1;
	/*$compte=htmlspecialchars($_POST['compte']);
	$requete = $bdd->prepare("UPDATE comptes SET etat='cptfermer' WHERE numero_compte = ?");
	$requete->execute(array($compte));*/

}



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
		<title>
		fermeture
		</title>
	</head>
	
	<body>
		<div id="contenu">
		
		<?php include("header.php");?>
		<center>
		<div>
		
		<table border=1 >
		<TR><TD  bgcolor=white align=center><font color=black>
		<form method="post" action="" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">FORMULAIRE DE FERMETURE
				</h1>
				<HR color="red" width="350px" size=5/>
					<p>
					<strong><label for="compte">Numerocpt :</label></strong>

					<input type="text" name="compte" id="compte" placeholder="Numero Compte"size=40 />
				</p>
				
					
		<input type="submit" value="Valider" name="valide"class="inscrip"/>
		<input type="reset" value="Annuler"  name="annule "class="inscrip"/>
		</TR></TD>
		</table>
		</div>
		</center>
			<HR color="red" width="100%" size=7/>
		<?php 

		if (isset($_POST['CONFIRMER']))
		{
			$compte=htmlspecialchars($_POST['cpteconfir']);
			$requete = $bdd->prepare("UPDATE comptes SET etat='cptfermer' WHERE numero_compte = ?");
			$requete->execute(array($compte));
		?>
		<script type="text/javascript"> alert(Suppression effectuée)</script>

		<?php
		}

		if (isset($traiter) AND $traiter=1)
		{
		?>

	<div>
	<section style="width: 600px;margin: auto;font-size:20px">
		<pre>
		<b>
<h1><u><font color="green"> Infos propiretaire </font></u></h1>
<form method="POST" action="">


	<input type="image" border="0" name="img" src="<?php echo $repinfo['ID_image']; ?>" ;" style="float: right;width:140px;height:140px">

Nom:              <?php echo  $repinfo['nom_postulant'];?>

Numero CNI:       <?php echo  $repinfo['numero_cardteId'];?>

Numero de compte: <input type="text" name="cpteconfir" value="<?php echo $repinfo['numero_compte'];?>">

Solde:            <?php echo  $repinfo['somme_compte'];?>FCFA

Date d'ouverture  <?php echo $repinfo['date_Ouverture'];?>

Type de compte:   <?php echo $repinfo['type_compte'];?>

     <?php
     if($repinfo['etat']) 
     {
     	echo "Compte deja fermé";
     }
     else
     {
     	echo "compte ouvert";
     }?>
	 
<input type="submit" value="CONFIRMER" name="CONFIRMER">  <input type="reset" value="Annuler">
</form>
		<?php
		}

		?>
		
	
		</b>
		</pre>							
	</section>
	</div>
	<?php include("footer.php");?>
	</body>
</html>