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

	if(!isset($permiso["Consultar"])) die('<script> window.location = "?url=home" </script>');

	if(isset($_POST['notificacion'])) {
		$objModel->getNotificacion();
	}

	if(isset($_POST['getPermisos'], $permiso['Consultar'])){
		die(json_encode($permiso));
	}


	if(isset($_POST['mostrar'], $_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal'], $permiso["Consultar"])){
		$objModel->getMostrarReporte($_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal']);
	}
	if(isset($_POST['exportar'], $_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal'], $permiso["Exportar reporte"])){
		$objModel->getExportar($_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal']);
	}
	if(isset($_POST['estadistico'], $_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal'], $permiso["Exportar reporte estadistico"])){
		$objModel->getReporteEstadistico($_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal']);
	}


	if(file_exists("vista/interno/reportesVista.php")){
		require_once("vista/interno/reportesVista.php");
	}else{
		die('La vista no existe.');
	}

?>