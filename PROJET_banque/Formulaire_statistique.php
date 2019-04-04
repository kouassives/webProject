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
		
		<?php include("header.php");?>
		<center><div>
		
		<table border=1 >
		<TR><TD  bgcolor=white align=center><font color=black>
		<form method="post" action="credit_compte.php" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">FORMULAIRE DE CREDIT
				</h1>
				<HR color="red" width="350px" size=5>
					<p>
					<strong><label for="number">Numerocpt :</label></strong>
						</br></br>
					<input type="text" name="number" placeholder="Votre Numero CNI" size=40 />
				</p>
					<p>
					<strong><label for="octroye">Montant octroyé :</label></strong>
						</br></br>
					<input type="text" name="octroye" placeholder="Montant Octroyé"size=40 />
				</p>
				<p>
					<strong><label for="raison">Raison-Social :</label></strong>
						</br></br>
					<input type="text" name="raison"  placeholder="Raison social"size=40 /></P>
					<p>
							<strong><label for="libelle">Libelle Garantie</label></strong></br>
							<textarea name="libelle" id="publ" rows="4"placeholder="votre libellé ici"
							cols="20"></textarea>
						</p>
						<p>
					<strong><label for="valeur">Valeur Garantie :</label></strong>
						</br></br>
					<input type="text" name="valeur" placeholder="Valeur Garantie"size=40 /></P>
				<p>
					<strong><label for="dater">DateValeur  :</label></strong>
					</br></br>
					<input type="date" name="dater" /></p>
						<p>
					<strong><label for="echeance">DateEchance :</label></strong>
					</br></br>
					<input type="date" name="echeance" /></p></br>
		<input type="submit" value="Valider" name="accorde "class="inscrip"/>
		</TR></TD>
		</table>
		</div></center>
			<HR color="red" width="100%" size=7>
		<section>

		</section>

		<?php include("footer.php");?>
	</body>
</html>