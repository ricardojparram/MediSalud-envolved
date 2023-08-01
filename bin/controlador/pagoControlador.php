<?php

  use component\initcomponents as initcomponents;
  use component\nav as nav;
  

  
  if(!isset($_SESSION['cedula'])){
    die('<script>window.location = "?url=login" </script>');
  }

  $VarComp = new initcomponents();
  $Nav = new nav();

  require_once("vista/inicio/pagoVista.php");

?>