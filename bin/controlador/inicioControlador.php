<?php

	use component\initcomponents as initcomponents;
	use component\nav as nav;
	use component\carDesplegable as carDesplegable;
	use component\footerInicio as footerInicio;

	$VarComp = new initcomponents();	
	$Nav = new nav();
	$Car = new carDesplegable();
	$footer= new footerInicio(); 
	require "vista/inicio/inicioVista.php";	

?>