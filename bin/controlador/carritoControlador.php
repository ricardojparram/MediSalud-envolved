<?php  

	use component\initcomponents as initcomponents;
	use component\nav as nav;	
	use modelo\carrito as carrito;

	$model = new carrito();

	if(isset($_POST['mostrar'], $_POST['carrito'])){
		if(!isset($_SESSION['nivel'])){
			die(json_encode(['error' => '', 'msg' => 'No ha iniciado sesión.']));
		}
		$model->getCarritoUsuario($_SESSION['cedula']);
	}

	// if()

	$VarComp = new initcomponents();	
	$Nav = new nav();
	
	require "vista/inicio/carritoVista.php";	

?>