
<?php 
$_SESSION['var']="moi";
?>
<script type="text/javascript">
										<!--
										function open_window(url,timeout) 
										{
										/*
											1 - url : String -> url de la page à ouvrir
											2 - timeout : Int -> temps en milliseconde avant fermeture de la page
										*/

											var window_handle = window.open(url);
											window.setTimeout(function() { window_handle.close(); }, timeout);
										}
										//-->
										</script>
										<script type="text/javascript">
										<!--
										/*
										window.setInterval("open_window('http://bing.com',4000);", 1000); //ouvre la page toutes les secondes
										/*/
										window.setTimeout("open_window('confirmation_inscription.php',4000);", 1000); //ouvre la page au bout d'une seconde
										//*/
										//-->
									</script>