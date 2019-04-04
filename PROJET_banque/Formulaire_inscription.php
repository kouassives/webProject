<?php 
session_start();
try
{  
$bdd= new PDO('mysql:host=127.0.0.1;dbname=gestions_compte_banquaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());	
}
	srand();
	$rand = rand(100, 1000);
	$message='';
if(isset($_POST['inscription']))
	{

	if(empty($_POST['nom']) || empty($_POST['numci']) || empty($_POST['etat']) || empty($_POST['social']) || empty($_POST['adresse']) || empty($_POST['contact'])|| empty($_POST['profession']) || empty($_POST['ville']) || empty($_POST['mandataire']) || empty($_POST['nationalite']))
		{
	$message='<strong style="color:red"> veuillez remplir Tous les champs</strong>';
		}
		else
		{

									$numcli='BC'.$rand;
										// nom de l'image est $name_file=$_FILES['file']['name'];
										$tmp_name=$_FILES['file']['tmp_name'];
										$local_image = "images/";     
										move_uploaded_file($tmp_name,$local_image.$_POST['nom'].$numcli.'.jpg');
									
									$reponse = $bdd->prepare('INSERT INTO clients(numero_client, nom_postulant, numero_cardteId, etat_civil, raison_social, adresse, mail, contact,profession, nom_mandataire, nationalite, province_origine, sexe, date_naissance, ID_image) VALUES(:numero_client, :nom_postulant, :numero_cardteId, :etat_civil, :raison_social, :adresse, :mail, :contact, :profession, :nom_mandataire, :nationalite, :province_origine, :sexe, :date_naissance, :ID_image)'); 
									$reponse->execute(array(
										'numero_client'=>$numcli,
										'nom_postulant'=>$_POST['nom'],
										'numero_cardteId'=>$_POST['numci'],
										'etat_civil'=>$_POST['etat'],
										'raison_social'=>$_POST['social'],
										'adresse'=>$_POST['adresse'],
										'mail'=>$_POST['mail'],
										'contact'=>$_POST['contact'],
										'profession'=>$_POST['profession'],
										'nom_mandataire'=>$_POST['mandataire'],
										'nationalite'=>$_POST['nationalite'],
										'province_origine'=>$_POST['ville'],
										'sexe'=>$_POST['sexe'],
										'date_naissance'=>$_POST['naissance'],
										'ID_image'=>$local_image.$_POST['nom'].$numcli.'.jpg',
										));
		
	}
	
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="index.css" />
		<title>
		inscription 
		</title>
	</head>
	
	<body>
		<?php include("header.php");?>
		<center>
		<div>
		<table border=1 >
		<TR><TD  bgcolor=white align=center><font color=black>
				
		<form ACTION=""  METHOD="POST" enctype="multipart/form-data">
				
				<h1 style="color:green">FORMULAIRE D'INSCRIPTION
				</h1>
				<HR color="red" width="350px" size=5>
		
					<p>
					<strong><label for="nom">NomClt</label></strong>
					</br></br>
					<input type="text" name="nom" value="" placeholder="votre nom"size=40 />
				</p>
					<p>
					<strong><label for="numci">NumeroCI</label></strong>
				</br></br>
					<input type="text" name="numci" value="" placeholder="numero CI"size=40 />
				</p>
				<p>
					<strong><label for="etat">Etat civil</label></strong>
		</br></br>
					<input type="text" name="etat" value=""placeholder="etat"size=40 />
				</p>
				<p>
					<strong><label for="raison">Raison-Social</label></strong> 
		</br></br>
					<input type="text" name="social" value="" placeholder="raison social"size=40 />
				</p>
				<p>
					<strong><label for="adresse">Adresse</label></strong>
				</br></br>
					<input type="text" name="adresse" value="" placeholder="adresse"size=40 />
				</p>
				
				<p>
					<strong><label for="mail">adresse e-mail</label></strong>
		</br></br>
					<input type="email" name="mail" value="" placeholder="e-mail"size=40/>
				</p>
				
				<p>
					<strong><label for="contact">Contact</label></strong>
				</br></br>
					<input type="text" name="contact" value="" placeholder="contact" size=40 />
				</p>
				<p>
					<strong><label for="profession">Profession</label></strong>
			</br></br>
					<input type="text" name="profession" value="" placeholder="profession" size=40 />
				</p>
				<p>
					<strong><label for="mandataire">Nom-Mandataire</label></strong>
				</br></br>
					<input type="text" name="mandataire" value="" placeholder="nom madataire"size=40 />
				</p>
					<p>
					<strong><label for="nationalite">Nationalité</label></strong>
					</br></br>
					<input type="text" name="nationalite" value="" placeholder="nationalite" size 40>
				</p>
				<p>
					<strong><label for="ville">ville</label></strong>
				</br></br>
					<input type="text" name="ville" value="" placeholder="ville" size=40 />
				</p>
				<p><strong> sexe:</strong><select name="sexe" id="numero">
							<option value="masculin">MASCULIN</option>
							<option value="	feminin">FEMININ</option>

						</select>
				</p>
				<p>
					<strong><label for="naissance">date de naissance</label></strong></br></br>
					<input type="date"  name="naissance"placeholder="jj/mm/aaaa" size=60/>
				</p>
					<p>
					<strong><label for="file">inserer une image de profile</label><br /></br></strong>
					<input type="file" name="file" onchange="loadFile(event)" required /> </br></br>
					<img id="output" src="inconnue.jpg" ALIGN=MIDDLE BORDER=3 HSPACE=1 WIDTH=100 HEIGHT=100>
					
					<script>
                                 var loadFile = function(event) {
                                 var output = document.getElementById('output');
									output.src = URL.createObjectURL(event.target.files[0]);
                                                                      };
                    </script><br>
                    		<?php if(!empty($message));?>
				<?php echo "$message";?>
                    <Hr>
				</p>
					
				<p>
					<input type="submit" value="inscription" name="inscription" class="inscription"/>
				</p>
			</form>
				</TR></TD>
			</table>
		</div >
		</center>
		<HR color="red" width="100%" size=7>
		<?php include("footer.php");?>
	</body>
</html>