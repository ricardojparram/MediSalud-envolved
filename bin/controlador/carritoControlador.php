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

	if(isset($_POST['validar'], $_POST['productos'])){
		$model->getValidarStock($_POST['productos']);
	}

	if(isset($_POST['editar'], $_POST['id_producto'], $_POST['cantidad'])){
		$model->getEditarProd($_POST['id_producto'], $_POST['cantidad']);
	}

	$VarComp = new initcomponents();	
	$Nav = new nav();
	
	require "vista/inicio/carritoVista.php";	

?>