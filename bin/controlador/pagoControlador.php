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

  $VarComp = new initcomponents();
  $Nav = new nav();

  require_once("vista/inicio/pagoVista.php");

?>