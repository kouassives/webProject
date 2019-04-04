<?php 
/****************************************************
#####################################################
##-------------------------------------------------##
##             INTIVEST CORP                       ##
##-------------------------------------------------##
## Copyright = globbersthemes.com- 2013            ##
## Date      = novembre 2013                       ##
## Author    = globbers                            ##
## Websites  = http://www.globbersthemes.com       ##
## version (joomla)                                ##
##                                                 ##
#####################################################
****************************************************/

defined('_JEXEC') or die('Restricted access');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>	
<jdoc:include type="head" />
	
<?php 
JHtml::_('behavior.framework', true);	
$app = JFactory::getApplication();	     
$csite_name	= $app->getCfg('sitename');	
?>
	
<?php      
$mod_right = $this->countModules( 'position-7' );     
if ( $mod_right ) { $width = '';    } else { $width = '-full';}    
 ?>	
 
 <?php 
	$logo = $this->params->get("logo", "intivest corp");
	
	?>

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/defaut.css" type="text/css" />	
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/joomlastyle.css" type="text/css" />	
<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/scroll.js"></script>	
<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/jquery.js">
</script>	<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/superfish.js"></script>	
<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/hover.js"></script>	
<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/slideshow.js"></script>
<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/DD_roundies_0.0.2a-min.js"></script>

<link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

<script type="text/javascript">
DD_roundies.addRule('.box, .box .moduletable h3, .box .moduletable_menu h3, #wrapper-main, #search, #right, .readmore a, .pagination a   ', '6px', true);
</script>

		
<script type="text/javascript" charset="utf-8">	    
var $j = jQuery.noConflict(); 			
$j(document).ready(function(){		    
$j("#slideshow").slideshow({			   
 pauseSeconds:5,			    
 height:334, 			    
 fadeSpeed:0.5,				
 width:681, 			    
 caption: true		   
 });		
 });	
 </script>			     
 
 <script type="text/javascript">		 
 var $j = jQuery.noConflict(); 
 $j(document).ready(function() {	        	
 $j(' .navigation ul ').superfish({		         	
 delay:       500,                            		        	
 animation:   {opacity:'show',height:'show'},  		        	
 speed:       'slow',                          		        	
 autoArrows:  false,                           		        	
 dropShadows: false                            	           	
 });	      	
 });        	
 </script> 			 	
 </head>
 <body>     
<div id="topmenu">	    
    <div class="pagewidth">
        <div id="name">		
            <div id="sitename">	            
                 <a href="index.php"><?php echo $logo ?></a>			
            </div>
			    <div id="search">
					<jdoc:include type="modules" name="position-0"  />
				</div>
        </div>
	        <div id="menu">
		         <div class="navigation">                        	            
                     <jdoc:include type="modules" name="position-1" />                    	        
                 </div>
		    </div>
	</div>
</div>
    <div class="pagewidth">
        <?php if ($this->countModules('position-2') ||  $this->countModules('position-0')) { ?>
		    <div id="pathway-w">
				<div id="pathway">
					<jdoc:include type="modules" name="position-2"  />
				</div>
			</div>
		<?php } ?>
    </div>
        <?php $menu = JSite::getMenu(); ?>            
        <?php $lang = JFactory::getLanguage(); ?>            
        <?php if ($menu->getActive() == $menu->getDefault($lang->getTag())) { ?>           
        <?php if ($this->params->get( 'slidedisable' )) : ?>   <?php include "slideshow.php"; ?><?php endif; ?>           
	    <?php } ?>
	        <div class="pagewidth">
			    <div id="wrapper-main">
				    <div id="main<?php echo $width; ?>">
					    <jdoc:include type="component" />
				    </div>
				         <?php if($this->countModules('position-7')) : ?>
	                        <div id="right">
	                            <jdoc:include type="modules" name="position-7" style="xhtml" />
	                        </div> 
	                   <?php endif; ?>
				</div>
				    <?php if ($this->countModules('position-3') || $this->countModules('position-4') || $this->countModules('position-6')) { ?>
	                    <div id="wrapper-box">
				            <div class="box">
						        <jdoc:include type="modules" name="position-3" style="xhtml" />
				            </div>
				            <div class="box">
						        <jdoc:include type="modules" name="position-4" style="xhtml" />
				            </div>
				            <div class="box">
						        <jdoc:include type="modules" name="position-6" style="xhtml" />           
				            </div>
                        </div>				
			        <?php } ?>
            </div>
			    <div id="ft">
			        <div class="pagewidth">
				        <div id="ftb-f">
						    <div class="ftb">
							    <?php echo date( 'Y' ); ?>&nbsp; <?php echo $csite_name; ?>&nbsp;&nbsp;&copy;&nbsp;<?php require("template.php"); ?>
                            </div>
					    </div>
						    <div id="top">
                                <div class="top_button">
                                    <a href="#" onclick="scrollToTop();return false;">
						            <img src="templates/<?php echo $this->template ?>/images/top.png" width="30" height="30" alt="top" /></a>
                                </div>
					        </div>		
				    </div> 
                </div>				
 </body>
 </html>