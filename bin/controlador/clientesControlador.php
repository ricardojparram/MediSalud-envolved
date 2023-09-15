<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\clientes as clientes;


  $objModel = new clientes();
  $permisos = $objModel->getPermisosRol($_SESSION['nivel']);
  $permiso = $permisos['Clientes'];


  if($permiso->status != 1) die('<script> window.location = "?url=home" </script>');

  if(isset($_POST['getPermisos']) && $permiso->status == 1){
    die(json_encode($permiso));
  }


  if(!isset($_SESSION['nivel'])){
    die('<script> window.location = "?url=login" </script>');
  }

  if(isset($_POST['mostrar']) && $permiso->consultar == 1){
    ($_POST['bitacora'] == 'true')
    ? $objModel->mostrarClientes(true)
    : $objModel->mostrarClientes();
  }

  if(isset($_GET['cedula']) && isset($_GET['validar'])){
      $objModel->getValidarC($_GET['cedula']);
    }

  if(isset($_POST['nomClien']) && isset($_POST['apeClien'])&& isset($_POST['cedClien'])&& isset($_POST['direcClien']) && isset($_POST['telClien']) && isset($_POST['emailClien']) && $permiso->registrar == 1){
    $objModel->getRegistrarClientes($_POST['nomClien'],$_POST['apeClien'],$_POST['cedClien'],$_POST['direcClien'],$_POST['telClien'],$_POST['emailClien']);
  }

  if (isset($_POST['cedulaDel']) && isset($_POST['eliminar']) && $permiso->eliminar == 1) {
    $respuestaDel = $objModel->eliminarClientes($_POST['cedulaDel']);
  }

  if (isset($_POST['id']) && isset($_POST['unico']) && $permiso->editar == 1) {
    $objModel->unicoCliente($_POST['id']);
  }

  if(isset($_POST['nomEdit']) && isset($_POST['apeEdit'])&& isset($_POST['cedEdit'])&& isset($_POST['direcEdit']) && isset($_POST['celuEdit']) && isset($_POST['emailEdit']) && isset($_POST['id']) && $permiso->editar == 1){
    $respuesta = $objModel->getEditar($_POST['nomEdit'],$_POST['apeEdit'],$_POST['cedEdit'],$_POST['direcEdit'],$_POST['celuEdit'],$_POST['emailEdit'],$_POST['id']);
  }


   $VarComp = new initcomponents();
   $header = new header();
   $menu = new menuLateral($permisos);

  if(file_exists("vista/interno/clientesVista.php")){
    require_once("vista/interno/clientesVista.php");
  }

?>