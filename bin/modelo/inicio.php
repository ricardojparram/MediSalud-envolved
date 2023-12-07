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

  		$query='SELECT p.cod_producto, p.nombre, p.descripcion, p.stock, p.p_venta, p.img, p.contraindicaciones, t.des_tipo, ps.cantidad as cantidad_pres, ps.medida as medida_pres, ps.peso as peso_pres FROM producto p
              INNER JOIN tipo t ON t.cod_tipo = p.cod_tipo
              INNER JOIN presentacion ps ON ps.cod_pres = p.cod_pres
              WHERE p.status = 1 and p.stock != 0 LIMIT 4';
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


 }
?>