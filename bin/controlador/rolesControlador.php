<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\roles as roles;

	$model = new roles();
		// $model->mostrarRoles();

	if(isset($_POST['mostrar'])){
		$model->mostrarRoles();
	}

	if(isset($_POST['modulos'], $_POST['id'])){
		$model->getModulo($_POST['id']);
	}

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral();

	if(file_exists("vista/interno/rolesVista.php")){
		require_once("vista/interno/rolesVista.php");
	}else{
		die("La vista no existe.");
	}

?>