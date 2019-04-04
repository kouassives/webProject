<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=gestions_compte_banquaire','root', '',$pdo_options);

$nb= 10852;
$req = $bdd -> prepare('INSERT INTO clients(numero_client) VALUES(?);');
$req -> execute(array($nb));
?>