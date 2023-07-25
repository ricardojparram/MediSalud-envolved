<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\laboratorio as laboratorio;

  if(!isset($_SESSION['nivel'])) die('<script> window.location = "?url=login" </script>');

  $objModel = new laboratorio();
  $permisos = $objModel->getPermisosRol($_SESSION['nivel']);
  $permiso = $permisos['Laboratorio'];

  if($permiso->status != 1) die('<script> window.location = "?url=home" </script>');

  if(isset($_POST['getPermisos']) && $permiso->status == 1){
    die(json_encode($permiso));
  }

  if(isset($_POST['mostrar']) && $permiso->consultar == 1){
    ($_POST['bitacora'] == 'true')
      ? $objModel->mostrarLaboratoriosAjax(true)
      : $objModel->mostrarLaboratoriosAjax();
  }

  if(isset($_POST['rif'], $_POST['direccion'], $_POST['razon'], $_POST['telefono'], $_POST['contacto']) && $permiso->registrar == 1){

    $objModel->getDatosLab($_POST['rif'], $_POST['direccion'], $_POST['razon'], $_POST['telefono'], $_POST['contacto']);

  }

  if(isset($_POST['select']) && $permiso->editar == 1){
    $objModel->getItem($_POST['id']);
  }

  if(isset($_POST['rifEdit'], $_POST['direccionEdit'], $_POST['razonEdit'], $_POST['telefonoEdit'], $_POST['contactoEdit'], $_POST['id']) && $permiso->editar == 1){

    $objModel->getEditar($_POST['rifEdit'], $_POST['direccionEdit'], $_POST['razonEdit'], $_POST['telefonoEdit'], $_POST['contactoEdit'], $_POST['id']);

  }

  if(isset($_POST['eliminar']) && $permiso->eliminar == 1){
    $objModel->getEliminar($_POST['id']);
  }

  if(isset($_POST['rif'], $_POST['validar'])){
    $objModel->getRif($_POST['rif']);
  }
  


  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral($permisos);

  if(file_exists("vista/interno/productos/laboratorioVista.php")){
    require_once("vista/interno/productos/laboratorioVista.php");
  }else{
    die("La vista no existe.");
  }
  
?>