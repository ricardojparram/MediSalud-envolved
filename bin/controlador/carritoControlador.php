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

<<<<<<< HEAD
	if(isset($_POST['validar'], $_POST['productos'])){
		$model->getValidarStock($_POST['productos']);
	}
=======
	//if()
>>>>>>> 9c59cb68211ff4c090ed5f32f74198fa604a10fb

	if(isset($_POST['editar'], $_POST['id_producto'], $_POST['cantidad'], $_SESSION['cedula'])){
		$model->getEditarProd($_POST['id_producto'], $_POST['cantidad'], $_SESSION['cedula']);
	}

	if(isset($_POST['eliminar'], $_POST['id'])){
		$model->getEliminarProd($_POST['id'], $_SESSION['cedula']);
	}

	if(isset($_POST['vaciarCarrito'])){
		$model->vaciarCarrito($_SESSION['cedula']);
	}

	$VarComp = new initcomponents();
	$Nav = new nav();
	
	require "vista/inicio/carritoVista.php";	

?>