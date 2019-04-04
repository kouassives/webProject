<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta charset="utf-8">
	<title>INSCRIPTION</title>
	<link rel="stylesheet" type="text/css" href="css.php">
</head>
<body>
<div id="block_page">

	<!-- ENTETE : INCLUS AUSSI LE PANNEL DE RECHERCHE -->
	<?php include("entete.php") ?>
	<!-- MENU -->
	<?php include("menu.php") ?>
	<!-- CORPS PRINCIPALE DE LA PAGE-->
	<div id="corps">
			<!-- corps pour message posté-->
			<!-- ECRIVONS SON NOUVEAU POST QU'IL A FAIT-->


			<table cellspacing="10">
				<caption><h2>MON JOLI PC</h2></caption>
					<tr>
					<td> <p>Categorie: TELECOMMUNICATION</p></td>
					<td>As a note to INET_ATON : if you are using (PHP 4, PHP 5) and are looking to get the integer value of an IP address, i have found that the following works flawlessly for converting to and from IPv4 and it's integer equivalent. 

$ip = &quot;127.0.0.0&quot;; // as an example

$integer_ip = (substr($ip, 0, 3) &gt; 127) ? ((ip2long($ip) &amp; 0x7FFFFFFF) + 0x80000000) : ip2long($ip);

echo $integer_ip; // integer value 
echo long2ip($integer_ip); // dotted format
-----------------------
Results are as follows:
-----------------------
2130706432
127.0.0.0
-----------------------
255.255.255.255 (converts to) 4294967295 (and back to) 255.255.255.255
209.65.0.0 (converts to) 3510697984 (and back to) 209.65.0.0
12.0.0.0 (converts to) 201326592 (and back to) 12.0.0.0
1.0.0.0 (converts to) 16777216 (and back to) 1.0.0.0

While i understand that this is a MySQL comment section, it seems that many have the same issue regarding MySQL / PHP IPv4 address handling in databases, and as such have posted this as a way to help those who, like myself, were frustrated with IP addresses that were not converting properly.</td>
					</tr>
			</table>
								
	</div>		

	<!-- PIED DE PAGE-->
	<?php include("pied_page.php"); ?>

</div>
</body>
</html>