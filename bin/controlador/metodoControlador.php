 <?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\metodo as metodo;

  $objModel = new metodo();

  if (isset($_POST["mostrar"])) {
    $objModel->getMostrarMetodo();
  }


  if(isset($_POST["metodo"])) {
    $objModel->getAgregarMetodo($_POST["metodo"]  );  
  } 




if (isset($_POST["eliminar"]) && isset($_POST["id"])) {
  $objModel->getEliminarMetodo($_POST["id"]);
}

if (isset($_POST["unicas"]) && isset($_POST["editar"])){
$objModel->mostrarunicas($_POST["unicas"]);
}

if(isset($_POST["tipoEdit"]) && isset($_POST["unicas"])) {
  $objModel->getEditarMetodo($_POST["tipoEdit"], $_POST["unicas"]);


}




  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();


  if(file_exists("vista/interno/configuraciones/metodoVista.php")){
    require_once("vista/interno/configuraciones/metodoVista.php");
  }

?>