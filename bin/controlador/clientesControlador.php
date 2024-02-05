<?php

use component\initcomponents as initcomponents;
use component\header as header;
use component\menuLateral as menuLateral;
use modelo\clientes as clientes;

if (!isset($_SESSION['nivel'])) {
  die('<script> window.location = "?url=login" </script>');
}

$objModel = new clientes();
$permisos = $objModel->getPermisosRol($_SESSION['nivel']);
$permiso = $permisos['Clientes'];

if (!isset($permiso['Consultar']))
  die('<script> window.location = "?url=home" </script>');

if (isset($_POST['notificacion'])) {
  $objModel->getNotificacion();
}

if (isset($_POST['getPermisos']) && isset($permiso['Consultar'])) {
  die(json_encode($permiso));
}

if (isset($_POST['mostrar']) && isset($permiso['Consultar'])) {
  $res = $objModel->mostrarClientes($_POST['bitacora'] );
  die(json_encode($res));
}

if (isset($_GET['validar'])) {
  $res = $objModel->getValidarC($_GET['cedula'], $_GET['idVal']);
  die(json_encode($res));
}

if (isset($_GET['validarE'])) {
  $res = $objModel->getValidarE($_GET['correo'], $_GET['idVal']);
  die(json_encode($res));
}

if (isset($_POST['nomClien']) && isset($_POST['apeClien']) && isset($_POST['cedClien']) && isset($_POST['direcClien']) && isset($_POST['telClien']) && isset($_POST['emailClien']) && isset($permiso['Registrar'])) {
  $res = $objModel->getRegistrarClientes($_POST['nomClien'], $_POST['apeClien'], $_POST['cedClien'], $_POST['direcClien'], $_POST['telClien'], $_POST['emailClien']);
  die(json_encode($res));
}

if (isset($_POST['cedulaDel']) && isset($_POST['eliminar']) && isset($permiso['Eliminar'])) {
  $res = $objModel->eliminarClientes($_POST['cedulaDel']);
  die(json_encode($res));
}

if (isset($_POST['idCed']) && isset($_POST['unico']) && isset($permiso['Editar'])) {
  $res = $objModel->unicoCliente($_POST['idCed']);
  die(json_encode($res));
}

if (isset($_POST['nomEdit']) && isset($_POST['apeEdit']) && isset($_POST['cedEdit']) && isset($_POST['direcEdit']) && isset($_POST['celuEdit']) && isset($_POST['emailEdit']) && isset($_POST['idCed']) && isset($permiso['Editar'])) {
  $respuesta = $objModel->getEditar($_POST['nomEdit'], $_POST['apeEdit'], $_POST['cedEdit'], $_POST['direcEdit'], $_POST['celuEdit'], $_POST['emailEdit'], $_POST['idCed']);
  die(json_encode($respuesta));
}


$VarComp = new initcomponents();
$header = new header();
$menu = new menuLateral($permisos);

if (file_exists("vista/interno/clientesVista.php")) {
  require_once("vista/interno/clientesVista.php");
}

?>