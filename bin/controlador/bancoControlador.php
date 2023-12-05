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

    if(!isset($permiso['Consultar'])) die(`<script> window.location = "?url=home" </script>`);

    if(isset($_POST['notificacion'])) {
      $objModel->getNotificacion();
    }

    if(isset($_POST['getPermisos']) && $permiso['Consultar'] == 1){
      die(json_encode($permiso));
    }

     if (isset($_POST['mostrar']) && isset($_POST['bitacora'])) {
      ($_POST['bitacora'] == 'true')
      ? $objModel->mostrarBank(true)
      : $objModel->mostrarBank();
     }

      $datosBanco = $objModel->datosBanco();

     if (isset($_POST['selecTipoPago']) && $permiso['Consultar'] == 1) {
     	$objModel->selecTipoPago();
     }

     if(isset($_POST['id']) && isset($_POST['validar']) && $permiso['Consultar'] == 1){
      $objModel->validarTipoP($_POST['id']);
     }

     if(isset($_POST['tipoP']) && isset($_POST['tipo']) && isset($_POST['cedulaRif']) && isset($_POST['id']) &&  isset($_POST['validarD']) && $permiso['Consultar'] == 1 ){
      $objModel->ValidarDatos($_POST['tipoP'] , $_POST['tipo'] , $_POST['cedulaRif'] , $_POST['id']);
     }

     if (isset($_POST['data']) && isset($_POST['registro']) && $permiso['Registrar'] == 1) {
       $objModel->getRegistrarBanco($_POST['data']);
     }

     if (isset($_POST['validarC']) && isset($_POST['id']) && $permiso['Consultar'] == 1) {
       $objModel->validarSelect($_POST['id']);
     }

     if (isset($_POST['clickEdit']) && isset($_POST['id']) && $permiso['Consultar'] == 1) {
       $objModel->rellenarEdit($_POST['id']);
     }

     if (isset($_POST['data']) && isset($_POST['id']) && isset($_POST['editar']) && $permiso['Editar'] == 1) {
      $objModel->getEditarBanco($_POST['data'] , $_POST['id']);
     }

     if (isset($_POST['eliminar']) && isset($_POST['id']) && $permiso['Eliminar'] == 1) {
       $objModel->getEliminarBanco($_POST['id']);
     }


     $VarComp = new initcomponents();
     $header = new header();
     $menu = new menuLateral($permisos);

     if (file_exists("vista/interno/configuraciones/bancoVista.php")) {
       require_once("vista/interno/configuraciones/bancoVista.php");
     }else{
      die('La vista no existe.');
     }

 ?>