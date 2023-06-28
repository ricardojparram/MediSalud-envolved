<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\presentacion as presentacion;

  $objModel = new Presentacion();

  if(isset($_SESSION['nivel'])){
    if($_SESSION['nivel'] != 1 && $_SESSION['nivel'] != 2){
      die('<script> window.location = "?url=home" </script>');
    }
  }else{
    die('<script> window.location = "?url=login" </script>');
  }
  

  if(isset($_POST['mostrar'])){

    $objModel->mostrarPresentacionAjax();
  }


  if(isset($_POST['med'])  && isset($_POST['cant']) && isset($_POST['pes'])){

  	
      
    $respuesta = $objModel->getDatosPres($_POST['med'], $_POST['cant'], $_POST['pes']);

  }

  if(isset($_POST['select'])){
  
    $objModel->getPres($_POST['id']);
  }



  if(isset($_POST['medEdit']) && isset($_POST['cantEdit']) && isset($_POST['pesEdit'])){

    $respuesta = $objModel->getEditar($_POST['medEdit'], $_POST['cantEdit'], $_POST['pesEdit'], $_POST['id']);

  }

  if(isset($_POST['eliminar'])){
    $objModel->getEliminar($_POST['id']);
  }
  


  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();

  if(file_exists("vista/interno/productos/presentacionVista.php")){
    require_once("vista/interno/productos/presentacionVista.php");
  }

?>