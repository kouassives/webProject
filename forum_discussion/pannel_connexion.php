<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

/**FONCION UNIVERSELLE POUR VERIFIER LE STATUS DE LA SESSION
* @return bool
*/
function is_session_started2()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

// Example
if ( is_session_started2() === FALSE )
	{
		session_start(); 
	}
	
if (isset($_POST['formconnexion']) )
{
	$pseu = htmlspecialchars($_POST['pseu']);
	$mdp = sha1($_POST['mdpco']);
	if (!empty($_POST['pseu']) AND !empty($_POST['mdpco']) )
	{		
		$reqspeudo = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo=?");
		$reqspeudo -> execute(array($pseu));
		$pseudoexist = $reqspeudo->rowCount();
		if ($pseudoexist > 0)
		{
			#Le pseudo existe, donc  on va vérifier s'il a entré un bon mot de passe
			$donnes=$reqspeudo->fetch();
			#on a maintenant le bon mot de passe dans la varaible ;
			if ($mdp == $donnes['mdp'])
			{
				#CREEONS LES VARAIABLES SESSION pseudo et id pour l'uitilisateur connecté 
				$_SESSION['pseudo']=$pseu;
				$_SESSION['id']=$donnes['id_Util'];
				
				$req_pour_statu = $bdd->prepare("UPDATE utilisateur set statu=1 WHERE id_Util=?");
				$req_pour_statu -> execute(array($donnes['id_Util']));
				
				header('Location: acceuil.php');
			}
			else
			{
				$erreur='<font color="red">Mot de passe érroné !</font>';
			}
		}
		else
		{
			$erreur='<font color="red">Ce pseudo n\'existe pas !</font>';	
		}
	}
	else
	{
		$erreur='<font color="red">Veulliez à bien remplir les deux champs !</font>';
	}
}

?>

<section>
	<form action="" method="POST">
	<b>
	<label>PSEUDO :<input type="text" name="pseu" size=10 value="<?php if(isset($pseu)) {echo $pseu;} ?>"></label>
	<label>MOT DE PASSE :<input type="password" name="mdpco" size=10 ></label>
	<label><input type="submit" name="formconnexion" value="Connexion"></label>
	</b>
	</form>
	<center>
	<p><?php
		if (isset($erreur))
		{
			echo $erreur;
		}
	?><p>
	</center>
</section>