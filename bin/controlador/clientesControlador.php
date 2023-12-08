<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\clientes as clientes;

  if(!isset($_SESSION['nivel'])){
    die('<script> window.location = "?url=login" </script>');
  }

  $objModel = new clientes();
  $permisos = $objModel->getPermisosRol($_SESSION['nivel']);
  $permiso = $permisos['Clientes'];

  if(!isset($permiso['Consultar'])) die('<script> window.location = "?url=home" </script>');

  if(isset($_POST['notificacion'])) {
    $objModel->getNotificacion();
  }

  if(isset($_POST['getPermisos']) && isset($permiso['Consultar'])){
    die(json_encode($permiso));
  }

  if(isset($_POST['mostrar']) && isset($permiso['Consultar'])){
    ($_POST['bitacora'] == 'true')
    ? $objModel->mostrarClientes(true)
    : $objModel->mostrarClientes();
  }

  if(isset($_GET['cedula']) && isset($_GET['validar'])){
      $objModel->getValidarC($_GET['cedula']);
    }

  if(isset($_POST['nomClien']) && isset($_POST['apeClien'])&& isset($_POST['cedClien'])&& isset($_POST['direcClien']) && isset($_POST['telClien']) && isset($_POST['emailClien']) && isset($permiso['Registrar'])){
    $objModel->getRegistrarClientes($_POST['nomClien'],$_POST['apeClien'],$_POST['cedClien'],$_POST['direcClien'],$_POST['telClien'],$_POST['emailClien']);
  }

  if (isset($_POST['cedulaDel']) && isset($_POST['eliminar']) && isset($permiso['Eliminar'])) {
    $respuestaDel = $objModel->eliminarClientes($_POST['cedulaDel']);
  }

  if (isset($_POST['id']) && isset($_POST['unico']) && isset($permiso['Editar'])) {
    $objModel->unicoCliente($_POST['id']);
  }

  if(isset($_POST['nomEdit']) && isset($_POST['apeEdit'])&& isset($_POST['cedEdit'])&& isset($_POST['direcEdit']) && isset($_POST['celuEdit']) && isset($_POST['emailEdit']) && isset($_POST['id']) && isset($permiso['Editar'])){
    $respuesta = $objModel->getEditar($_POST['nomEdit'],$_POST['apeEdit'],$_POST['cedEdit'],$_POST['direcEdit'],$_POST['celuEdit'],$_POST['emailEdit'],$_POST['id']);
  }


   $VarComp = new initcomponents();
   $header = new header();
   $menu = new menuLateral($permisos);

  if(file_exists("vista/interno/clientesVista.php")){
    require_once("vista/interno/clientesVista.php");
  }

?>