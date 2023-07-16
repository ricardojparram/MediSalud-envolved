<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\clientes as clientes;


  $objModel = new clientes();

  if(!isset($_SESSION['nivel'])){
    die('<script> window.location = "?url=login" </script>');
  }

  if(isset($_POST['mostrar']) && isset($_SESSION['cedula'])){
    $objModel->mostrarClientes($_SESSION['cedula']);
  }

  if(isset($_GET['cedula']) && isset($_GET['validar'])){
      $objModel->getValidarC($_GET['cedula']);
    }

  if(isset($_POST['nomClien']) && isset($_POST['apeClien'])&& isset($_POST['cedClien'])&& isset($_POST['direcClien']) && isset($_POST['telClien']) && isset($_POST['emailClien']) && isset($_SESSION['cedula'])){
    
    $respuesta = $objModel->getRegistrarClientes($_POST['nomClien'],$_POST['apeClien'],$_POST['cedClien'],$_POST['direcClien'],$_POST['telClien'],$_POST['emailClien'],$_SESSION['cedula']);
  }

  if (isset($_POST['cedulaDel']) && isset($_POST['eliminar']) && isset($_SESSION['cedula'])) {
    $respuestaDel = $objModel->eliminarClientes($_POST['cedulaDel'], $_SESSION['cedula']);
  }

  if (isset($_POST['id']) && isset($_POST['unico'])) {
    $objModel->unicoCliente($_POST['id']);
  }

  if(isset($_POST['nomEdit']) && isset($_POST['apeEdit'])&& isset($_POST['cedEdit'])&& isset($_POST['direcEdit']) && isset($_POST['celuEdit']) && isset($_POST['emailEdit']) && isset($_POST['id']) && isset($_SESSION['cedula'])){

    
    $respuesta = $objModel->getEditar($_POST['nomEdit'],$_POST['apeEdit'],$_POST['cedEdit'],$_POST['direcEdit'],$_POST['celuEdit'],$_POST['emailEdit'],$_POST['id'],$_SESSION['cedula']);
  }


   $VarComp = new initcomponents();
   $header = new header();
   $menu = new menuLateral();

  if(file_exists("vista/interno/clientesVista.php")){
    require_once("vista/interno/clientesVista.php");
  }

?>