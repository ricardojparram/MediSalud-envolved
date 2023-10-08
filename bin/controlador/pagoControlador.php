<?php

  use component\initcomponents as initcomponents;
  use component\nav as nav;
  use modelo\pago as pago;
  
  $objModel = new pago();
  
  if(!isset($_SESSION['cedula'])){
    die('<script>window.location = "?url=login" </script>');
  }

  if (isset($_POST['datos']) && isset($_SESSION['cedula'])) {
    $objModel->mostrarDatosP($_SESSION['cedula']);
  }

  if (isset($_POST['mostrarT']) && isset($_POST['tipo'])) {
    $objModel->tipoP($_POST['tipo']);
  }

  if (isset($_POST['mostrarP']) && isset($_SESSION['cedula'])) {
    $objModel->mostrarPrecio($_SESSION['cedula']);
  }

  if (isset($_POST['mostrarE'])) {
    $objModel->mostrarEmpresa();
  }

  if (isset($_POST['mostrarS']) && isset($_POST['nomEmpre'])) {
    $objModel->mostrarSede($_POST['nomEmpre']);
  }

  $VarComp = new initcomponents();
  $Nav = new nav();

  require_once("vista/inicio/pagoVista.php");

?>