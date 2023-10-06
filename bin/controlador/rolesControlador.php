<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\roles as roles;

	if(!isset($_SESSION['nivel'])) die('<script> window.location = "?url=login" </script>');

	$model = new roles();
	$permisos = $model->getPermisosRol($_SESSION['nivel']);
	$permiso = $permisos['Roles'];

	if(!isset($permiso['Consultar'])) die('<script> window.location = "?url=home" </script>');

	if(isset($_POST['getPermisos'], $permiso['Consultar'])){
		die(json_encode($permisos['Roles']));
	}

	if(isset($_POST['mostrar'], $permiso['Consultar'])){
		$model->mostrarRoles();
	}

	if(isset($_POST['modulos'], $_POST['id'],$permiso['Modificar acceso'])){
		$model->getModulo($_POST['id']);
	}

	if(isset($_POST['datos_modulos'], $_POST['id'], $permiso['Modificar acceso'])){
		$model->getAccesoModulos($_POST['datos_modulos'], $_POST['id']);
	}

	if(isset($_POST['permisos'], $_POST['id'], $permiso['Modificar acciones'])){
		$model->getPermisos($_POST['id']);
	}

	if(isset($_POST['datos_permisos'], $_POST['id'], $permiso['Modificar acciones'])){
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