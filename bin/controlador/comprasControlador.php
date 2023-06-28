<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\compras as compras;

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral();

	if(!isset($_SESSION['nivel'])){
		die('<script> window.location = "?url=login" </script>');
	}

	$objModel = new compras();
	$proveedores = $objModel->mostrarProveedor();

	if(isset($_POST['mostrar'])){
		$objModel->mostrarCompras();
	}
	if (isset($_POST['selectM'])) {
		$objModel->mostrarMoneda();
	}

	if(isset($_POST['select'])){
		$objModel->mostrarSelect();
	}

	if(isset($_GET['producto']) && isset($_GET['fill'])){
		$objModel->productoDetalle($_GET['producto']);
	}

	if(isset($_POST['orden']) && isset($_POST['validar'])){
		$objModel->getOrden($_POST['orden']);
	}

	if(isset($_POST['proveedor']) && isset($_POST['orden']) && isset($_POST['fecha']) && isset($_POST['cambio']) && isset($_POST['montoT'])){
		$objModel->getCompras($_POST['proveedor'], $_POST['orden'], $_POST['fecha'], $_POST['cambio'], $_POST['montoT']);
	}
	if(isset($_POST['cantidad']) && isset($_POST['precio']) && isset($_POST['producto']) && isset($_POST['id'])){
		$objModel->getProducto($_POST['cantidad'], $_POST['precio'], $_POST['producto'], $_POST['id']);
	}

	if(isset($_POST['detalleCompra']) && isset($_POST['id'])){
		$objModel->getDetalleCompra($_POST['id']);
	}

	if(isset($_POST['eliminar']) && isset($_POST['id'])){
		$objModel->getEliminarCompra($_POST['id']);
	}


	if(file_exists("vista/interno/comprasVista.php")){
		require_once("vista/interno/comprasVista.php");
	}else{
		die('La vista no existe');
	}




?>