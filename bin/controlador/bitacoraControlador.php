<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\bitacora as bitacora;

	if(isset($_SESSION['nivel'])){
		if($_SESSION['nivel'] != 1){
			die('<script> window.location = "?url=home" </script>');
		}
	}else{
		die('<script> window.location = "?url=login" </script>');
	}

	$objModel = new bitacora();

	if(isset($_POST['mostrar'])){
		$objModel->mostrarBitacora();
	}

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral();

	if(file_exists("vista/interno/bitacoraVista.php")){
		require_once("vista/interno/bitacoraVista.php");
	}

?>