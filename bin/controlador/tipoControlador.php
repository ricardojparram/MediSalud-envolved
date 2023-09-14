<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\tipo as tipo;

	$objModel = new tipo();
    $permisos = $objModel->getPermisosRol($_SESSION['nivel']);
    $permiso = $permisos['Tipo'];


	if(isset($_POST["mostrar"]) && $permiso->status == 1){
		$objModel->getMostrarTipo();
	}

	if (isset($_POST["tipo"]) && $permiso->registrar == 1){
		$objModel->getAgregarTipo($_POST["tipo"]);

	}

if (isset($_POST["borrar"]) && isset($_POST["id"]) && $permiso->eliminar == 1 ){
	$objModel->getEliminarTipo($_POST["id"]);
}
 if (isset($_POST["editar"]) && isset($_POST["tipoedit"]) && $permiso->status == 1  ){
 	$objModel->mostrarlot($_POST["tipoedit"]);
 }
 if(isset($_POST["tipoEditar"]) && isset($_POST["tipoedit"]) && $permiso->editar ==1){
 	$objModel->getEditarTipo($_POST["tipoEditar"], $_POST["tipoedit"]);
 }

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral($permisos);


	if(file_exists("vista/interno/productos/tipoVista.php")){
		require_once("vista/interno/productos/tipoVista.php");
	}else{
		die('La vista no existe.');
	}

?>