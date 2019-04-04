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

/* REMBOURSEMENTS */
$reqremb = $bdd -> query('SELECT * FROM payements');
$nbremb = $reqremb -> rowCount();


$reqrembjj = $bdd -> prepare('SELECT * FROM payements WHERE Date_paye=?');
$reqrembjj -> execute(array($date));
$nbrembjj = $reqrembjj -> rowCount();


/* impayés */
$reqimp = $bdd -> query('SELECT * FROM payements WHERE somme_restant<>0');
$nbimp = $reqimp -> rowCount();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <?php include("header.php");?>
   <title>STAT REMBOURSEMENTS ET IMPAYES</title>
</head>
<body>
	<?php include('entete.php');?>
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="acceuil.php">Acceuil</a></li>
				<li>STAT REMBOURSEMENTS ET IMPAYES</li>			
			</div>
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Statistique Des Remboursements Et Des Impayés</h3>
			<hr>
		</div>
		<center>

		<div  class="col-md-0 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="600ms">
		<table class="tab_stat" border="1">

			<TR>
			<TD  bgcolor=white align=center><font color=black>Remboursements</font></TD>
			<TD bgcolor=white align=center><font color=black>Valeurs</font></TD>
			</TR>
			<TR>
			<TD  bgcolor=white align=center><font color=black>Nombre de Remboursement effectués</TD>
			<TD bgcolor=white align=center><font color=black><?php echo $nbremb;?></font></TD>
			</TR>
			<TR>
			<TD  bgcolor=white align=center><font color=black>Nombre de Remboursements effectués aujourdhui </TD>
			<TD bgcolor=white align=center><font color=black><?php echo $nbrembjj;?></font></TD>
			</TR>
			<TR>
			<TD colspan=2 bgcolor=white align=center><font color=black>rechercher un Remboursement? </font> <div>
				<form action="" method="post">
					<label for="rechremb" >Montant </label><input type="text" id="rechremb" name="rechremb"/> <input type="submit" name="validerremb" value="OK">
				</form>

			</div> </TD>
			</TR>

		</table>
		<table class="tab_stat" border="1">

			<TR>
			<TD  bgcolor=white align=center><font color=black>IMPAYES</TD>
			<TD bgcolor=white align=center><font color=black>Valeurs</TD>
			</TR>
			<TR>
			<TD  bgcolor=white align=center><font color=black>Nombre des Impayés</TD>
			<TD bgcolor=white align=center><font color=black><?php echo $nbimp;?>
			<form method="POST" action="">
			<input type="submit" value="Afficher" name="afficheimp">
			</form>
			</TD>
			</TR>
			
			<TR>
			<TD colspan=2 bgcolor=white align=center><font color=black>rechercher un Impayé? </font> <div>
				<form action="" method="post">
					<label for="rechpret" >Montant </label><input type="text" id="rechpret" name="rechpret"/> <input type="submit" name="validerpret" value="OK">
				</form>

			</div> </TD>
			</TR>

		</table>
		<?php 
		if (isset($_POST['validerremb'])) {

			$rechremb = htmlspecialchars($_POST['rechremb']);
			?>
			echo $rechremb
			<p>Remboursement de <?php echo $rechremb ?></p>
			<?php
			
			if (!empty($rechremb)) {
				
				$reqcherremb = $bdd -> prepare('SELECT * FROM payements WHERE Montant_paye=?');
				$reqcherremb -> execute(array($rechremb));
				$cpt=1;
				while ( $repcherremb = $reqcherremb-> fetch())
				{
					echo '<h2 style="color:black">'.$cpt.'</h2><h2 style="color:black"> libelle :&nbsp &nbsp</h2><h2 style="color:green">'.strtoupper($repcherremb['libelle']).'</h2>'.'<h2 style="color:green"> Numero de compte:&nbsp &nbsp'.$repcherremb['numero_compte'].'</h2>'.'<h2 style="color:green"> Date de Remboursement :&nbsp &nbsp'.$repcherremb['Date_paye'].'</h2>'.'<hr/ width=100% color=white size=3>';
				$cpt++;
				}
			}
		}
		
		if (isset($_POST['afficheimp'])) {
			$cpt=1;
				while ($repimp = $reqimp -> fetch()) {
					echo '<h2 style="color:black">'.$cpt.'</h2><h2 style="color:black"> libelle :&nbsp &nbsp</h2><h2 style="color:green">'.strtoupper($repimp['libelle']).'</h2>'.'<h2 style="color:green"> Numero de compte:&nbsp &nbsp'.$repimp['numero_compte'].'</h2>'.'<h2 style="color:green"> Montant Payé:&nbsp &nbsp'.$repimp['Montant_paye'].'</h2>'.'<h2 style="color:green"> Somme Restante :&nbsp &nbsp'.$repimp['somme_restant'].'</h2>'.'<hr/ width=100% color=white size=3>';
				$cpt++;
									
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