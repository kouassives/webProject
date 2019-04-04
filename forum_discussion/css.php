<?php
   header('content-type: text/css');
   ob_start('ob_gzhandler');
   header('Cache-Control: max-age=1, must-revalidate');
   // etc.
session_start();	
?>
<?php
#TOUT COMMENTAIRE SERA SAISIE DANS LA BALISE PHP  <?php commentaire> j'ai omis le ? volontairement car si on le met, la zone de commentaire es terminée
# CECI EST UN FICHIER PHP QUI NOUS SERVIRA A DYNAMISER NOTRE CODE CSS
#RIEN NE DOIT ETRE ECRIS AVANT LES INSTRUCTIONS
#   header('content-type: text/css');
#  ob_start('ob_gzhandler');
#  header('Cache-Control: max-age=1, must-revalidate');
   // etc.
#	session_start();
# cacher le bouton de repondre au sujet si l'utilisateur n'est pas connecté	
?>

			.boutons_connexion_insciption
			{
				display: none;
			}
			#bouton_sedeconnecter
			{
				display: none;
			}
			
		<?php
  if ( !empty($_SESSION['pseudo']) )
		{
		?>
			#bouton_sedeconnecter
			{
				display: inline;
			}
			.boutons_connexion_insciption
			{
				display: none;
			}
			#btrepondreseconnecter
			{
				display: none;
			}
			#btposterseconnecter
			{
				display: none;
			}
			

		<?php
		}
		else
		{
		?>
			#bouton_sedeconnecter
			{
				display: none;
			}
			.boutons_connexion_insciption
			{
				display: inline;
			}

			.btrepondreacacher
			{
				display: none;
			}
			.btpostercacher
			{
				display: none;
			}

		<?php
		}
?>

@font-face
{
    font-family: 'MaSuperPolice';
    src: url('polices/SpaceMono-Bold.ttf')
}

/* PAGE PRINCIPALE*/ 

body
{	
	min-height: 1024px;
	color: #fefefe;
	background: url('images/Website_Design_Background.png') fixed;
}

a
{
	text-decoration: none;
	color: #fefefe;	
}
#corps a
{
	font-style: oblique;
	color: #fefefe;
	text-decoration: none;
	font-style: normal;
}
a:visited
{
	color: 	#fefefe;
}


#entetepage
{
	height: 200px;
}

#basentete
{
	font-family: MaSuperPolice;
	font-size: 22px;
	text-align: center;
}

#block_page
{
	width: 1024px;
	margin:auto;
}
#corps a:hover
{
text-decoration: underline;
}


li
{
	list-style-type: none ;
}

td
{	
	border-radius: 5px;
	border: 0.5px rgba(20,20,60,1) solid;
	background-color: rgba(0,0,60,0.1);
	padding: 3px;
}

th
{
	background-color: black;
	border-radius: 5px;
	padding: 3px;
}

.classred
{
	background-color: rgba(250,0,0,0.6);;
	border-radius: 5px;
	padding: 3px;
}

.classblue
{
	background-color: rgba(50,10,150,0.6);
	border-radius: 5px;
	padding: 3px;
}


header
{

}

header div
{
	display: inline-block;
}

.titre_principale
{
	font-size:12px;
}

#hd2
{
	display: inline-block;
	float: right;
}

div img
{
	display: block;
}

#pannel_sincrire_connexion
{
	float: right;
}


#rech
{
	float: left;
}

#menu
{
	background: url('images/menu_Abstract_Balls_.png') fixed no-repeat left bottom;
	position: fixed;
	border-radius: 15px;
	left: 5px;
	height : 468px;
}

.titre_dans_menu
{
	background-color: rgba(0,0,0,0.3);
	border: 1px black solid;
	font-size: 18px;
}

li
{
	padding: 2px;
	margin: 3px;
	background-color: rgba(4,40,88,0.3);
	border: 1px black solid;
}

.ul_menu_repositionne
{
position: relative;
left: -20px;
}
#corps
{
	background-color: rgba(0,0,0,0.7);
	width: 800px;
	margin: auto;
	vertical-align: top;
}

#block_livre_dor
{
    text-align:center;
}

footer
{
	width: 500px;
	margin: auto;
	background-color:rgba(0,0,0,0.8);
}

.poster
{
	display: inline-block;
}
.btcategorie
{
display: block;
}



.table_sujet,.table_boite_reception
{
	text-align: center;
	width: 650px;
	margin: auto;
}

#reglement
{
	font-size: 22px;
}

<?php # value qui etait: max-width: 1150px ?>
@media screen and (max-width: 320px)
{
	#menu
	{
		position: relative;
		display: inline-block;
	}
	#block_page
	{
		width: 500px;
		margin-left: 0px;
	}
	#corps
	{
		margin-left: 0px;
	}
	td
	{
		display: block;
		max-width: 220px;
		padding:2px 5px;
	}

	#rech
	{
		float: none;
		display: block;
	}
	#hd2
	{
		float: left;
		display: block;
	}

	#basentete
	{
		clear: left;
		float: left;
		display: block;
		font-size: 9px;
	}

	#menu
	{
		background: url('images/menu_Abstract_Balls_.png') no-repeat;
		background-position: top;
		height : 468px;
	}
	#table_sujet
	{
		position: relative;
		left: -40px;
	}
	#presentation_utilisateur
	{
	width: 500px;
	}

	footer
	{
		max-width: 245px;
		font-size: 10px;
		position: relative;
		left: 0px;
		bottom: 0px;
		float: left;
	}

}