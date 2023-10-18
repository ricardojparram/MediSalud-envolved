<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\ventas as ventas;

      if(!isset($_SESSION['nivel'])){
       die('<script> window.location = "?url=login" </script>');
     }

     $objModel = new ventas();
     $permisos = $objModel->getPermisosRol($_SESSION['nivel']);
     $permiso = $permisos['Ventas'];

      if(!isset($permiso['Consultar'])) die(`<script> window.location = "?url=home" </script>`);

      if (isset($_POST['getPermisos']) && $permiso['Consultar'] == 1) {
        die(json_encode($permiso));
      }
      
      $mostrarC = $objModel->getMostrarCliente();

       if (isset($_POST['selectTipo']) && $permiso['Consultar'] == 1) {
         $objModel->getMostrarMetodo();
       }
       

      if (isset($_POST['mostrar']) && isset($_POST['bitacora'])) {
        ($_POST['bitacora'] == 'true')
        ? $objModel->getMostrarVentas(true)
        : $objModel->getMostrarVentas();
      }

       if(isset($_POST['detalleV']) && $permiso['Consultar'] == 1) {
          $objModel->getDetalleV($_POST['id']);
       }

       if(isset($_POST['detalleTipo']) && $permiso['Consultar'] == 1) {
          $objModel->getDetalleTipoPago($_POST['id']);
       }

      if (isset($_POST['selectM']) && $permiso['Consultar'] == 1) {
         $objModel->getMostrarMoneda();
      }
       
      if(isset($_POST['select']) && $permiso['Consultar'] == 1) {
         $objModel->getMostrarProducto();
      }

      if(isset($_POST['cedula']) && isset($_POST['validar']) && $permiso['Consultar'] == 1){
        $objModel->validarCliente($_POST['cedula']);
      }

      if(isset($_GET['producto']) && isset($_GET['fill'])  && $permiso['Consultar'] == 1){
        $objModel->productoDetalle($_GET['producto']);
      }


      if(isset($_POST['cedula']) && $permiso['Registrar'] == 1){

        $objModel->getAgregarVenta($_POST['cedula']);

      }

      if(isset($_POST['producto']) && isset($_POST['precio']) && isset($_POST['cantidad']) && isset($_POST['id']) && $permiso['Registrar'] == 1){

       $objModel->agregarVentaXProd($_POST['producto'] , $_POST['precio'] , $_POST['cantidad'], $_POST['id'] );
       
     }

     if (isset($_POST['montoT']) && isset($_POST['id']) && $permiso['Registrar'] == 1) {
       $objModel->getPago($_POST['montoT'] , $_POST['id']);
     }

     if(isset($_POST['tipoPago']) && isset($_POST['montoPorTipo']) && isset($_POST['id']) && isset($_POST['moneda']) && $permiso['Registrar'] == 1) {
       $objModel->agregarDetallePago($_POST['tipoPago'] , $_POST['montoPorTipo'] , $_POST['id'] , $_POST['moneda']);
     }

     if (isset($_POST['id']) && isset($_POST['factura']) ){
       $objModel->ExportarFactura($_POST['id']);
     }

     if(isset($_POST['validarCI']) && isset($_POST['id']) && $permiso['Consultar'] == 1){
      $objModel->validarSelect($_POST['id']);
     }

     if (isset($_POST["eliminar"]) && $permiso['Eliminar'] == 1) {
       $MS = $objModel->eliminarVenta($_POST["id"]);
     }

     $VarComp = new initcomponents();
     $header = new header();
     $menu = new menuLateral($permisos);


   if(file_exists("vista/interno/ventasVista.php")){
     require_once("vista/interno/ventasVista.php");
   }

?>