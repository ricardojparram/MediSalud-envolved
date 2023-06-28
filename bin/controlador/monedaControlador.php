<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\moneda as moneda;
  
  $objModel = new moneda();

  if(isset($_SESSION['nivel'])){
    if($_SESSION['nivel'] != 1 && $_SESSION['nivel'] != 2){
      die('<script> window.location = "?url=home" </script>');
    }
  }else{
    die('<script> window.location = "?url=login" </script>');
  }
  
  if (isset($_POST['datos'])) {
    $objModel->getMoneda();
  }

  if (isset($_POST['moneda']) && isset($_POST['name']) ) {
    $objModel->getAgregarMoneda($_POST['name']);
  }

  if (isset($_POST['edit']) && isset($_POST['id'])) {
     $objModel->mostrarM($_POST['id']);
  }

  if (isset($_POST['nameEdit']) && $_POST['id']) {
    $objModel->getEditarM($_POST['nameEdit'], $_POST['id']);
  }

  if (isset($_POST['delete']) && isset($_POST['id'])) {
    $objModel->getEliminarM($_POST['id']);
  }

  if (isset($_POST["mostrar"])) {
    $objModel->getMostrarCambio();
  }

  if (isset($_POST['select'])) {
    $objModel->SelectM();
  }

  if(isset($_POST["cambio"]) && isset($_POST["tipo"])) {

    $objModel->getAgregarCambio($_POST["cambio"], $_POST["tipo"]);  
  } 



  if (isset($_POST["borrar"]) && isset($_POST["id"])) {
    $objModel->getEliminarCambio($_POST["id"]);
  }

  if (isset($_POST["unico"]) && isset($_POST["editar"])) {

    
    $objModel->mostrarUnico($_POST["unico"]);
  }

   if(isset($_POST["cambioEdit"]) && isset($_POST["tipoEdit"]) && isset($_POST["unico"])) {

    $objModel->getEditarCambio($_POST["cambioEdit"], $_POST["tipoEdit"], $_POST["unico"]);  
  } 










  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();

  if(file_exists("vista/interno/configuraciones/monedaVista.php")){
    require_once("vista/interno/configuraciones/monedaVista.php");
  }


?>