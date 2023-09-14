<?php 

 namespace modelo;

 use config\connect\DBconnect as DBconnect;


 class inicio extends DBconnect{

  private $id;

  public function __construct(){
  	parent::__construct();
  } 

  public function mostrarCatalogo(){
  	try {
  		$query = 'SELECT `cod_producto`,`descripcion` ,`stock`, `p_venta` FROM `producto` WHERE status = 1 and stock != 0 LIMIT 4';

  		$new = $this->con->prepare($query); 
  		$new->execute();
  		$data = $new->fetchAll(\PDO::FETCH_OBJ);
  		echo json_encode($data);
  		die();
  	} catch (\PDOException $e) {
  		die($e);
  	}

  }

  public function rellenarDatos($id){

  	if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
  		echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
  		die();
  	}

  	$this->id = $id;

  	$this->rellenarD();

  }

  private function rellenarD(){
  	try {
  		$query = 'SELECT `cod_producto`,`descripcion` ,`stock`, `p_venta`, `vencimiento` FROM `producto` WHERE status = 1 and stock != 0 and cod_producto = ?';

  		$new = $this->con->prepare($query); 
  		$new->bindValue(1, $this->id);
  		$new->execute();
  		$data = $new->fetchAll(\PDO::FETCH_OBJ);
  		echo json_encode($data);
  		die();

  	} catch (\PDOException $e) {
  		die($e);
  	}


  }



 }
?>