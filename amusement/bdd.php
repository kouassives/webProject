<!-- LECTURE DANS LA BASE-->

<?php
try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new pdo('mysql:host=localhost;dbname=combio','root', '',$pdo_options);
	$reponse=$bdd->query('SELECT * FROM clients');
	$donnees = $reponse->fetch();
		echo '<p></p>';
		echo '<pre><p>NOM:'.$donnees['nom'].'</pre></p>';	
	
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>