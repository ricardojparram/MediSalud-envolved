<?php 

 namespace modelo;

 use config\connect\DBConnect as DBConnect;


 class inicio extends DBConnect{

  private $id_producto;
  private $cantidad;
  private $user;

  public function __construct(){
  	parent::__construct();
  } 

  public function mostrarCatalogo(){
  	try {

  		$query = 'SELECT `cod_producto`,`descripcion` ,`stock`, `p_venta` FROM `producto` WHERE status = 1 and stock != 0 LIMIT 4';
        $this->conectarDB();
  		$new = $this->con->prepare($query); 
  		$new->execute();
  		$data = $new->fetchAll(\PDO::FETCH_OBJ);
        $this->desconectarDB();
  		die(json_encode($data));

  	} catch (\PDOException $e) {
  		die($e);
  	}

  }

  public function rellenarDatos($id){

  	if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
  		echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
  		die();
  	}

    $this->id_producto = $id;

  	$this->rellenarD();

  }

  private function rellenarD(){
  	try {
  		$query = 'SELECT `cod_producto`,`descripcion` ,`stock`, `p_venta`, `vencimiento` FROM `producto` WHERE status = 1 and stock != 0 and cod_producto = ?';
        $this->conectarDB();
  		$new = $this->con->prepare($query); 
  		$new->bindValue(1,  $this->id_producto);
  		$new->execute();
  		$data = $new->fetchAll(\PDO::FETCH_OBJ);
        $this->desconectarDB();
  		die(json_encode($data));

  	} catch (\PDOException $e) {
  		die($e);
  	}


  }

  public function getValidarStock($id){
    $this->id_producto = $id;

    $this->validarStock();
  }

  private function validarStock(){

    try {
        $this->conectarDB();
        $new = $this->con->prepare("SELECT stock FROM producto WHERE cod_producto = ?");
        $new->bindValue(1,  $this->id_producto);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        $this->desconectarDB();
        die(json_encode($data[0]));

    } catch (\PDOException $e) {
        die($e);
    }

  }

  public function getAgregarProducto($cedula, $id, $cantidad){
    $this->id_producto = $id;
    $this->cantidad = $cantidad;
    $this->user = $cedula;

    $this->agregarAlCarrito();
  }

  private function agregarAlCarrito(){

    try {
        $this->conectarDB();
        $new = $this->con->prepare("SELECT cod_producto FROM carrito WHERE cod_producto = ? AND cedula = ?");
        $new->bindValue(1, $this->id_producto);
        $new->bindValue(2, $this->user);
        $new->execute();
        $res = $new->fetchAll(\PDO::FETCH_OBJ);
        $resultado;
        if(isset($res[0]->cod_producto)){
            $resultado = ['resultado' => false, 'msg' => 'Este producto ya estaba agregado en el carrito.'];
            die(json_encode($resultado));
        }

        $new = $this->con->prepare("SELECT p_venta FROM producto WHERE cod_producto = ?");
        $new->bindValue(1,  $this->id_producto);
        $new->execute();
        [0 => $data] = $new->fetchAll(\PDO::FETCH_OBJ);

        $precio = floatval($data->p_venta) * $this->cantidad;

        $sql = "INSERT INTO carrito(cedula, cod_producto, cantidad, precioActual)
                VALUES(?, ?, ?, ?)";
        $new = $this->con->prepare($sql);
        $new->bindValue(1, $this->user);
        $new->bindValue(2, $this->id_producto);
        $new->bindValue(3, $this->cantidad);
        $new->bindValue(4, $precio);
        $new->execute();
        
        $this->desconectarDB();
        $resultado = ['resultado' => true, "msg" => "Se ha agregado el producto al carrito."];
        die(json_encode($resultado));
        
    } catch (\PDOException $e) {
        die($e);
    }

  }

 }
?>