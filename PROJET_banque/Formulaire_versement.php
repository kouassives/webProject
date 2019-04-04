<?php
session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
		<title>
		versement
		</title>
	</head>
	
	<body>
		<div id="contenu">
		
		<?php include("header.php");?>


		<center><div>
		<table border=1 >
		<TR><TD  bgcolor=white align=center><font color=black>
			
		<form method="post" action="traitement_versement.php"enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">VERSEMENT
				</h1>
					<HR color="red" width="350px" size=5>
					<p>
					<strong><label for="deposant">Nom déposant :</label></strong>
			
					<input type="text" name="deposant" placeholder="Nom du Deposant"id="deposant" size=40 />
				</p>
					<p>
					<strong><label for="cpt">Numerocpt :</label></strong>

					<input type="text" name="cpt" placeholder="Numero Compte"size=40 />
				</p>
					<p>
					<strong><label for="versement">Montant versé</label></strong>
			
					<input type="text" name="versement" placeholder="Somme Versée"size=40 />
				</p>
				<p>
					<strong><label for="year">DateOperation</label></strong>
					<input type="date" name="year" /></p>
				
		<input type="submit" value="VALIDER" name="VALIDER "class="inscrip"/>
		<input type="reset" value="Annuler"  name="annule "class="inscrip"/>
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