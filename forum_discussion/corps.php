<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=127.0.0.1;dbname=forum1','root', '',$pdo_options);
#ON RECUPERE TOUT LES CATEGORIES POUR LES LISTER
$reqcateg = $bdd->query("SELECT * FROM categorie;");		
?>

<section style=" border: 1px black solid" id="table_sujet">

			<p style="text-align: center;">LE FORUM DE L'ENTRAIDE EN INFORMATIQUE</p>
	<p style="display: inline; vertical-align: bottom;">POSTER</p>
	<div class="poster" align="center">
		<a href="postersujet.php">SUJET<img src="images/poster.png"/></a>
	</div>
	<div class="poster" align="center">
		<a href="posterfichier.php">FICHER<img src="images/poster.png"/></a>
	</div>
		</br></br>
	<div>
			<p>Sujets Recents</p>

			<!-- UTILISONS UNE BOUVLE POUR ¨PASSER LES CATEGORIES-->

			<?php
				while($categ = $reqcateg->fetch())
				{
					?>
					<table cellpadding=10 cellspacing=5 class="table_sujet">
					<tr>
						<td class="classred" colspan="3" align="center"><h3><?php echo $categ['libelle'];  ?></h3></td>
					</tr>
					<tr>
						<td class="classblue">Sujet</td>
						<td class="classblue">Auteur</td>
						<td class="classblue">Date du post</td>
					</tr>
					<?php
					$reqreponse = $bdd->prepare("SELECT * FROM sujet WHERE Categorie=? ORDER BY id_Sujet DESC LIMIT 3;");
					$reqreponse -> execute(array($categ['id_Cat']));
					$i=0;
						$sujetexist = $reqreponse->rowCount();
						if ($sujetexist>0)
						{
							while ($donnees = $reqreponse->fetch())
							{
								$date_post = new DateTime($donnees['datepost']);
								$date_post_h = $date_post->format('H');
								$date_post_m = $date_post->format('i');
								$date_post_s = $date_post->format('s');
								$date_post_date = $date_post->format('d-m-Y');
								
								$i++;
								#ON VA ALLER PRENDRE LE PSEUDO DE L'AUTEUR
								$reqauteur = $bdd->prepare("SELECT * FROM utilisateur WHERE id_Util=?;");
								$reqauteur ->execute(array($donnees['Utilisateur']));
								$auteur = $reqauteur -> fetch();
							?>
								<tr>
									<td ><a href="<?php echo 'sujet.php?id='.$donnees['id_Sujet'] ;?>"><?php echo $donnees['libelle_sujet'] ;?></a></td>
									<td class="classred"><a href="compte.php?pseudo=<?php echo $auteur['pseudo'];?>"><?php echo $auteur['pseudo'] ;?></a></td>
									<td ><?php echo $date_post_h.'h'.$date_post_m.'min'.$date_post_s.'s '.$date_post_date ;?></td>
								</tr>
								
							<?php
							}
						}
						else
						{
							echo '<p> AUCUN Sujet dans cette rubrique</p>';
						}
				}
				?>
				</table>
			</div>
</section>