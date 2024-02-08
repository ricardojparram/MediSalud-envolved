<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\clase as clase;

	 if(!isset($_SESSION['nivel'])){
		die('<script> window.location = "?url=login" </script>');
	}

	$objModel = new clase();
	$permisos = $objModel->getPermisosRol($_SESSION['nivel']);
	$permiso = $permisos['Clase'];

	 if(!isset($permiso['Consultar'])) die(`<script> window.location = "?url=home" </script>`); 

	 if(isset($_POST['notificacion'])) {
	 	$objModel->getNotificacion();
	 }

     if(isset($_POST['getPermisos'], $permiso['Consultar'])){
    	die(json_encode($permiso));
    }

	if(isset($_POST["clase"], $permiso['Registrar'])) {
		$objModel->getAgregarClase($_POST["clase"]);
	}

	if(isset($_POST["mostrar"], $_POST['bitacora'], $permiso['Consultar'])) {
		$objModel->mostrarClase();
	}

	if(isset($_POST["id"], $_POST["borrar"], $permiso['Eliminar'])){
		$objModel->getEliminar($_POST["id"]);
	}

	if(isset($_POST["idedit"], $_POST["item"], $permiso['Consultar'])){
		$objModel->getItem($_POST["idedit"]);
	}

	if(isset($_POST["claseEdit"], $_POST["idedit"], $permiso['Editar'])) {
		$objModel->getEditarClase($_POST["claseEdit"], $_POST["idedit"]);
	}

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral($permisos);


	if(file_exists("vista/interno/productos/claseVista.php")){
		require_once("vista/interno/productos/claseVista.php");
	}

?>