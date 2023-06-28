<?php

  use component\initcomponents as initcomponents;
  use modelo\login as login;
  
  $objModel = new login();

  
  if(isset($_SESSION['cedula'])){
    die('<script>window.location = "?url=home" </script>');
  }

  if(isset($_GET['cedula']) && isset($_GET['validar'])){
  	$objModel->getValidarC($_GET['cedula']);
  }


  if(isset($_POST['cedula']) && isset($_POST['password'])  && isset($_POST['a'])){
   
   $objModel->getLoginSistema($_POST['cedula'], $_POST['password']);

  }

  $VarComp = new initcomponents();

  require_once("vista/sesion/loginVista.php");

?>