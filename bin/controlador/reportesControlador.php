<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\reportes as reportes;

	if(!isset($_SESSION['nivel'])) die('<script> window.location = "?url=login" </script>');

	$objModel = new reportes();
	$permisos = $objModel->getPermisosRol($_SESSION['nivel']);
	$permiso = $permisos['Reportes'];

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral($permisos);

	if(isset($_POST['getPermisos']) && $permiso->status == 1){
		die(json_encode($permiso));
	}


	if(isset($_POST['mostrar'], $_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal']) && $permiso->consultar == 1){
		$objModel->getMostrarReporte($_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal']);
	}
	if(isset($_POST['exportar'], $_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal']) && $permiso->consultar == 1){
		$objModel->getExportar($_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal']);
	}


	if(file_exists("vista/interno/reportesVista.php")){
		require_once("vista/interno/reportesVista.php");
	}else{
		die('La vista no existe.');
	}

?>