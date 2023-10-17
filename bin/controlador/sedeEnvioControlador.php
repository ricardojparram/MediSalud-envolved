<?php  

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\sedeEnvio as sedeEnvio;

	if(!isset($_SESSION['nivel'])) die('<script> window.location = "?url=login" </script>');

	$model = new sedeEnvio();
	$permisos = $model->getPermisosRol($_SESSION['nivel']);
	$permiso = $permisos['Sedes de Envio'];

	if(!isset($permiso["Consultar"])) die('<script> window.location = "?url=home" </script>');

	$selectEmpresa = $model->selectEmpresas();

	if(isset($_POST['getPermisos'], $permiso['Consultar'])){
		die(json_encode($permiso));
	}

	if(isset($_POST['mostrar'], $_POST['bitacora'])){
		$model->mostrarSedes($_POST['bitacora']);
	}

	if(isset($_POST['validar'], $_POST['empresa'], $permiso['Consultar'])){
		$validar = $model->validarEmpresa($_POST['empresa']);
		die(json_encode(['resultado' => $validar]));
	}

	if(isset($_POST['registrar'], $_POST['empresa'], $_POST['ubicacion'], $permiso['Registrar'])){
		$model->getRegistrarSede($_POST['empresa'], $_POST['ubicacion']);
	}

	if(isset($_POST['select'], $_POST['id'], $permiso['Editar'])){
		$respuesta = $model->getSede($_POST['id']);
		die(json_encode($respuesta));
	}

	if(isset($_POST['editar'], $_POST['empresa'], $_POST['ubicacion'], $_POST['id'], $permiso['Editar'])){
		$model->getEditarSede($_POST['empresa'], $_POST['ubicacion'], $_POST['id']);
	}

	if(isset($_POST['eliminar'], $_POST['id'], $permiso['Eliminar'])){
		$model->getEliminarSede($_POST['id']);
	}

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral($permisos);


	if(file_exists('vista/interno/sedeEnvioVista.php')){
		require_once('vista/interno/sedeEnvioVista.php');
	}else {
		die("La vista no existe.");
	}

?>