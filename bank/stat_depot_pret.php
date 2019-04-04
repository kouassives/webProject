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

$date = date("Y-m-d");

/* DEPOTS */
$reqdep = $bdd -> query('SELECT * FROM versements');
$nbdep = $reqdep -> rowCount();


$reqdepjj = $bdd -> prepare('SELECT * FROM versements WHERE date_verssement=?');
$reqdepjj -> execute(array($date));
$nbdepjj = $reqdepjj -> rowCount();


/* PRETS */
$reqpret = $bdd -> query('SELECT * FROM credits');
$nbpret = $reqpret -> rowCount();

$reqpretjj = $bdd -> prepare('SELECT * FROM credits WHERE date_valeur=?');
$reqpretjj -> execute(array($date));
$nbpretjj = $reqpretjj -> rowCount();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>STAT DEPOTS ET PRETS</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>STAT DEPOTS ET PRET</li>			
			</div>
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Statistique Des Depots et Prêt</h3>
			<hr>
		</div>
		<center>

		<div  class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table class="tab_stat" border="1">

			<TR>
			<TD  bgcolor=white align=center><font color=black>DEPOTS</font></TD>
			<TD bgcolor=white align=center><font color=black>Valeurs</font></TD>
			</TR>
			<TR>
			<TD  bgcolor=white align=center><font color=black>Nombre de Depots effectués</TD>
			<TD bgcolor=white align=center><font color=black><?php echo $nbdep;?></font></TD>
			</TR>
			<TR>
			<TD  bgcolor=white align=center><font color=black>Nombre de Depots effectués aujourdhui </TD>
			<TD bgcolor=white align=center><font color=black><?php echo $nbdepjj;?></font></TD>
			</TR>
			<TR>
			<TD colspan=2 bgcolor=white align=center><font color=black>rechercher un dépot? </font> <div>
				<form action="" method="post">
					<label for="rechdep" >Montant </label><input type="text" id="rechdep" name="rechdep"/> <input type="submit" name="validerdep" value="OK">
				</form>

			</div> </TD>
			</TR>

		</table>
		<table class="tab_stat" border="1">

			<TR>
			<TD  bgcolor=white align=center><font color=black>PRETS</TD>
			<TD bgcolor=white align=center><font color=black>Valeurs</TD>
			</TR>
			<TR>
			<TD  bgcolor=white align=center><font color=black>Nombre de Prêts effectués</TD>
			<TD bgcolor=white align=center><font color=black><?php echo $nbpret;?></TD>
			</TR>
			<TR>
			<TD  bgcolor=white align=center><font color=black>Nombre de Prêts effectués aujourdhui </TD>
			<TD bgcolor=white align=center><font color=black><?php echo $nbpretjj;?></TD>
			</TR>
			<TR>
			<TD colspan=2 bgcolor=white align=center><font color=black>rechercher un Prêt? </font> <div>
				<form action="" method="post">
					<label for="rechpret" >Montant </label><input type="text" id="rechpret" name="rechpret"/> <input type="submit" name="validerpret" value="OK">
				</form>

			</div> </TD>
			</TR>

		</table>
		<?php 
		if (isset($_POST['validerdep'])) {

			$rechdep = htmlspecialchars($_POST['rechdep']);
			?>
			<p>Dépots de <?php echo $rechdep ?></p>
			<?php
			
			if (!empty($rechdep)) {
				
				$reqcherdep = $bdd -> prepare('SELECT * FROM versements WHERE montant_verser=?');
				$reqcherdep -> execute(array($rechdep));
				$cpt=1;
				while ( $repcherdep = $reqcherdep-> fetch())
				{
					echo '<h2 style="color:black">'.$cpt.'</h2><h2 style="color:green"> Nom du deposant:&nbsp &nbsp'.strtoupper($repcherdep['nom_deposant']).'</h2>'.'<h2 style="color:green"> Numero de compte:&nbsp &nbsp'.$repcherdep['numero_compte'].'</h2>'.'<h2 style="color:green"> Date de versements:&nbsp &nbsp'.$repcherdep['date_verssement'].'</h2>'.'<hr/ width=100% color=white size=3>';
				$cpt++;
				}
			}
		}
		
		if (isset($_POST['validerpret'])) {

			$rechpret = htmlspecialchars($_POST['rechpret']);
			?>
			<p>Prêts de <?php echo $rechpret ?></p>
			<?php
			
			if (!empty($rechpret)) {
				$reqcherpret = $bdd -> prepare('SELECT * FROM credits WHERE montant_octroye=?');
				$reqcherpret -> execute(array($rechpret));
				$cpt=1;
				while ( $repcherpret = $reqcherpret-> fetch())
				{
					echo '<h2 style="color:black">'.$cpt.'<h2 style="color:green">'.strtoupper($repcherpret['nom_deposant']).'</h2>'.'<h2 style="color:green"> Numero de compte:&nbsp &nbsp'.$repcherpret['numero_compte'].'</h2>'.'<h2 style="color:black"> Libellé de Garantie:&nbsp &nbsp <h2 style="color:green">'.$repcherpret['libelle_garantie'].'</h2>'.'<h2 style="color:green"> Valeur de lagarantie :&nbsp &nbsp'.$repcherpret['valeur_garantie'].'</h2>'.'<hr/ width=100% color=white size=3>';
				$cpt++;
				}
			}
		}
		?>
		</div>
		</center>

		
	<?php include("footer.php");?>
	<?php include("javas.php");?>
	
  </body>
</html>