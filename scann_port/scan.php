<?

// ********************************************
// Nom du script : scan.php
// Auteur : _SebF AT frameIP.com
// date de création : 07 Novembre 2003
// version : 2.1
// Licence : Ce script est libre de toute utilisation.
// La seule condition existante est de faire référence au site http://www.frameip.com afin de respecter le travail d'autrui.
// ********************************************

// ********************************************
// Affichage de l'entete html
// ********************************************
echo
            '
            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
            <html>
            <head>
            <LINK REL="StyleSheet" HREF="../style.css" TYPE="text/css">
            <title>FrameIP, Pour ceux qui aiment IP - Script Scan</title>
            <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <META NAME="AUTHOR" CONTENT="www.frameip.com">
            <META NAME="COPYRIGHT" CONTENT="Copyright (c) 2003 by framip">
            <META NAME="KEYWORDS" CONTENT="scan, online, outil, tcp, udp, port, destination, ouvert ferme, session, valider, validation, securite">
            <META NAME="DESCRIPTION" CONTENT="Frameip, pour ceux qui aiment IP - Script Scan">
            <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
            <META NAME="REVISIT-AFTER" CONTENT="1 DAYS">
            <META NAME="RATING" CONTENT="GENERAL">
            <META NAME="GENERATOR" CONTENT="powered by frameip.com - webmaster@frameip.com">
            </head>
            <body>
            ';

// **********************************************
// Récupération des variables POST
// **********************************************
$scan_adresse_ip = $_POST['ipaddress'];
$scan_port_de_depart = $_POST['port1'];
$scan_port_de_fin = $_POST['port2'];

// **********************************************
// Enregistrement du compteur
// **********************************************
include '../variables.php';
$info_compteur1=$scan_adresse_ip;
$info_compteur2=$scan_port_de_depart;
$info_compteur3=$scan_port_de_fin;
$specifiez_le_nom_du_compteur="scan.php";
include '../compteur.php';

// ********************************************
// Vérification du champ IP
// ********************************************
if (empty($scan_adresse_ip))
            scan_erreur(1);            
if ($scan_adresse_ip==0)
            scan_erreur(4);            
if (ip2long($scan_adresse_ip)==-1) // Vérification de la conformité de l'IP
            scan_erreur(4);            
else
            {
            // Transforme les saisies tel que 10.10..4 en 10.10.0.4
            $inetaddr=ip2long($scan_adresse_ip);
            $scan_adresse_ip=long2ip($inetaddr);
            }

// ********************************************
// Vérification des champs ports
// ********************************************
if (empty($scan_port_de_depart))
            scan_erreur(2);            
if (empty($scan_port_de_fin))
            scan_erreur(3);
if (is_numeric($scan_port_de_depart)==false) // Si ce n'est pas un nombre
            scan_erreur(10);
if (is_numeric($scan_port_de_fin)==false) // Si ce n'est pas un nombre
            scan_erreur(11);
if ($scan_port_de_depart<=0)
            scan_erreur(5);
if ($scan_port_de_fin>65535)
            scan_erreur(6);
if ($scan_port_de_depart>$scan_port_de_fin)
            scan_erreur(7);
if ($scan_port_de_fin-$scan_port_de_depart>20)
            scan_erreur(9);

// **********************************************
// Affichage du titre
// **********************************************
echo     '
            <p class="titre-principal">
                        Scanner de ports TCP
            </p>
            <BR>
            <p >
                        Voici les résultats du Scan de l\'adresse IP '.$scan_adresse_ip.' entre le port '.$scan_port_de_depart.' et '.$scan_port_de_fin.'
            <BR>
            <BR>
            ';

// **********************************************
// Boucle lancant les appels du script de scan port par port
// **********************************************
for ($i=$scan_port_de_depart;$i<$scan_port_de_fin+1;$i++)
            {
            echo '<script src="scan2.php?host='.$scan_adresse_ip.'&port='.$i.'"></script>';
            }
            echo '</p>';

// ********************************************
// Fin du script général
// ********************************************
fin_du_script();

// ********************************************
// Fonction de gestion des erreurs
// ********************************************
function scan_erreur($erreur) // $erreur représente le numéro d'erreur.
            {
            // ********************************************
            // Affichage de titre
            // ********************************************
            echo
                        '
                        <p class="titre-principal">
                                   Erreur
                        </p>
                        ';

            // ********************************************
            // Affichage de l'erreur
            // ********************************************
            echo     '<p >';

            // ********************************************
            // Message personnalisé
            // ********************************************
            if ($erreur==1)
                        echo 'Le Scan ne peux pas avoir lieu car le champ IP est vide.';
            elseif ($erreur==2)
                        echo 'Le Scan ne peux pas avoir lieu car le champ Port de début est vide.';
            elseif ($erreur==3)
                        echo 'Le Scan ne peux pas avoir lieu car le champ Port de fin est vide.';
            elseif ($erreur==4)
                        echo 'Le Scan ne peux pas avoir lieu car le champ IP ne contient pas d\'adresse valide.';
            elseif ($erreur==5)
                        echo 'Le Scan ne peux pas avoir lieu car le champ Port de début est inférieur ou égale à 0.';
            elseif ($erreur==6)
                        echo 'Le Scan ne peux pas avoir lieu car le champ Port de fin est suppérieur à 65535.';
            elseif ($erreur==7)
                        echo 'Le Scan ne peux pas avoir lieu car le champ Port de début est suppérieur au port de fin.';
            elseif ($erreur==9)
                        echo 'Le Scan ne peux pas avoir lieu car vous demandez de scanner plus de 20 ports.';
            elseif ($erreur==10)
                        echo 'Les donnees du champ port de depart ne reprensente pas un nombre.';
            elseif ($erreur==11)
                        echo 'Les donnees du champ port de fin ne represente pas un nombre.';

            // ********************************************
            // Fin du script général
            // ********************************************
            echo '<br><br>';
            fin_du_script();
            }

function fin_du_script()
            {
            // ********************************************
            // Affiche de l'Url
            // ********************************************
            echo
                        '
                                   <a href="http://www.frameip.com">
                                               www.frameip.com
                                   </a>
                        </p>
                        ';

            // ********************************************
            // Fin de la page Html
            // ********************************************
            echo
                        '
                        </body>

                        </html>
                        ';

            // ********************************************
            // Fin du script général
            // ********************************************
            exit(0);
            }

?>