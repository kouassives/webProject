<?php 
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
#Fonction universel pour verifier si une session a demaré
/**
* @return bool
*/
function is_session_started()
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
if ( is_session_started() === FALSE )
	{
		session_start();
	}
	$req1 = $bdd->prepare("SELECT * FROM connection WHERE IDUser=?");
	$req1 -> execute(array($_SESSION['iduti']));
	$rep1 = $req1->fetch();
?>

<header>
		<img src="123.jpg" width="1340px" height="100px"/>				
						<ul id="menu">
								<li><strong><a href="acceuil.php">Acceuil</a></strong></li>
								<li>
										<strong><a href="#">Compte</a></strong>
										<ul>
												<strong><li><a href="formulaire_inscription.php">Inscription</a></li></strong>
												<strong><li><a href="creation_de_compte.php">Ouverture</a></li></strong>
												<strong><li><a href="Formulaire_versement.php">Versement</a></li></strong>
												<strong><li><a href="Formulaire_retrait.php">Retrait</a></li></strong>
												<strong><li><a href="Formulaire_consultation.php">Consultaion</a></li></strong>
												<strong><li><a href="Formulaire_fermeture.php">Fermeture</a></li></strong>
										</ul>
								</li>
												<li>
								<strong><a href="#">Prêts</a></strong>
									<ul>
												<strong><li><a href="Formulaire_credit.php">Credits</a></li></strong>
												<strong><li><a href="Formulaire_payement.php">Payements Credits</a></li></strong>
										</ul>
								</li>
								<li>
								<strong><a href="Formulaire_client.php">Clients</a></strong>
											<ul>
												
												<strong><li><a href="formulaire_clientt.php">Recherche Clients</a></li></strong>
												<strong><li><a href="creation_de_compte.php">Listes Impayés</a></li></strong>
												<strong><li><a href="listes_emprunteurs.php">Listes Emprunteurs</a></li></strong>
										</ul>
								</li>
								<li>
								<strong><a href="#">Statistiques</a></strong>
											<ul>
												<strong><li><a href="depot_pret.php">Dépôt/Prêt</a></li></strong>
												<strong><li><a href="creation_de_compte.php">Remboursement/Impayé</a></li></strong>
												<strong><li><a href="Formulaire_versement.php">Compte débitaire/Compte Fourni</a></li></strong>
										</ul>
								</li>
								<strong><li><a href="#">Aide</a></li></strong>
								<strong><li><a href="#">A propos</a></li></strong>
								<strong><li><a href="Formulaire_client1.php">.</a></li></strong>
								<strong><li><a href="#">  <?php echo 'Connecté '.$rep1['User'] ;?> </a></li></strong>
								
								
						</ul>
</header>