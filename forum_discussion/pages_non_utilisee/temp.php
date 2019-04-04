

<?php
#POUR L'OPTION REPONDRE
if (isset($_POST['btrepondre']) )
{
	$reponse_sujet= htmlspecialchars($_POST['reponse_sujet']);
	if (!empty($_POST['reponse_sujet']))
	{
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		$dh=$date.' '.$heure;
		$temps = new DateTime($dh);
		$dateheure = $temps->format('Y-m-d H:i:s');

		$reqrepondre = $bdd->prepare("INSERT INTO reponse(message,datereponse,id_Utilisateur?id_Sujet) VALUES(?,?,?,?) ;");
		$reqrepondre -> execute(array($reponse_sujet,$dateheure,$_SESSION['pseudo'],$donnes_sujet['id_Sujet']));
		$erreur='<font color="green">Reponse envoyée avec succès !</font>';
	}
	else
	{
		$erreur='<font color="red">Ecrivez votre reponse !</font>';
	}
}
?>