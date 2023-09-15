<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\moneda as moneda;
  
  $objModel = new moneda();
  $permisos = $objModel->getPermisosRol($_SESSION['nivel']);
  $permiso = $permisos['Moneda'];

  if(!isset($_SESSION['nivel'])){
    die('<script> window.location = "?url=login" </script>');
  }

  if($permiso->status != 1) die('<script> window.location = "?url=home" </script>');

  if(isset($_POST['getPermisos']) && $permiso->status == 1){
    die(json_encode($permiso));
  }
  
  if (isset($_POST['datos']) && $permiso->consultar == 1) {
    ($_POST['bitacora'] == 'true')
      ? $objModel->getMoneda(true)
      : $objModel->getMoneda();
  }

  if (isset($_POST['moneda']) && isset($_POST['name']) && $permiso->registrar == 1 ) {
    $objModel->getAgregarMoneda($_POST['name']);
  }

  if (isset($_POST['edit']) && isset($_POST['id']) && $permiso->editar == 1) {
     $objModel->mostrarM($_POST['id']);
  }

  if (isset($_POST['nameEdit']) && $_POST['id'] && $permiso->editar == 1) {
    $objModel->getEditarM($_POST['nameEdit'], $_POST['id']);
  }

  if (isset($_POST['delete']) && isset($_POST['id']) && $permiso->eliminar == 1) {
    $objModel->getEliminarM($_POST['id']);
  }

  if (isset($_POST["mostrar"]) && $permiso->consultar == 1) {
    $objModel->getMostrarCambio();
  }

  if (isset($_POST['select'])) {
    $objModel->SelectM();
  }

  if(isset($_POST["cambio"]) && isset($_POST["tipo"]) && $permiso->registrar == 1) {

    $objModel->getAgregarCambio($_POST["cambio"], $_POST["tipo"]);  
  } 



  if (isset($_POST["borrar"]) && isset($_POST["id"]) && $permiso->eliminar == 1) {
    $objModel->getEliminarCambio($_POST["id"]);
  }

  if (isset($_POST["unico"]) && isset($_POST["editar"]) && $permiso->editar == 1) {

    
    $objModel->mostrarUnico($_POST["unico"]);
  }

   if(isset($_POST["cambioEdit"]) && isset($_POST["tipoEdit"]) && isset($_POST["unico"]) && $permiso->editar == 1) {

    $objModel->getEditarCambio($_POST["cambioEdit"], $_POST["tipoEdit"], $_POST["unico"]);  
  } 










  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral($permisos);

  if(file_exists("vista/interno/configuraciones/monedaVista.php")){
    require_once("vista/interno/configuraciones/monedaVista.php");
  }


?>