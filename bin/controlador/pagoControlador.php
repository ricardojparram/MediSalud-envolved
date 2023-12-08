<?php

  use component\initcomponents as initcomponents;
  use component\tienda as tienda;
  use modelo\pago as pago;
  
  $objModel = new pago();

  if(!isset($_SESSION['cedula'])){
    die('<script>window.location = "?url=login" </script>');
  }
  
  $objModel->getComprobarEstadoPago($_SESSION['cedula']);

  if(isset($_POST['comprobarLimitePago'], $_POST['url_param'])){
    $cedula = ($_POST['url_param'] === "pago") ? $_SESSION['cedula'] : NULL;
    $objModel->comprobarTiempoDePago($cedula);
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
    $objModel->mostrarEstados();
  }

  if (isset($_POST['mostrarS']) && isset($_POST['nomEstado'])) {
    $objModel->mostrarSede($_POST['nomEstado']);
  }

  if (isset($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['correo'], $_POST['sede'], $_POST['direccion'], $_POST['detalles'])) {
<<<<<<< HEAD
    $objModel->getRegistar($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['correo'], $_POST['sede'], $_POST['direccion'], $_POST['detalles']);
=======
    $objModel->nunca($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['correo'], $_POST['sede'], $_POST['direccion'], $_POST['detalles']);
>>>>>>> 47b90ecf60cdca7963cf419a73a4de5ff8a78247
  }

  if (isset($_POST['mostrarB'])){
    $objModel->banco();
  }
<<<<<<< HEAD
  
  $VarComp = new initcomponents();
  $tiendaComp = new tienda();
  
=======

  $VarComp = new initcomponents();
  $tiendaComp = new tienda();

>>>>>>> 47b90ecf60cdca7963cf419a73a4de5ff8a78247
  require_once("vista/inicio/pagoVista.php");
  
?>