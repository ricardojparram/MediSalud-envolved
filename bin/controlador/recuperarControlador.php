<?php
   
    use component\initcomponents as initcomponents;
    use modelo\recuperar as recuperar;

    $obj_Model = new recuperar();
    
    if(isset($_POST['email'])){
      $respuesta = $obj_Model->getRecuperarSistema($_POST['email']);
    }    

    $VarComp = new initcomponents();


    if(file_exists("vista/sesion/recuperarVista.php")){
      require_once("vista/sesion/recuperarVista.php");
    }else{
      die("La vista no existe.");
    }

?>