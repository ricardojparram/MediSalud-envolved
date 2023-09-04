<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\roles as roles;

	if(!isset($_SESSION['nivel'])) die('<script> window.location = "?url=login" </script>');

	$model = new roles();
	$permisos = $model->getPermisosRol($_SESSION['nivel']);

	if($permisos['Roles']->status != 1) die('<script> window.location = "?url=home" </script>');

	if(isset($_POST['getPermisos']) && $permisos['Roles']->status == 1){
		die(json_encode($permisos['Roles']));
	}

	if(isset($_POST['mostrar']) && $permisos['Roles']->consultar == 1){
		$model->mostrarRoles();
	}

	if(isset($_POST['modulos'], $_POST['id']) && $permisos['Roles']->editar == 1){
		$model->getModulo($_POST['id']);
	}

	if(isset($_POST['datos_modulos'], $_POST['id']) && $permisos['Roles']->editar == 1){
		$model->getAccesoModulos($_POST['datos_modulos'], $_POST['id']);
	}

	if(isset($_POST['permisos'], $_POST['id']) && $permisos['Roles']->editar == 1){
		$model->getPermisos($_POST['id']);
	}

	if(isset($_POST['datos_permisos'], $_POST['id']) && $permisos['Roles']->editar == 1){
		$model->getDatosPermisos($_POST['datos_permisos'], $_POST['id']);
	}

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral($permisos);

	if(file_exists("vista/interno/rolesVista.php")){
		require_once("vista/interno/rolesVista.php");
	}else{
		die("La vista no existe.");
	}

?>