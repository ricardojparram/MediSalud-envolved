<?php 

	 use component\initcomponents as initcomponents;
	 use component\header as header;
	 use component\menuLateral as menuLateral;
	 use modelo\banco as banco;

	 if(isset($_SESSION['nivel'])) {
	 	if ($_SESSION['nivel'] != 1 && $_SESSION['nivel'] != 2) {
	 		die('<script> window.location = "?url=home" </script>');
	 	}
	 }else{
          die('<script> window.location = "?url=login" </script>');
	 }

    $objModel = new banco();
    $permisos = $objModel->getPermisosRol($_SESSION['nivel']);
    $permiso = $permisos['Bancos'];

    if($permiso->status != 1) die(`<script> window.location = "?url=home" </script>`);

     if (isset($_POST['mostrar']) && $permiso->consultar == 1) {
      $objModel->mostrarBank();
     }

     if (isset($_POST['selecTipoPago']) && $permiso->status == 1) {
     	$objModel->selecTipoPago();
     }

     if(isset($_POST['id']) && isset($_POST['validar']) && $permiso->status == 1){
      $objModel->validarTipoP($_POST['id']);
     }

     if(isset($_POST['tipoP']) && isset($_POST['nombre']) && isset($_POST['cedulaRif']) && isset($_POST['validar']) && $permiso->status == 1 ){
      $objModel->ValidarDatos($_POST['tipoP'] , $_POST['nombre'] , $_POST['cedulaRif']);
     }

     if (isset($_POST['data']) && isset($_POST['registro']) && $permiso->status == 1) {
       $objModel->getRegistrarBanco($_POST['data']);
     }

     if (isset($_POST['validar']) && isset($_POST['id']) && $permiso->status == 1) {
       $objModel->validarSelect($_POST['id']);
     }

     $VarComp = new initcomponents();
     $header = new header();
     $menu = new menuLateral($permisos);

     if (file_exists("vista/interno/configuraciones/bancoVista.php")) {
       require_once("vista/interno/configuraciones/bancoVista.php");
     }

 ?>