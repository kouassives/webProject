<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
		<title>
		credits
		</title>
	</head>
	
	<body>
		<div id="contenu">
		
		<?php include("header.php");?>
		<center><div>
		
		<table border=1 >
		<TR><TD  bgcolor=white align=center><font color=black>
		<form method="post" action="traitement_payement.php" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">FORMULAIRE DE PAYEMENTS DE CERDITS
				</h1>
				<HR color="red" width="350px" size=5>
					<p>
					<strong><label for="numero">Numerocpt :</label></strong>
						</br></br>
					<input type="text" name="numero" placeholder="Votre Numero compte" size=40 />
				</p>
					<p>
					<strong><label for="Mverse">Montant Versé :</label></strong>
						</br></br>
					<input type="text" name="Mverse" placeholder="Montant Versé"size=40 />
				</p>
						<p>
							<strong><label for="libele">Libelle Garantie</label></strong></br>
							<textarea name="libele" id="publ" rows="4"placeholder="votre libellé ici"
							cols="20"></textarea>
						</p>
				<p>
					<strong><label for="dater">DatePayement  :</label></strong>
					</br></br>
					<input type="date" name="dater" /></p>
		<input type="submit" value="Valider" name="accorde "class="inscrip"/>
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