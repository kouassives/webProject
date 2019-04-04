<?php 
session_start();
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>FERMETURE</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>FERMETURE</li>			
			</div>		
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Fermeture</h3>
			<hr>
			
			<center>
		<div class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table>
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
			</form>

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
		
		</TR></TD>
		</table>
		</div >
		</center>


	
	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>