<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\laboratorio as laboratorio;

  $objModel = new laboratorio();

  if(isset($_SESSION['nivel'])){
    if($_SESSION['nivel'] != 1 && $_SESSION['nivel'] != 2){
      die('<script> window.location = "?url=home" </script>');
    }
  }else{
    die('<script> window.location = "?url=login" </script>');
  }
  

  if(isset($_POST['mostrar'])){
    $objModel->mostrarLaboratoriosAjax();
  }

  if(isset($_POST['rif']) && isset($_POST['direccion']) && isset($_POST['razon']) && isset($_POST['telefono'])&& isset($_POST['contacto'])){

    $respuesta = $objModel->getDatosLab($_POST['rif'], $_POST['direccion'], $_POST['razon'], $_POST['telefono'], $_POST['contacto']);

  }

  if(isset($_POST['select'])){
    $objModel->getItem($_POST['id']);
  }

  if(isset($_POST['rifEdit']) && isset($_POST['direccionEdit']) && isset($_POST['razonEdit']) && isset($_POST['telefonoEdit'])&& isset($_POST['contactoEdit']) && isset($_POST['id'])){

    $respuesta = $objModel->getEditar($_POST['rifEdit'], $_POST['direccionEdit'], $_POST['razonEdit'], $_POST['telefonoEdit'], $_POST['contactoEdit'], $_POST['id']);

  }

  if(isset($_POST['eliminar'])){
    $objModel->getEliminar($_POST['id']);
  }

  if(isset($_POST['rif']) && isset($_POST['validar'])){
    $objModel->getRif($_POST['rif']);
  }
  


  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();

  if(file_exists("vista/interno/productos/laboratorioVista.php")){
    require_once("vista/interno/productos/laboratorioVista.php");
  }else{
    die("La vista no existe.");
  }
  
?>