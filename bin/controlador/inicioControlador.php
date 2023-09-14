<?php

	use component\initcomponents as initcomponents;
	use component\nav as nav;
	use component\carDesplegable as carDesplegable;
	use modelo\inicio as inicio;

	$model = new inicio();

	if (isset($_POST['mostraC'])) {
	 $model->mostrarCatalogo();
	}

	$VarComp = new initcomponents();	
	$Nav = new nav();
	$Car = new carDesplegable();
	
	require "vista/inicio/inicioVista.php";	

?>