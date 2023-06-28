<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\usuarios as usuarios;

	$objModel = new usuarios();
	$mostrarN = $objModel->mostrarNivel();

	if(isset($_SESSION['nivel'])){
		if($_SESSION['nivel'] != 1){
			die('<script> window.location = "?url=home" </script>');
		}
	}else{
		die('<script> window.location = "?url=login" </script>');
	}

	if(isset($_GET['cedula']) && isset($_GET['validar'])){
		$objModel->getValidarC($_GET['cedula']);
	}

	if(isset($_GET['email']) && isset($_GET['validar'])){
		$objModel->getValidarE($_GET['email']);
	}

	if(isset($_POST['mostrar'])){
		$objModel->getMostrarUsuario();
	}

	if(isset($_POST['cedula']) && isset($_POST['name'])&& isset($_POST['apellido'])&& isset($_POST['email'])  && isset($_POST['password']) && isset($_POST['tipoUsuario']) ){
		$objModel->getAgregarUsuario($_POST['cedula'] , $_POST['name'], $_POST['apellido'], $_POST['email'], $_POST['password'], $_POST['tipoUsuario']);
	}

	if(isset($_POST['eliminar']) && isset($_POST['cedulaDel'])){
		$objModel->getEliminar($_POST['cedulaDel']);
	}

	if(isset($_POST['select']) && isset($_POST['id'])){
		$objModel->getUnico($_POST['id']);
	}

	if(isset($_POST['cedulaEdit']) && isset($_POST['nameEdit']) && isset($_POST['apellidoEdit']) && isset($_POST['emailEdit']) && isset($_POST['passwordEdit']) && isset($_POST['tipoUsuarioEdit']) && isset($_POST['id'])){

		$objModel->getEditar($_POST['cedulaEdit'] , $_POST['nameEdit'], $_POST['apellidoEdit'], $_POST['emailEdit'], $_POST['passwordEdit'], $_POST['tipoUsuarioEdit'], $_POST['id']);
	}

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral();

	if(file_exists("vista/interno/usuarioVista.php")){
		require_once("vista/interno/usuarioVista.php");
	}

?>