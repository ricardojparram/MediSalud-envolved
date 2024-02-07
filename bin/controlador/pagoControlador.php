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
    $res = $objModel->comprobarTiempoDePago($cedula);
  }

  if (isset($_POST['datos']) && isset($_SESSION['cedula'])) {
    $res = $objModel->mostrarDatosP($_SESSION['cedula']);
    die(json_encode($res));
  }

  if (isset($_POST['selectTipo'])) {
    $res = $objModel->getMostrarMetodo();
    die(json_encode($res));
  }

  if (isset($_POST['mostrarT']) && isset($_POST['tipo'])) {
    $res = $objModel->tipoP($_POST['tipo']);
    die(json_encode($res));
  }

  if (isset($_POST['mostrarP']) && isset($_SESSION['cedula'])) {
    $res = $objModel->mostrarPrecio($_SESSION['cedula']);
    die(json_encode($res));
  }

  if (isset($_POST['mostrarE'])) {
    $res = $objModel->mostrarEstados();
    die(json_encode($res));
  }

  if (isset($_POST['mostrarS']) && isset($_POST['nomEstado'])) {
    $res = $objModel->mostrarSede($_POST['nomEstado']);
    die(json_encode($res));
  }

  if (isset($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccionF'], $_POST['telefono'], $_POST['correo'], $_POST['sede'], $_POST['direccionE'], $_POST['detalles'])) {
    $res = $objModel->getRegistar($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST["direccionF"], $_POST['telefono'], $_POST['correo'], $_POST['sede'], $_POST['direccionE'], $_POST['detalles']);
    die(json_encode($res));
  }

  if (isset($_POST['mostrarB'])){
    $res = $objModel->banco();
    die(json_encode($res));
  }

  if (isset($_POST['calculaT'])){
    $res = $objModel->calcularTipo($_SESSION['cedula']);
    die(json_encode($res));
  }

  if (isset($_POST['tiempo'])){
    $res = $objModel->temporizador($_SESSION['cedula']);
    die(json_encode($res));
  }

  if (isset($_POST['eliminar'])) {
    $res = $objModel->getEliminar($_SESSION['cedula'], $_POST['eliminar']);
    die(json_encode($res));
  }
  
  $VarComp = new initcomponents();
  $tiendaComp = new tienda();
  
  require_once("vista/inicio/pagoVista.php");
  
?>