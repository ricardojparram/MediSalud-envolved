<?php  

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\sedeEnvio as sedeEnvio;

	if(!isset($_SESSION['nivel'])) die('<script> window.location = "?url=login" </script>');

	$model = new sedeEnvio();
	$permisos = $model->getPermisosRol($_SESSION['nivel']);
	$permiso = $permisos['Sedes de Envio'];

	if($permiso->status != 1) die('<script> window.location = "?url=home" </script>');

	if(isset($_POST['notificacion'])) {
    $objModel->getNotificacion();
  }

	$selectEmpresa = $model->selectEmpresas();

	if(isset($_POST['getPermisos']) && $permiso->status == 1){
		die(json_encode($permiso));
	}

	if(isset($_POST['mostrar'], $_POST['bitacora'])){
		($_POST['bitacora'] == 'true')
		? $model->mostrarSedes(true)
		: $model->mostrarSedes();
	}

	if(isset($_POST['validar'], $_POST['empresa'])){
		$validar = $model->validarEmpresa($_POST['empresa']);
		die(json_encode(['resultado' => $validar]));
	}

	if(isset($_POST['registrar'], $_POST['empresa'], $_POST['ubicacion'])  && $permiso->registrar == 1){
		$model->getRegistrarSede($_POST['empresa'], $_POST['ubicacion']);
	}

	if(isset($_POST['select'], $_POST['id']) && $permiso->editar == 1){
		$respuesta = $model->getSede($_POST['id']);
		die(json_encode($respuesta));
	}

	if(isset($_POST['editar'], $_POST['empresa'], $_POST['ubicacion'], $_POST['id'])  && $permiso->editar == 1){
		$model->getEditarSede($_POST['empresa'], $_POST['ubicacion'], $_POST['id']);
	}

	if(isset($_POST['eliminar'], $_POST['id']) && $permiso->eliminar == 1){
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