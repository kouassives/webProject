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
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navigation">
				<div class="container">					
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="navbar-brand">
							<a href="acceuil.php"><img src="images/logobank.png" alt="Logo de la banque" /></a>
						</div>
					</div>
					
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul id="menu">
								<li><strong><a href="acceuil.php">Acceuil</a></strong></li>
								<li>
										<strong><a href="#">Compte</a></strong>
										<ul>
												<strong><li><a href="inscription.php">Inscription</a></li></strong>
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
												<strong><li><a href="listes_emprunteurs.php">Listes Emprunteurs</a></li></strong>
										</ul>
								</li>
								<li>
								<strong><a href="#">Statistiques</a></strong>
											<ul>
												<strong><li><a href="stat_depot_pret.php">Dépôt/Prêt</a></li></strong>
												<strong><li><a href="stat_remb_impaye.php">Remboursement/Impayé</a></li></strong>
										</ul>
								</li>
								<strong><li><a href="aide.php">Aide</a></li></strong>
								<strong><li><a href="apropos.php">A propos</a></li></strong>
								<?php 
								if(!empty($_SESSION['iduti']))
								{
								?>
								<li><strong><a href=""><img src="images/AAR.png" style="width: 36px;height: 36px;display: inline-block;vertical-align: middle;border: 2px solid white; border-radius: 30px 30px 30px 30px;"><span id="lieni" style="background-color: #499300;color: white;padding: 6px 10px 6px 10px; 
  border-radius: 10px;" ><?php echo $rep1['User'];?></span></a></strong>
  										<ul>
  										<strong><li><a href="index.php">Déconnexion</a></li></strong>
  										</ul>
  								</li>
  								<?php
  								}
  								?>
								
						</ul>
						</div>
					</div>						
				</div>
			</div>	
		</nav>		
	</header>