<? 

// ********************************************
// Nom du script : scan2.php
// Auteur : _SebF AT frameIP.com
// date de création : 29 Novembre 2003
// version : 2.1
// Licence : Ce script est libre de toute utilisation.
// La seule condition existante est de faire référence au site http://www.frameip.com afin de respecter le travail d'autrui.
// ********************************************

// **********************************************
// Interdiction de la mise en cache
// **********************************************
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

// **********************************************
// Suppression des warning et erreurs si la session tcp ne monte pas
// **********************************************
error_reporting(0);

// **********************************************
// Ouverture de session tcp
// **********************************************
$socket=fsockopen($host, $port, &$errno, &$errstr, 1);

if ($socket)
            {
            // **********************************************
            // La session s'est bien ouverte
            // **********************************************
            $nombre_de_port_ouvert++;
            fclose($socket);
            echo "document.write('<BR>Le port TCP $port est ouvert');";
            }
else
            // **********************************************
            // La session ne s'est pas ouverte
            // **********************************************
            echo "document.write('<BR>Le port TCP $port est fermé      $nombre_de_port_scanne');";


?>