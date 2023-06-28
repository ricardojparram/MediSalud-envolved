<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\tipo as tipo;

	$objModel = new tipo();

	if(isset($_POST["mostrar"])){
		$objModel->getMostrarTipo();
	}

	if (isset($_POST["tipo"])){
		$objModel->getAgregarTipo($_POST["tipo"]);

	}

	if (isset($_POST["tipo"])){
		$objModel->getAgregarTipo($_POST["tipo"]);

	}
if (isset($_POST["borrar"]) && isset($_POST["id"])){
	$objModel->getEliminarTipo($_POST["id"]);
}
 if (isset($_POST["editar"]) && isset($_POST["tipoedit"])){
 	$objModel->mostrarlot($_POST["tipoedit"]);
 }
 if(isset($_POST["tipoEditar"]) && isset($_POST["tipoedit"])){
 	$objModel->getEditarTipo($_POST["tipoEditar"], $_POST["tipoedit"]);
 }

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral();


	if(file_exists("vista/interno/productos/tipoVista.php")){
		require_once("vista/interno/productos/tipoVista.php");
	}else{
		die('La vista no existe.');
	}

?>