<?php  

	use component\initcomponents as initcomponents;
	use component\tienda;	
	use modelo\carrito as carrito;

	$model = new carrito();

	if(isset($_POST['mostrar'], $_POST['carrito'])){
		if(!isset($_SESSION['nivel'])){
			die(json_encode(['error' => '', 'msg' => 'No ha iniciado sesión.']));
		}
		$model->getCarritoUsuario($_SESSION['cedula']);
	}

	if(isset($_POST['añadirCarrito'], $_POST['id'], $_POST['cantidad'])){
		if(!isset($_SESSION['cedula'])){
			$res = ['resultado' => false, 'msg' => 'Necesita iniciar sesión para agregar productos al carrito.'];
			die(json_encode($res));
		}
		$model->getAgregarProducto($_SESSION['cedula'], $_POST['id'], $_POST['cantidad']);
	}


	if(isset($_POST['validar'], $_POST['productos'])){
		$model->getValidarStock($_POST['productos']);
	}

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
	$tiendaComp = new tienda();
	
	require "vista/inicio/carritoVista.php";	

?>