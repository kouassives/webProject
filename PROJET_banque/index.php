<?php

/* Deconnexion des utilisateurs*/

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
if(isset($_POST['connecter']))
{


	$utilisateur=htmlspecialchars($_POST['utilisateur']);

	$motdepass=sha1($_POST['motdepass']);
	$niveau=htmlspecialchars($_POST['niveau']);

	if(!empty($utilisateur) AND !empty($motdepass) AND !empty($niveau))
	{

			$req1 = $bdd->prepare("SELECT * FROM connection WHERE User= ? AND mdp=? ");
			$req1 -> execute(array($utilisateur,$motdepass));
			$rep1 = $req1 -> fetch();
			$valide= $req1 -> rowCount();
			if($valide)
			{
				$_SESSION['iduti']=$rep1['IDUser'];
				header("location:acceuil.php");
			}
			else
			{
				
			$message='<em style="color:red">Une erreur s\'est produite</em>';
			$message='<em style="color:red"> L\'un des champs est incorrect!</em>';
			} 
			
	}
	else
	{
		$message='<strong style="color:green font-size:1.5em"> Tous les champs doivent etre complètés!</strong>';
		
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
        <title>connection</title>
    </head>
    <body id="corps">
	<center><div class="connec">


		
			<form method="post" action="">
			<img src="AAR.png" width="100px" height="100px"/>
			<p>
				<strong><label for="utilisateur" style="margin-lef:150px" class="utilisater">utilisateur</label></strong> 
				<input type="text" name="utilisateur" placeholder="utilisateur" class="utilisateur"/>
			</p><br/>
			
		<p>
				<strong><label for="motdepass" style="margin-lef:150px"class="motdepas">mot de passe</label></strong>
				<input type="password" name="motdepass" placeholder="entrer pass" class="motdepasss"/>
				
			</p>
			<p>
					<strong><label for="niveau" class="Niveau1">niveau de privilège</label></strong>
						<select name="niveau" id="niveau">
							<option value="Niveau 1">Niveau 1</option>
							<option value="Niveau 2">Niveau 2</option>
							<option value="Niveau 3">Niveau 3</option>
							<option value="Niveau 4">Niveau 4</option>
							<option value="Niveau 5">Niveau 5</option>
						</select>
				</p>
			<p>
			<input type="submit" name="connecter" value="Se connecte" class="connect"/>
			<input type="reset" name="annuler"   class="annule"/>
			</p>
			<a href="#"><em style="color:white">mot de passse oublier</em></a><br/>
				<?php if(isset($message))
		{

			 echo "$message";
		}
			 ?>
			</form>
		
		</div></center>
	
    </body>
</html>