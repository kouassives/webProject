<link rel="stylesheet" type="text/css" href="stylemenuc.css">
<div id="divmenu"> 
	<center>
		<div id="logo"><img src="logomi.jpeg" style="width: 60px;height: 45px;"></div>
		<nav >
			<ul>
				<li><a href="">Fichiers</a></li>
				<li> <a href="">Cours</a></li>
				<li><a href="">Forum</a></li>
			</ul>
		</nav>
		<div id="divdroit">
			<input type="search" name="recherche"  id="recherch" placeholder="recherche" style="display: inline-block;vertical-align: middle;">
					<img src="<?php echo $_SESSION['id_image']?>" style="width: 36px;height: 36px;display: inline-block;vertical-align: middle;border: 2px solid white; border-radius: 30px 30px 30px 30px;"><span id="lieni" style="background-color: green;color: white;padding: 6px 10px 6px 10px;" ><?php echo $_SESSION['pseudo']?></span>
					
			<a id="lienc" href="deconnexion.php">Deconnexion</a>
		</div>
			
		</div>
	</center>
</div>