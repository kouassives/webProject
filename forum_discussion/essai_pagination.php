<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
   <head>
       <title>Livre d'or</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 
        <style type="text/css">
        form, .pages
        {
            text-align:center;
        }
        </style>
    </head>
    <body>
 
    <form method="post" action="essai_pagination.php">
        <p>Mon site vous plaît ? Laissez-moi un message !</p>
        <p>
            Pseudo : <input name="pseudo" /><br />
            Message :<br />
            <textarea name="message" rows="8" cols="35"></textarea><br />
            <input type="submit" value="Envoyer" />
        </p>
    </form>
 
    <p class="pages">
 
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=127.0.0.1;dbname=forum1','root', '',$pdo_options);
 
// --------------- Étape 1 -----------------
// Si un message est envoyé, on l'enregistre
// -----------------------------------------
 
if (isset($_POST['pseudo']) AND isset($_POST['message']))
{
    $pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo'])); // On utilise mysql_real_escape_string et htmlspecialchars par mesure de sécurité
    $message = mysql_real_escape_string(htmlspecialchars($_POST['message'])); // De même pour le message
    $message = nl2br($message); // Pour le message, comme on utilise un textarea, il faut remplacer les Entrées par des <br />
 
    // On peut enfin enregistrer :o)
    mysql_query("INSERT INTO sujet VALUES('', '" . $pseudo . "', '" . $message . "')");
}
 
// --------------- Étape 2 -----------------
// On écrit les liens vers chacune des pages
// -----------------------------------------
 
// On met dans une variable le nombre de messages qu'on veut par page
$nombreDeMessagesParPage = 2; // Essayez de changer ce nombre pour voir :o)
// On récupère le nombre total de messages
$retour = $bdd->query('SELECT COUNT(*) AS nb_messages FROM sujet');
$donnees = $retour->fetch();
$totalDesMessages = $donnees['nb_messages'];
// On calcule le nombre de pages à créer
$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
// Puis on fait une boucle pour écrire les liens vers chacune des pages
echo 'Page : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)
{
    echo '<a href="essai_pagination.php?page=' . $i . '">' . $i . '</a> ';
}
?>
 
</p>
 
<?php
 
 
// --------------- Étape 3 ---------------
// Maintenant, on va afficher les messages
// ---------------------------------------
 
if (isset($_GET['page']))
{
        $page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
}
else // La variable n'existe pas, c'est la première fois qu'on charge la page
{
        $page = 1; // On se met sur la page 1 (par défaut)
}
 
// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
 
$reponse = $bdd->query('SELECT * FROM sujet ORDER BY id_Sujet DESC LIMIT ' . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);
 
while ($donnees = $reponse->fetch())
{
        echo '<p><strong>' . $donnees['Utilisateur'] . '</strong> a écrit :<br />' . $donnees['message'] . '</p>';
}
?>
 
</body>
</html>