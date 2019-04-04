<?php
 class Actualise extends Thread {

	
public function __construct(){
$i=0;
	$j=100;
}

public function run(){
  while($i<$j){
  		echo "<p>je suis a la </p>".$i;

  		$i++;
   sleep(1000);
  }
}
}


if (isset($_SESSION['thread']))
{
	$_SESSION['thread']=1;
	$threads=new Actualise();

	$threads->start();
}

?>