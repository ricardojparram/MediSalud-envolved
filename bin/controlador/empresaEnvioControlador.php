<?php  

    use component\initcomponents as initcomponents;
    use component\header as header;
    use component\menuLateral as menuLateral;
    use modelo\empresaEnvio as empresaEnvio;
 
    if(!isset($_SESSION['nivel'])) die('<script> window.location = "?url=login" </script>');

    $objModel = new empresaEnvio();
    $permisos = $objModel->getPermisosRol($_SESSION['nivel']);
    $permiso = $permisos['Empresa de Envio'];

    if(!isset($permiso['Consultar'])) die('<script> window.location = "?url=home "</script>');

    if(isset($_POST['getPermisos']) && $permiso['Consultar'] == 1){
      die(json_encode($permiso));
    }

    if (isset($_POST['mostrar']) && isset($_POST['bitacora'])) {
    	($_POST['bitacora'] == 'true')
    	? $objModel->mostrarEmpresas(true)
    	: $objModel->mostrarEmpresas();
    }

    if (isset($_POST['rif']) && isset($_POST['validarRif']) && $permiso['Consultar'] == 1) {
    	$objModel->validarRif($_POST['rif'] , $_POST['id']);
    }

    if(isset($_POST['rif']) && isset($_POST['name']) && isset($_POST['contacto']) && isset($_POST['registra']) && $permiso['Registrar'] == 1) {
        $objModel->getRegistrarEmpresa($_POST['rif'], $_POST['name'], $_POST['contacto']);
    }

    if(isset($_POST['validarC']) && isset($_POST['id']) && $permiso['Consultar'] == 1) {
    	 $objModel->validarSelect($_POST['id']);
    }

    if(isset($_POST['clickEdit']) && isset($_POST['id'])) {
    	$objModel->rellenarEdit($_POST['id']);
    }

    if(isset($_POST['rifEdit']) && isset($_POST['nameEdit']) && isset($_POST['contactoEdit']) && isset($_POST['id']) && isset($_POST['editar']) && $permiso['Editar'] == 1) {
    	$objModel->getEditarEmpresa($_POST['rifEdit'], $_POST['nameEdit'], $_POST['contactoEdit'], $_POST['id']);
    }

    if (isset($_POST['ElimnarEmpresa']) && isset($_POST['id']) && $permiso['Eliminar']){
    	$objModel->getEliminarEmpresa($_POST['id']);
    }


    $VarComp = new initcomponents;
    $header = new header;
    $menu = new menuLateral($permisos);
    
    if(file_exists("vista/interno/configuraciones/empresaEnvioVista.php")){
    	require_once("vista/interno/configuraciones/empresaEnvioVista.php");
    }else{
    	die('No existe la vista');
    }
?>