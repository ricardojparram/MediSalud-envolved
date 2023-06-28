 <?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\clase as clase;
	
	$objModel = new clase();

	if(isset($_POST["clase"])) {
		$objModel->getAgregarClase($_POST["clase"]);
	}

	if(isset($_POST["mostrar"])) {
		$objModel->mostrarClase();
	}

	if(isset($_POST["id"]) && isset($_POST["borrar"])){
		$objModel->getEliminar($_POST["id"]);
	}

	if(isset($_POST["idedit"]) && isset($_POST["item"])){
		$objModel->getItem($_POST["idedit"]);
	}

	if(isset($_POST["claseEdit"]) && isset($_POST["idedit"])) {
		$objModel->getEditarClase($_POST["claseEdit"], $_POST["idedit"]);
	}

   $VarComp = new initcomponents();
   $header = new header();
   $menu = new menuLateral();


	if(file_exists("vista/interno/productos/claseVista.php")){
		require_once("vista/interno/productos/claseVista.php");
	}

?>