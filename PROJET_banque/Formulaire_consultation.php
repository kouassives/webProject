<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
		<title>
		consultation
		</title>
	</head>
	
	<body>
		<div id="contenu">
		
		<?php include("header.php");?>
		<center><div>
				<table border=1 >
		<TR><TD  bgcolor=white align=center><font color=black>
			
		<form method="post" action="traitement_consultation.php" enctype="multiple/form-data">
				
				<h1  align="center" style="color:green">CONSULTATION DE COMPTE
				</h1>
					<HR color="red" width="350px" size=5>
					
					<p>
					<strong><label for="compte">Numerocpt :</label></strong>

					
					<input type="text" name="compte" placeholder="Numero Compte" size=40 /></p>
				
		<input type="submit" value="consulter" name="consulte" class="inscrip"/>
				
		</TR></TD>
		</table>
			
		</div></center>
			<HR color="red" width="100%" size=7>

		
		<?php include("footer.php");?>
	</div>
	</body>
</html>