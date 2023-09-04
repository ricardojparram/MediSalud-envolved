<?php

	use component\initcomponents as initcomponents;
	use component\nav as nav;
	use component\carDesplegable as carDesplegable;
	

	$VarComp = new initcomponents();	
	$Nav = new nav();
	$Car = new carDesplegable();
	
	require "vista/inicio/inicioVista.php";	

?>