<?php
// 1 : on ouvre le fichier
$monfichier = fopen('fichier.php', 'w');
 
// 2 : on lit la première ligne du fichier
fputs($monfichier, '<nav id="menu">
	<h1>MENU</h1>
		<ul>
			<li><a href="">RESEAU</a></li>
			<li><a href="">TELECOMMUNICATION</a></li>
			<li><a href="">DEVELOPPEMENT</a></li>
			<li><a href="">SCIENCE INFORMATIQUE</a></li>
			<li><a href="">BASE DE DONNEES</a></li>
		</ul>
	<h1>ESPACE MEMBRE</h1>
	<div>
		<!-- ON UTILISERA LE PHP ICI POUR LIRE DANS LA BASE DE DONNEES-->
		<!-- SERA AFFICHER LE CONNECTE-->

	</div>
	</nav>');
?>
<?php
header('Location: fichier.php')
?>
