<!--	TRAVAIL AVEC LA BASE DE DONNEES -->
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new pdo('mysql:host=localhost;dbname=forum1','root', '',$pdo_options);

		
?>

<section style="max-width: 900px; border: 1px black solid">
	<p style="display: inline; vertical-align: bottom;">POSTER</p>
	<div class="poster">
		<a href="postersujet.php">SUJET</a>
		<center><a href="postersujet.php"><img src="images/poster.png"/></a></center>
	</div>
	<div class="poster">
		<a href="poster.php">FICHER</a>
		<center><a href="poster.php" ><img src="images/poster.png"/></a></center>
	</div>
		</br></br>
	<div>
			<p>Sujets Recents</p>

			<!-- BOUTON POUR LA CATEGORIE RESEAU-->
			<!-- UTILISONS UNE BOUVLE POUR ¨PASSER LES CATEGORIES-->

			<?php
				while()
				{

				}

			?>
			<button type="button" class="btcategorie" onclick="toggle_div(this,'RESEAU');">RESEAU</button>
			<div id="RESEAU" style="display:none;border: 1px blue solid;" >
				<?php
				$reponse = $bdd->query("SELECT * FROM sujet WHERE categorie=1;");
				$i=0;
					$sujetexist = $reponse->rowCount();
					if ($sujetexist>0)
					{	
						while ($donnees = $reponse->fetch())
						{
							$i++;
						?>
							<tr>
								<td ALIGN=right><?php echo '<p>Sujet '.$i.':' ;?></td>
								<a href="<?php echo 'sujet.php?id='.$donnees['id_Sujet'] ;?>"><td><?php echo $donnees['libelle_sujet'] ;?></td></a>
							<tr>
						<?php
						}
					}
					else
					{
						echo '<p> AUCUN Sujet dans cette rubrique</p>';
					}
				?>
				<script type="text/javascript">
				function toggle_div(bouton, id) { // On déclare la fonction toggle_div qui prend en param le bouton et un id
				  var div = document.getElementById(id); // On récupère le div ciblé grâce à l'id
				  if(div.style.display=="none") { // Si le div est masqué...
				    div.style.display = "block"; // ... on l'affiche...
				    bouton.innerHTML = "RESEAU"; // ... et on change le contenu du bouton.
				  } else { // S'il est visible...
				    div.style.display = "none"; // ... on le masque...
				    bouton.innerHTML = "RESEAU"; // ... et on change le contenu du bouton.
				  }
				}
				</script>
			</div>

			<!-- BOUTON POUR LA CATEGORIE TELECOMMUNICATION-->
			<button type="button" class="btcategorie" onclick="toggle_div2(this,'TELECOMMUNICATION');">TELECOMMUNICATION</button>
			<div id="TELECOMMUNICATION" style="display:none; border: 1px blue solid;" >
				<?php
				$reponse = $bdd->query("SELECT * FROM sujet WHERE categorie=2;");
				$i=0;
					$sujetexist = $reponse->rowCount();
					if ($sujetexist>0)
					{
						while ($donnees = $reponse->fetch())
						{
							$i++;
						?>
							<tr>
								<td ALIGN=right><?php echo '<p>Sujet '.$i.':' ;?></td>
								<a href="<?php echo 'sujet.php?id='.$donnees['id_Sujet'] ;?>"><td><?php echo $donnees['libelle_sujet'] ;?></td></a>
							<tr>
						<?php
						}
					}
					else
					{
						echo '<p> AUCUN Sujet dans cette rubrique</p>';
					}
				?>
				<script type="text/javascript">
				function toggle_div2(bouton, id) { // On déclare la fonction toggle_div qui prend en param le bouton et un id
				  var div = document.getElementById(id); // On récupère le div ciblé grâce à l'id
				  if(div.style.display=="none") { // Si le div est masqué...
				    div.style.display = "block"; // ... on l'affiche...
				    bouton.innerHTML = "TELECOMMUNICATION"; // ... et on change le contenu du bouton.
				  } else { // S'il est visible...
				    div.style.display = "none"; // ... on le masque...
				    bouton.innerHTML = "TELECOMMUNICATION"; // ... et on change le contenu du bouton.
				  }
				}
				</script>
			</div>

			<button type="button" class="btcategorie" onclick="toggle_div2(this,'DEVELOPPEMENT');">DEVELOPPEMENT</button>
			<div id="DEVELOPPEMENT" style="display:none; border: 1px blue solid;" >
				<?php
				$reponse = $bdd->query("SELECT * FROM sujet WHERE categorie=3;");
				$i=0;
				$sujetexist = $reponse->rowCount();
					if ($sujetexist>0)
					{
						while ($donnees = $reponse->fetch())
						{
							$i++;
						?>
							<tr>
								<td ALIGN=right><?php echo '<p>Sujet '.$i.':' ;?></td>
								<a href="<?php echo 'sujet.php?id='.$donnees['id_Sujet'] ;?>"><td><?php echo $donnees['libelle_sujet'] ;?></td></a>
							<tr>
						<?php
						}
					}
					else
					{
						echo '<p> AUCUN Sujet dans cette rubrique</p>';
					}
				?>
				<script type="text/javascript">
				function toggle_div3(bouton, id) { // On déclare la fonction toggle_div qui prend en param le bouton et un id
				  var div = document.getElementById(id); // On récupère le div ciblé grâce à l'id
				  if(div.style.display=="none") { // Si le div est masqué...
				    div.style.display = "block"; // ... on l'affiche...
				    bouton.innerHTML = "DEVELOPPEMENT"; // ... et on change le contenu du bouton.
				  } else { // S'il est visible...
				    div.style.display = "none"; // ... on le masque...
				    bouton.innerHTML = "DEVELOPPEMENT"; // ... et on change le contenu du bouton.
				  }
				}
				</script>
			</div>
	</div>
</section>