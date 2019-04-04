<?php 
session_start();

$_SESSION['pseudo']="DUMAS";

if (isset($_POST['ajout']) and isset($_POST['pseudo']) and isset($_POST['titre']) and isset($_POST['contenu']))
{
	if (!empty($_POST['pseudo']) and !empty($_POST['titre']) and !empty($_POST['contenu']))
{
	try
	{
		$base=new PDO('mysql:host=localhost;dbname=baseforum','root','');
		$req=$base->prepare('insert into sujets (titre,auteur,contenu,date_creation) values(?,?,?,?)');
		$req->execute(array($_POST['titre'],$_POST['pseudo'],$_POST['contenu'],"2016-11-18 22:35:30"));

		header("location:index.php");
	}catch(Exception $e)
	{
		die('erreur: '.$e->getmessage());
	}
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Mon forum</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta charset="utf-8">
	</head>
	<body >
		<header>
			
				<?php 
					if (!empty($_SESSION['pseudo']))
					{
						 include("menuconec.php");
					}
					else
					{
						include("menudeconec.php");
					}
				?>
				
				<p>
					<em id="repe" >
					<?php echo '<a href="index.php" style="color: white;">Accueil</a>';?>
					</em>
				</p>
				<p id="tab">
					<span>Forum</span> 
				</p>
			
		</header>
		<section>
			<?php
	if (!empty($_SESSION['pseudo']))
			{
				include("Menu.php") ;
			} ?>
			<?php 
				try
				{
					$base2=new PDO('mysql:host=localhost;dbname=baseforum','root','');
					$req2=$base2->query("SELECT * from domaines");

				}catch(Exception $e)
				{
					die('erreur: '.$e->getmessage());
				}

				while ($donnes=$req2->fetch()) {

							?>
					
							<p class="titrecateg">
							<span><?php echo $donnes['titre'];?></span> 
							</p>
							<center >
							<div style="max-width: 70%;">
							<?php
					
						$req3=$base2->prepare("SELECT id,titre,contenu,image,id_dernier from categories where id_domaine=?");
						$req3->execute(array($donnes['id']));

						while ($donnes2=$req3->fetch()) {

								$req4=$base2->prepare("SELECT s.id as id, s.titre as titre from sujets s,commentaires com where s.id_categ=? and s.id=com.id_sujets order by com.date_commentaire DESC");
								$req4->execute(array($donnes2['id']));
								$donnes3=$req4->fetch();
							

						?>
							<table class="tablecateg">
								<tr>
									<td>
									<a href="sujets.php?id_categ=<?php echo $donnes2['id'] ;?>&amp;page=1" class="liencateg" >
									<table>
										<td><img src="<?php echo $donnes2['image'] ;?>" style="float: left;width: 40px;height: 40px;margin-right: 10px;"><?php echo $donnes2['titre'] ;?><br><?php echo $donnes2['contenu'] ;?><br><br></td>
									</table>
									</a>
									</td>
								</tr>
								<tr>
									<td>

									<?php	
											if (!empty($donnes3['titre'])) {
												?>

														<a href="commentaires.php?sujet=<?php echo $donnes3['id'];?>" class="liencategm" >
												<table>
													<td >Denier Message:<br><span style="text-decoration: underline;"><?php echo strtolower($donnes3['titre']);	 ?></span></td>
												</table>
												</a>
												<?php
												}
												else
												{
													?>

												<span class="liencategm" >
												<table>
													<td >Denier Message:<br><span style="text-decoration: underline;"><?php echo "-";	 ?></span></td>
												</table>
												</span> 
													<?php
												}

									?>
									
									</td>
								</tr>
							</table>
							
						<?php
							$req4->CloseCursor();
						}
						?>
						</div>
						</center>
						<?php


				}

			 ?>		
				
				</center>
				<br><br><br>
		</section>
		<footer >
			<?php include("pied_de_page.php");?>
		</footer>

	</body>
</html>