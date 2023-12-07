<?php

    use component\initcomponents as initcomponents;
    use modelo\registro as registro;
    use component\tienda as tienda;
    $obj_Model = new registro();

    if(isset($_GET['cedula']) && isset($_GET['validar'])){
      $res = $obj_Model->getValidarCedula($_GET['cedula']);
      die(json_encode($res));
    }

    if(isset($_GET['email']) && isset($_GET['validar'])){
      $res = $obj_Model->getValidarEmail($_GET['email']);
      die(json_encode($res));
    }

    if(isset($_POST['cedula']) && isset($_POST['name']) && isset($_POST['apellido']) && isset($_POST['email']) && isset ($_POST['password']) && isset($_POST['repass'])){
      $obj_Model->getRegistrarSistema($_POST['cedula'],$_POST['name'],$_POST['apellido'] ,$_POST['email'] ,$_POST['password'], $_POST['repass']);
    } 


    $VarComp = new initcomponents();
    $tiendaComp = new tienda();


    if(file_exists("vista/sesion/registroVista.php")){
      require_once("vista/sesion/registroVista.php");
    }else{
      die("La vista no existe.");
    }

?>