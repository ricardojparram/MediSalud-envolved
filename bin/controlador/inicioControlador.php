<?php

	use component\initcomponents as initcomponents;
	use component\tienda as tienda;
	use component\footerInicio as footerInicio;
	use modelo\inicio as inicio;

	$model = new inicio();

	if (isset($_POST['mostraC'])) {
	 	$model->mostrarCatalogo();
	}

	if (isset($_POST['mostraProductos']) && isset($_POST['id'])) {
		$model->rellenarDatos($_POST['id']);
	}

	if(isset($_POST['validarStock'], $_POST['id'])){
		$model->getValidarStock($_POST['id']);
	}

	if(isset($_POST['añadirCarrito'], $_POST['id'], $_POST['cantidad'])){
		if(!isset($_SESSION['cedula'])){
			$res = ['resultado' => false, 'msg' => 'Necesita iniciar sesión para agregar productos al carrito.'];
			die(json_encode($res));
		}
		$model->getAgregarProducto($_SESSION['cedula'], $_POST['id'], $_POST['cantidad']);
	}

	
	$VarComp = new initcomponents();	
	$tiendaComp = new tienda();
	$footer= new footerInicio(); 
	require "vista/inicio/inicioVista.php";	

?>