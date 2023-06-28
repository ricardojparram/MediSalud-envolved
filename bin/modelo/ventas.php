<?php 

  namespace modelo; 
  use config\connect\DBConnect as DBConnect;

  class ventas extends DBConnect{

  	  private $id;
      private $cedula;
      private $monto;
      private $codigoP;
      private $cantidad;
      private $metodo;
      private $moneda;


      function __construct(){
       parent::__construct();
     }

     //---------------------------------AGREGAR VENTAS--------------------------------

     public function getAgregarVenta($cedula,$montoT,$metodo,$moneda){

     if(preg_match_all("/^[0-9]{3,30}$/", $cedula) != 1){
        return "Error de cedula!";
      }
      if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $montoT) != 1){
        return "Error de monto!";
      }
      if(preg_match_all("/^[0-9]{1,15}$/", $metodo) != 1){
        return "Error de metodo de pago!";
      }
      if(!is_numeric($moneda)){
        die('Error de moneda!');
      }
    
      $this->cedula = $cedula; 
      $this->monto = $montoT;
      $this->metodo = $metodo;
      $this->moneda = $moneda;


      return $this->agregarVenta();

    }

    private function agregarVenta(){
     try{
      $new = $this->con->prepare("SELECT `cedula` FROM `cliente` WHERE `status` = 1 and `cedula` = ?");
      $new->bindValue(1, $this->cedula);
      $new->execute();
      $data = $new->fetchAll();

      if(isset($data[0]["cedula"])){

       $new = $this->con->prepare("INSERT INTO `venta`(`num_fact`, `fecha`, `monto`, `cedula_cliente`, `cod_tipo_pago`, `cod_cambio`, `status`) VALUES (default,default,?,?,?,?,1)");

       $new->bindValue(1, $this->monto);
       $new->bindValue(2, $this->cedula);
       $new->bindValue(3, $this->metodo);
       $new->bindValue(4, $this->moneda);
       $new->execute();
       $this->id = $this->con->lastInsertId();
       echo json_encode(['id' => $this->id]);
       die();

       }else{
        return ("¡Cedula no se encuentra registrado!");
      }

    }catch(\PDOexection $error){
      return $error;	
   }
 }

  //---------------------------------AGREGAR VENTA POR PRODUCTO--------------------------------

   public function AgregarVentaXProd($producto,$precio,$cantidad,$idVenta){
    
      if(preg_match_all("/^[0-9]{1,15}$/", $producto) != 1){
        return "Error de producto!";
      }
      if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $precio) != 1){
        return "Error de precio!";
      }
      if(preg_match_all("/^[0-9]{1,15}$/", $cantidad) != 1){
        return "Error de cantidad!";
      } 

    $this->codigoP = $producto;
    $this->precio = $precio;
    $this->cantidad = $cantidad;
    $this->id = $idVenta;

    return $this->VentaXProducto();

   }

   private function VentaXProducto(){
    try{
     $new = $this->con->prepare("INSERT INTO `venta_producto`(`num_fact`, `cod_producto`, `cantidad`, `precio_actual`) VALUES (?,?,?,?)");
     $new->bindValue(1, $this->id);
     $new->bindValue(2, $this->codigoP);
     $new->bindValue(3, $this->cantidad);
     $new->bindValue(4, $this->precio);
     $new->execute();
     $this->actualizarStock($this->codigoP , $this->cantidad);

    }catch(\PDOexection $error){
      return $error;
    }

   }

    //---------------------------------ACTUALIZAR STOCK--------------------------------

   private function actualizarStock($codigoP , $cantidad){
    try{
     $new = $this->con->prepare("SELECT stock FROM producto p WHERE p.cod_producto = ? and status = 1");
     $new->bindValue(1, $codigoP);
     $new->execute();
     $data = $new->fetchAll();

     $stockAct = $data[0]['stock'];

     $newStock = $stockAct - $cantidad;

     $new = $this->con->prepare("UPDATE producto p SET stock = ? WHERE p.cod_producto = ? and status = 1");
     $new->bindValue(1, $newStock);
     $new->bindValue(2, $codigoP);
     $new->execute();

    }catch(\PDOexection $error){
      return $error;
    }
   }


   
    //---------------------------------ELIMINAR VENTA--------------------------------

   public function eliminarVenta($id){
     try{
      $this->id = $id;

      $new = $this->con->prepare("SELECT p.cod_producto , vp.cantidad , p.stock FROM venta_producto vp INNER JOIN producto p ON p.cod_producto = vp.cod_producto WHERE vp.num_fact = ?");
      
      $new->bindValue(1, $this->id);
      $new->execute();
      $result = $new->fetchAll(\PDO::FETCH_OBJ);

      foreach ($result as $data){

        $stockAct = $data->stock;
        $cantidad = $data->cantidad;
        $codigoP = $data->cod_producto;

        $NewStock = $cantidad + $stockAct;

        $new = $this->con->prepare("UPDATE producto p SET stock = ? WHERE p.cod_producto = ? and status = 1");
        $new->bindValue(1, $NewStock);
        $new->bindValue(2, $codigoP);
        $new->execute();
        
      }

      $new = $this->con->prepare("UPDATE `venta` SET `status`= 0 WHERE num_fact = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $data = $new->fetchAll(\PDO::FETCH_OBJ);
    }
    catch(\PDOexection $error){
      return $error;
    }
    
  }
    
    //---------------------------------MOSTRAR VENTA--------------------------------

    public function getMostrarVentas(){
      try{
        $query = "SELECT v.cedula_cliente, CONCAT('<button class=\"btn btn-success detalleV\" id=\"', v.num_fact ,'\" data-bs-toggle=\"modal\" data-bs-target=\"#detalleVenta\">Ver detalles</button>') as productos, v.fecha , tp.des_tipo_pago,  CONCAT(IF(MOD(v.monto / cm.cambio, 1) >= 0.5, CEILING(v.monto / cm.cambio), FLOOR(v.monto / cm.cambio) + 0.5), ' ', m.nombre) as 'total_divisa' ,v.monto ,CONCAT('<button type=\"button\" id=\"', v.num_fact ,'\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#Borrar\"><i class=\"bi bi-trash3\"></i></button>') as opciones FROM venta v 
          INNER JOIN tipo_pago tp ON v.cod_tipo_pago = tp.cod_tipo_pago 
          INNER JOIN cambio cm ON cm.id_cambio = v.cod_cambio
          INNER JOIN moneda m ON cm.moneda = m.id_moneda
          WHERE v.status = 1;";

        $new = $this->con->prepare($query);
        $new->execute();
        $data = $new->fetchAll();
        
        echo json_encode($data);
        die();
      }catch(\PDOexection $error){

       return $error;     
     }  
    }

     //---------------------------------DETALLES PRODUCTOS POR VENTA--------------------------------

    public function getDetalleV($id){
      try{
        $this->id = $id;
        $new = $this->con->prepare("SELECT p.descripcion , vp.cantidad , vp.precio_actual , v.num_fact FROM venta_producto vp INNER JOIN producto p ON vp.cod_producto = p.cod_producto INNER JOIN venta v ON v.num_fact = vp.num_fact WHERE v.status = 1 AND v.num_fact = ?");
        $new->bindValue(1, $this->id);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        die();

      }catch(\PDOexection $error){
        return $error;
      }
    }

     //---------------------------------MOSTRAR PRODUCTO--------------------------------

    public function getMostrarProducto(){
      try{
        $new = $this->con->prepare("SELECT * FROM producto WHERE status = 1 and stock > 0");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        die();


      }catch(\PDOexection $error){

       return $error;   

     }   
    }
     //---------------------------------MOSTRA CANTIDAD Y PRECIO DE PRODUCTO--------------------------------

    public function productoDetalle($id){
      $this->producto = $id;

      try {
        $new = $this->con->prepare("SELECT p_venta, stock FROM producto WHERE cod_producto = ? and status = 1");
        $new->bindValue(1, $this->producto);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        
        echo json_encode($data);
        die();

      } catch (\PDOException $e) {
        return $e;
      }
    }

    public function getMostrarMoneda(){
     try{
      $new = $this->con->prepare("SELECT * FROM( SELECT c.id_cambio, m.nombre, c.cambio FROM cambio c INNER JOIN moneda m ON c.moneda = m.id_moneda WHERE c.status = 1 ORDER BY c.fecha DESC LIMIT 9999999) as tabla GROUP BY tabla.nombre");
      $new->execute();
      $data = $new->fetchAll(\PDO::FETCH_OBJ);

      echo json_encode($data);
      die();

    }catch(\PDOexection $error){

     return $error;   

   } 
 }


     //---------------------------------MOSTRAR METODO DE PAGO--------------------------------

    public function getMostrarMetodo(){
      try{
        $new = $this->con->prepare("SELECT * FROM `tipo_pago` WHERE status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      }catch(\PDOexection $error){

       return $error;   

     }   
    }
    
     //---------------------------------MOSTRAR CLIENTE--------------------------------
    
    public function getMostrarCliente(){
      try{
        $new = $this->con->prepare("SELECT * FROM `cliente` WHERE status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      }catch(\PDOexection $error){

       return $error;   

     }   
    }
    
  }

?>