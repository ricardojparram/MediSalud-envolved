<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;

	if(!isset($_SESSION['nivel'])){
    	die('<script> window.location = "?url=login" </script>');
  	}

  	$VarComp = new initcomponents();
   	$header = new header();
   	$menu = new menuLateral();

  	if(file_exists("vista/interno/ayudaVista.php")){
    	require_once("vista/interno/ayudaVista.php");
  	}

?>