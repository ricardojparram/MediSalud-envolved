<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\ventas as ventas;


	    $objModel = new ventas();
      
      $mostrarC = $objModel->getMostrarCliente();
      $mostrerM = $objModel->getMostrarMetodo();

      if(!isset($_SESSION['nivel'])){
        die('<script> window.location = "?url=login" </script>');
      }

      if (isset($_POST['selectM'])) {
        $mostrarM = $objModel->getMostrarMoneda();
      }
       
      if (isset($_POST['mostrar'])) {
        $mostrarV = $objModel->getMostrarVentas();
      }
       if(isset($_POST['detalleV'])) {
         $mostraDet = $objModel->getDetalleV($_POST['id']);
       }

      if(isset($_POST['select'])) {
        $mostrarP = $objModel->getMostrarProducto();
      }

      if(isset($_GET['producto']) && isset($_GET['fill'])){
      $objModel->productoDetalle($_GET['producto']);
      }


	    if(isset($_POST['cedula']) && isset($_POST['montoT']) && isset($_POST['metodo']) && isset($_POST['moneda']) ){

	     $objModel->getAgregarVenta($_POST['cedula'] , $_POST['montoT'] , $_POST['metodo'] , $_POST['moneda'] );

	  	}

       if(isset($_POST['producto']) && isset($_POST['precio']) && isset($_POST['cantidad']) && isset($_POST['id']) ){

       $objModel->AgregarVentaXProd($_POST['producto'] , $_POST['precio'] , $_POST['cantidad'], $_POST['id'] );
       
      }

    if (isset($_POST["eliminar"])) {
     $MS = $objModel->eliminarVenta($_POST["id"]);
      }

    $VarComp = new initcomponents();
    $header = new header();
    $menu = new menuLateral();


   if(file_exists("vista/interno/ventasVista.php")){
     require_once("vista/interno/ventasVista.php");
   }

?>