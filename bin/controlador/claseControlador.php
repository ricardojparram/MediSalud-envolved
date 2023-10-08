<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\clase as clase;

	$objModel = new clase();
	$permisos = $objModel->getPermisosRol($_SESSION['nivel']);
	$permiso = $permisos['Clase'];



	if(isset($_POST["clase"]) && $permiso->registrar == 1) {
		$objModel->getAgregarClase($_POST["clase"]);
	}

	if(isset($_POST["mostrar"]) && $permiso->status == 1) {
		$objModel->mostrarClase();
	}

	if(isset($_POST["id"]) && isset($_POST["borrar"]) && $permiso->eliminar == 1){
		$objModel->getEliminar($_POST["id"]);
	}

	if(isset($_POST["idedit"]) && isset($_POST["item"]) && $permiso->status == 1){
		$objModel->getItem($_POST["idedit"]);
	}

	if(isset($_POST["claseEdit"]) && isset($_POST["idedit"]) && $permiso->editar == 1) {
		$objModel->getEditarClase($_POST["claseEdit"], $_POST["idedit"]);
	}

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral($permisos);


	if(file_exists("vista/interno/productos/claseVista.php")){
		require_once("vista/interno/productos/claseVista.php");
	}

?>