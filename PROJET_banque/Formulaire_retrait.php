<?php
session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
		<title>
		retrait
		</title>
	</head>
	
	<body>
		<div id="contenu">
		
		<?php include("header.php");?>
		<center><div>
		<table border=1 >
		<TR><TD  bgcolor=white align=center><font color=black>
			
		<form method="post" action="traitement_retrait.php" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">FORMULAIRE DE RETRAIT
				</h1>
					<HR color="red" width="350px" size=5>
					
					<p>
					<strong><label for="number">Numerocpt :</label></strong>

					<input type="text" name="number" placeholder="Numero Compte"size=40 />
				</p>
					<p>
					<strong><label for="retire">Montant retiré</label></strong>
			
					<input type="text" name="retire" placeholder="Montant à Retirer"size=40 />
				</p>
					<p>
					<strong><label for="day">DateOperation</label></strong>
					<input type="date" name="day" /></p>
		<input type="submit" value="Valider" name="valide "class="inscrip"/>
		<input type="reset" value="Annuler"  name="annule "class="inscrip"/>
		</form>
		</TR></TD>
		</table>
		</div></center>
		<HR color="red" width="100%" size=7>
		<section>

		</section>

		
		<?php include("footer.php");?>
		</div>
	</body>
</html>