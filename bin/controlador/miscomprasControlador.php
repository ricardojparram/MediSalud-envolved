<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use modelo\miscompras as miscompras;
  use component\tienda;
	



      if(!isset($_SESSION['nivel'])){
       die('<script> window.location = "?url=login" </script>');
     }

     $objModel = new miscompras();
 

      if (isset($_POST['mostrar']) && isset($_POST['bitacora'])) {
        $res = $objModel->getMostrarVentas();
        die (json_encode($res)); 
      }
      if(isset($_POST['detalleV'])) {
          $res = $objModel->getDetalleV($_POST['id']);
          die (json_encode($res)); 
       }
     if (isset($_POST['id']) && isset($_POST['factura']) ){
       $res = $objModel->ExportarFactura($_POST['id']);
       die (json_encode($res)); 
     }
      if(isset($_POST['detalleTipo'])) {
          $res = $objModel->getDetalleTipoPago($_POST['id']);
          die (json_encode($res)); 
       }

     if(isset($_POST['validarCI']) && isset($_POST['id'])){
      $res = $objModel->validarSelect($_POST['id']);
      die (json_encode($res)); 
     }


     $VarComp = new initcomponents();
     $header = new header();
     $Nav = new tienda();


   if(file_exists("vista/inicio/miscomprasVista.php")){
     require_once("vista/inicio/miscomprasVista.php");
   }

?>