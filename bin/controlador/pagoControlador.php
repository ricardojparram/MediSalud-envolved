<?php

  use component\initcomponents as initcomponents;
  use component\tienda as tienda;
  use modelo\pago as pago;
  
  $objModel = new pago();

  
  if(!isset($_SESSION['cedula'])){
    die('<script>window.location = "?url=login" </script>');
  }
  
  if (isset($_POST['datosCar'])){
    $objModel->getDatosCar($_SESSION['cedula']);
  }

  if (isset($_POST['datos']) && isset($_SESSION['cedula'])) {
    $objModel->mostrarDatosP($_SESSION['cedula']);
  }

  if (isset($_POST['selectTipo'])) {
    $objModel->getMostrarMetodo();
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

  if (isset($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['correo'], $_POST['sede'], $_POST['direccion'], $_POST['detalles'])) {
    $objModel->getRegistar($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['correo'], $_POST['sede'], $_POST['direccion'], $_POST['detalles']);
  }

  if (isset($_POST['mostrarB'])){
    $objModel->banco();
  }

  if (isset($_POST['carrito'], $_SESSION['cedula'])){
    $objModel->validarCarrito($_SESSION['cedula']);
  }

  
  $VarComp = new initcomponents();
  $tiendaComp = new tienda();
  
  require_once("vista/inicio/pagoVista.php");
  
  //$objModel->conexion();
?>