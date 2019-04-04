<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

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
if ( is_session_started() === FALSE ) session_start();

?>
<!-- MENU -->
	<nav id="menu">
	<h1 class="titre_dans_menu">MENU</h1>
		<ul class="ul_menu_repositionne">
			<li><a href="acceuil.php">ACCEUIL</a></li>
			<li><a href="fichieracceuil.php">fichiers</a></li>
			<li><a href="sujetsacceuil.php">Sujets</a></li>
			<li><a href="reglements.php">Règles du forum</a></li>
			<li><a href="livredor.php">Livre d'OR</a></li>
		</ul>
	<h1 class="titre_dans_menu">ESPACE MEMBRE</h1>
	<div>
			<!-- ON UTILISERA LE PHP ICI POUR LIRE DANS LA BASE DE DONNEES-->
			<!-- SERA AFFICHER LE CONNECTE-->
			<ul class="ul_menu_repositionne"><?php
			if ( !empty($_SESSION['pseudo']) )
			{
				echo '<li>connecté '.$_SESSION['pseudo'].'</li>';
				?>
				<li><a href="moncompte.php?pseudo=<?php echo $_SESSION['pseudo']?>">compte</a>, <a href="perso.php?pseudo=<?php echo $_SESSION['pseudo']?>">Perso</a></li>
				<li><a href="centremessages.php">Boite de Reception</a></li>
				<?php
			}
			else
			{
				echo "<li>Non connecté</li>";
			}
			?>
			<li>Total Visiteurs<?php include("compteur_visite.php") ?></li>
			<li><a href="membres.php">Tous les membres</a></li>
			</ul>
	</div>
	</nav>
