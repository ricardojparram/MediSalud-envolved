<?php 

	 use component\initcomponents as initcomponents;
	 use component\header as header;
	 use component\menuLateral as menuLateral;
	 use modelo\banco as banco;

	 if(isset($_SESSION['nivel'])) {
	 	if ($_SESSION['nivel'] != 1) {
	 		die('<script> window.location = "?url=home" </script>');
	 	}
	 }else{
          die('<script> window.location = "?url=login" </script>');
	 }

     $objModel = new banco();

     if (isset($_POST['mostrar'])) {
      $objModel->mostrarBank();
     }

     if (isset($_POST['selecTipoPago'])) {
     	$objModel->selecTipoPago();
     }

     $VarComp = new initcomponents();
     $header = new header();
     $menu = new menuLateral();

     if (file_exists("vista/interno/configuraciones/bancoVista.php")) {
       require_once("vista/interno/configuraciones/bancoVista.php");
     }

 ?>