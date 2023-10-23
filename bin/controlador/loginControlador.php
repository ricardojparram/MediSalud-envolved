<?php

  use component\initcomponents as initcomponents;
  use modelo\login as login;
  use component\tienda as tienda;

  $objModel = new login();

  if(isset($_SESSION['nivel'])){
    die('<script>window.location = "?url=inicio" </script>');
  }

  if(isset($_GET['cedula'], $_GET['validar'])){
    $objModel->getValidarCedula($_GET['cedula']);
  }


  if(isset($_POST['cedula'], $_POST['password'], $_POST['login'])){

   $objModel->getLoginSistema($_POST['cedula'], $_POST['password']);

  }

  $VarComp = new initcomponents();
  $Nav = new tienda();

  require_once("vista/sesion/loginVista.php");

?>