<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\productos as productos;

     $objModel = new productos();
     $permisos = $objModel->getPermisosRol($_SESSION['nivel']);
     $permiso = $permisos['Producto'];

  if(isset($_SESSION['nivel'])){
    if($_SESSION['nivel'] != 1 && $_SESSION['nivel'] != 2){
      die('<script> window.location = "?url=home" </script>');
    }
  }else{
    die('<script> window.location = "?url=login" </script>');
  }
  
        if(isset($_POST['getPermisos'])&& $permiso['Consultar'] ==1){
        die(json_encode($permiso));
      }
   
   if (isset($_POST['mostrar']) && isset($_POST['bitacora'])) {
    ($_POST['bitacora'] == 'true')
    ? $objModel->MostrarProductos(true)
    : $objModel->MostrarProductos();
   }
   
   $mostraLab = $objModel->mostrarLaboratorio();
   $mostraPres = $objModel->mostrarPresentacion();
   $mostraTipo = $objModel->mostrarTipo();
   $mostrarClase = $objModel->mostrarClase();
 
  if (isset($_POST['codigo_producto']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['fechaV']) && isset($_POST['composicionP']) && isset($_POST['posologia']) && isset($_POST['laboratorio']) && isset($_POST['tipoP']) && isset($_POST['clase']) && isset($_POST['presentación']) && isset($_POST['ubicación']) && isset($_POST['contraIn']) && isset($_POST['cantidad']) && isset($_POST['precioV']) && isset($_POST['imagen']) && $permiso['Registrar'] )  {
   	  
   	  $respuesta = $objModel->getRegistraProd($_POST['codigo_producto'], $_POST['nombre'],$_POST['descripcion'] , $_POST['fechaV'] , $_POST['composicionP'] , $_POST['posologia'] , $_POST['laboratorio'] , $_POST['tipoP'] , $_POST['clase'] , $_POST['presentación'] , $_POST['ubicación'] , $_POST['contraIn'] , $_POST['cantidad'] , $_POST['precioV'], $_POST['imagen'] );
   	  
   }

   if(isset($_POST['select']) && $permiso['Consultar']) {
     $respuesta = $objModel->MostrarEditProductos($_POST['id']);
   }

   if (isset($_POST['codigo_productoEd']) && isset($_POST['nombreEd']) &&($_POST['descripcionEd']) && isset($_POST['fechaEd']) && isset($_POST['composicionEd']) && isset($_POST['posologiaEd']) && isset($_POST['laboratorioEd']) && isset($_POST['tipoEd']) && isset($_POST['claseEd']) && isset($_POST['presentaciónEd']) && isset($_POST['ubicaciónEd']) && isset($_POST['contraInEd']) && isset($_POST['cantidadEd']) && isset($_POST['VentaEd']) && isset($_POST['imagenEd'])  && isset($_POST['id']) && $permiso['Editar']) {
      
      $respuesta = $objModel->getEditarProd($_POST['codigo_productoEd'], $_POST['nombreEd'], $_POST['descripcionEd'] , $_POST['fechaEd'] , $_POST['composicionEd'] , $_POST['posologiaEd'] , $_POST['laboratorioEd'] , $_POST['tipoEd'] , $_POST['claseEd'] , $_POST['presentaciónEd'] , $_POST['ubicaciónEd'] , $_POST['contraInEd'] , $_POST['cantidadEd'] , $_POST['VentaEd'], $_POST['imagenEd'], $_POST['id'] );
      
   }

   
   if (isset($_POST['delete']) && $permiso['Eliminar']){
    $respuesta = $objModel->getEliminarProd($_POST['id']);
   }
   
   $VarComp = new initcomponents();
   $header = new header();
   $menu = new menuLateral($permisos);

  if(file_exists("vista/interno/productos/productoVista.php")){
    require_once("vista/interno/productos/productoVista.php");
  }

?>