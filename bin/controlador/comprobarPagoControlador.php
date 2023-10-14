<?php  

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\comprobarPago;

	$model = new comprobarPago();
	$permisos = $model->getPermisosRol($_SESSION['nivel']);
	$permiso = $permisos['Bitacora'];

	if(isset($_POST['mostrar'], $_POST['bitacora'], $permiso['Consultar'])){
		$model->mostrarPagos($_POST['bitacora']);
	}

	$comp = new initcomponents();
	$header = new header();
	$menu = new menuLateral($permisos);

	if(!file_exists("vista/interno/comprobarPagoVista.php")){
		die("No existe la vista del módulo");
	}

	require_once("vista/interno/comprobarPagoVista.php");

?>