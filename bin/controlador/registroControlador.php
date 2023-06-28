<?php

    use component\initcomponents as initcomponents;
    use modelo\registro as registro;
    $obj_Model = new registro();

    if(isset($_GET['cedula']) && isset($_GET['validar'])){
      $obj_Model->getValidarC($_GET['cedula']);
    }

    if(isset($_GET['email']) && isset($_GET['validar'])){
      $obj_Model->getValidarE($_GET['email']);
    }

    if(isset($_POST['cedula']) && isset($_POST['name']) && isset($_POST['apellido']) && isset($_POST['email']) && isset ($_POST['password']) && isset($_POST['repass'])){
      $obj_Model->getRegistrarSistema($_POST['cedula'],$_POST['name'],$_POST['apellido'] ,$_POST['email'] ,$_POST['password'], $_POST['repass']);
    } 


    $VarComp = new initcomponents();


    if(file_exists("vista/sesion/registroVista.php")){
      require_once("vista/sesion/registroVista.php");
    }else{
      die("La vista no existe.");
    }

?>