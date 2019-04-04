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
	$message='';
if(isset($_Post['connecter']))
{

	$utilisateur=htmlspecialchars($_POST['utilisateur']);
	$motdepass=sha1($_POST['motdepass']);
	$niveau=htmlspecialchars($_POST['niveau']);
	if(!empty($utilisateur) AND !empty($motdepass))
	{

	}
	else
	{
		$message='<strong style="color:green font-size:1.5em"> Tous les champs doivent etre complètés!</strong>';
		
	}
}
?>