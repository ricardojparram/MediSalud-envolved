<?php 

  namespace modelo; 
  use FPDF as FPDF;
  use config\connect\DBConnect as DBConnect;

  class ventas extends DBConnect{

  	  private $id;
      private $cedula;
      private $monto;
      private $codigoP;
      private $cantidad;
      private $metodo;
      private $moneda;
      private $key;
      private $iv;
      private $cipher;


     //---------------------------------AGREGAR VENTAS--------------------------------

     public function getAgregarVenta($cedula){

      $this->cedula = $cedula; 

      $this->agregarVenta();

    }

    private function agregarVenta(){
     try{
      parent::conectarDB();
      $new = $this->con->prepare("SELECT `cedula` FROM `cliente` WHERE `status` = 1 and `cedula` = ?");
      $new->bindValue(1, $this->cedula);
      $new->execute();
      $data = $new->fetchAll();

      if(isset($data[0]["cedula"])){

       $new = $this->con->prepare("INSERT INTO `venta`(`num_fact`, `fecha`, `cedula_cliente`, `direccion`, `id_envio`, `online`, `status`) VALUES (default, default , ? , '', null , 0 , 1)");

       $new->bindValue(1, $this->cedula);
       $new->execute();

       $this->id = $this->con->lastInsertId();
       echo json_encode(['id' => $this->id]);

       $this->binnacle("Venta",$_SESSION['cedula'], "Registró Venta.");
       parent::desconectarDB();
       die();

       }else{
        return ("¡Cedula no se encuentra registrado!");
      }

    }catch(\PDOexection $error){
      die($error);	
   }
 }

  //---------------------------------AGREGAR VENTA POR PRODUCTO--------------------------------

   public function agregarVentaXProd($producto,$precio,$cantidad,$idVenta){
    
      if(preg_match_all("/^[0-9]{1,15}$/", $producto) != 1){
        die("Error de producto!") ;
      }
      if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $precio) != 1){
        die("Error de precio!") ;
      }
      if(preg_match_all("/^[0-9]{1,15}$/", $cantidad) != 1){
        die("Error de cantidad!") ;
      } 

    $this->codigoP = $producto;
    $this->precio = $precio;
    $this->cantidad = $cantidad;
    $this->id = $idVenta;

    return $this->VentaXProducto();

   }

   private function VentaXProducto(){
    try{
     parent::conectarDB();
     $new = $this->con->prepare("INSERT INTO `venta_producto`(`num_fact`, `cod_producto`, `cantidad`, `precio_actual`) VALUES (?,?,?,?)");
     $new->bindValue(1, $this->id);
     $new->bindValue(2, $this->codigoP);
     $new->bindValue(3, $this->cantidad);
     $new->bindValue(4, $this->precio);
     $new->execute();
     $this->actualizarStock($this->codigoP , $this->cantidad);
     parent::desconectarDB();

    }catch(\PDOexection $error){
      die($error);
    }

   }

    //---------------------------------ACTUALIZAR STOCK--------------------------------

   private function actualizarStock($codigoP , $cantidad){
    try{
     parent::conectarDB();
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
     parent::desconectarDB();
    }catch(\PDOexection $error){
      die($error);
    }
   }
   
   //---------------------------------AGREGAR PAGO--------------------------------

   public function getPago($montoT , $id){
    
    if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $montoT) != 1){
      die("Error de monto!");
    }

    if(preg_match_all("/^[0-9]{1,15}$/", $id) != 1){
      die("Error de id!");
    }

    $this->monto = $montoT;
    $this->id = $id;

    $this->agregarPago();


   }

   private function agregarPago(){
    try {
      parent::conectarDB();
      $new = $this->con->prepare('INSERT INTO `pago`(`id_pago`, `monto_total`, `num_fact`, `status`) VALUES (default, ? , ? , 1)');
      $new->bindValue(1, $this->monto);
      $new->bindValue(2, $this->id);
      $new->execute();
      $this->id = $this->con->lastInsertId();
      echo json_encode(['id' => $this->id]);
      parent::desconectarDB();
      die();

    } catch (\PDOException $error) {
      die($error);
    }
   }

  //---------------------------------VALIDAR ELIMINAR VENTA--------------------------------

     public function agregarDetallePago($tipoPago , $montoPorTipo , $id , $moneda){
        if(preg_match_all("/^[0-9]{1,15}$/", $tipoPago) != 1){
          die("Error de id!");
        }
        if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $montoPorTipo) != 1){
          die("Error de precio!") ;
        }
        if(preg_match_all("/^[0-9]{1,15}$/", $id) != 1){
          die("Error de id!");
        }
        if(preg_match_all("/^[0-9]{1,15}$/", $moneda) != 1){
          die("Error de moneda!");
        }

        $this->metodo = $tipoPago; 
        $this->monto = $montoPorTipo; 
        $this->id = $id;
        $this->moneda = $moneda;

        $this->detallePago();

     }

     private function detallePago(){
        try {
        parent::conectarDB();
        $new = $this->con->prepare('INSERT INTO `detalle_pago`(`id_detalle_pago`, `id_pago`, `id_tipo_pago`, `id_datos_cobro`, `id_banco_cliente`, `monto_pago`, `id_cambio`) VALUES (DEFAULT, ? , ? , null , null , ? , ?)');
        $new->bindValue(1, $this->id);
        $new->bindValue(2, $this->metodo);
        $new->bindValue(3, $this->monto);
        $new->bindValue(4, $this->moneda);
        $new->execute();

      } catch (\PDOException $error) {
        die($error);
      }
     }

    //---------------------------------VALIDAR ELIMINAR VENTA--------------------------------

     public function validarSelect($id){

      if(preg_match_all("/^[0-9]{1,15}$/", $id) != 1){
        return "Error de id!";
      }

      $this->id = $id;
      parent::conectarDB();
      $new = $this->con->prepare("SELECT * FROM venta v WHERE v.status = 1 and v.num_fact = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $data = $new->fetchAll();
      parent::desconectarDB();

      if(isset($data[0]["num_fact"])){
        echo json_encode(['resultado' => 'Si existe esa venta.']);
        die();
      }else{
       echo json_encode(['resultado' => 'Error de venta']);
       die();
     }
     
   }
   
    //---------------------------------ELIMINAR VENTA--------------------------------

   public function eliminarVenta($id){
     try{
      $this->id = $id;
      parent::conectarDB();

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
      echo json_encode(['resultado' => 'Venta eliminada.']);
      $this->binnacle("Venta",$_SESSION['cedula'], "Venta Anulada.");
      parent::desconectarDB();
      die();

    }
    catch(\PDOexection $error){
      return $error;
    }
    
  }
    
    //---------------------------------MOSTRAR VENTA--------------------------------

    public function getMostrarVentas($bitacora = false){
      try{
         parent::conectarDB();


         $this->key = parent::KEY();
         $this->iv = parent::IV();
         $this->cipher = parent::CIPHER();

        $query ="SELECT v.num_fact, v.fecha, v.cedula_cliente , format(p.monto_total,2,'de_DE') as total, 
        CONCAT(IF(MOD(format(p.monto_total,2,'de_DE') / format(cm.cambio,2,'de_DE'), 1) >= 0.5, 
        CEILING(p.monto_total / cm.cambio), 
        FLOOR(format(p.monto_total,2,'de_DE')  / format(cm.cambio,2,'de_DE') ) + 0.5), ' ', m.nombre) as 'total_divisa' FROM venta v  
        INNER JOIN pago p ON p.num_fact = v.num_fact 
        INNER JOIN detalle_pago dp ON p.id_pago = dp.id_pago 
        INNER JOIN cambio cm ON cm.id_cambio = dp.id_cambio 
        INNER JOIN moneda m ON cm.moneda = m.id_moneda WHERE v.status = 1 GROUP by v.num_fact";


        $new = $this->con->prepare($query);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);

        foreach ($data as $item) {
          $item->cedula_cliente = openssl_decrypt($item->cedula_cliente, $this->cipher, $this->key, 0 , $this->iv);
        }

        echo json_encode($data);
        if($bitacora) $this->binnacle("Ventas",$_SESSION['cedula'],"Consultó listado.");
        parent::desconectarDB();
        die();
      }catch(\PDOexection $error){

       return $error;     
     }  
    }

     //---------------------------------EXPORTAR FACTURA--------------------------------

    public function ExportarFactura($id){

      if(preg_match_all("/^[0-9]{1,15}$/", $id) != 1){
        return "Error de id!";
      }

      $this->id = $id;
      
      return $this->exportar();
    }

    private function exportar(){
      try{
       parent::conectarDB();

       $this->key = parent::KEY();
       $this->iv = parent::IV();
       $this->cipher = parent::CIPHER();

       $query = "SELECT v.cedula_cliente , c.nombre , c.apellido , c.direccion , cc.celular , v.num_fact , v.fecha , p.monto_total ,CONCAT(IF(MOD(p.monto_total / cm.cambio, 1) >= 0.5, CEILING(p.monto_total / cm.cambio), FLOOR(p.monto_total / cm.cambio) + 0.5), ' ', m.nombre) as 'total_divisa' FROM venta v INNER JOIN pago p ON p.num_fact = v.num_fact INNER JOIN detalle_pago dp ON dp.id_pago = p.id_pago INNER JOIN cliente c ON c.cedula = v.cedula_cliente INNER JOIN contacto_cliente cc ON cc.cedula = c.cedula INNER JOIN cambio cm ON cm.id_cambio = dp.id_cambio INNER JOIN moneda m ON m.id_moneda = cm.moneda WHERE v.status = 1 AND v.num_fact = ?";
       $new = $this->con->prepare($query);
       $new->bindValue(1 , $this->id);
       $new->execute();
       $dataV = $new->fetchAll();

       $queryP = "SELECT p.descripcion , vp.cantidad , vp.precio_actual , v.num_fact FROM venta_producto vp INNER JOIN producto p ON vp.cod_producto = p.cod_producto INNER JOIN venta v ON v.num_fact = vp.num_fact WHERE v.status = 1 AND v.num_fact = ?";
       $new = $this->con->prepare($queryP);
       $new->bindValue(1 , $this->id);
       $new->execute();
       $dataP = $new->fetchAll();

       foreach ($dataV as $item) {
        $item['cedula_cliente'] = openssl_decrypt( $item['cedula_cliente'], $this->cipher, $this->key, 0 , $this->iv);
        $item['direccion'] = openssl_decrypt($item['direccion'], $this->cipher, $this->key, 0 , $this->iv);
        $item['celular'] = openssl_decrypt($item['celular'], $this->cipher, $this->key, 0 , $this->iv);
      }
        
       $nombre = 'Ticket_'.$dataV[0]['num_fact'].'_'.$item['cedula_cliente'].'.pdf';
       
       $pdf = new FPDF();
       $pdf->SetMargins(4,10,4);
       $pdf->AddPage();
       
       $pdf->SetFont('Arial','B',10);
       $pdf->SetTextColor(0,0,0);
       $pdf->MultiCell(0,5,utf8_decode(strtoupper('Medisalud C.A')),0,'C',false);
       $pdf->SetFont('Arial','',9);
       $pdf->MultiCell(0,5,utf8_decode('Rif: 1234567'),0,'C',false);
       $pdf->MultiCell(0,5,utf8_decode('Dirreción: Barrio José Félix Ribas, Barquisimeto-Estado Lara.'),0,'C',false);
       $pdf->MultiCell(0,5,utf8_decode('Teléfono: 04120502369'),0,'C',false);
       $pdf->MultiCell(0,5,utf8_decode('Correo: MediSalud@gmail.com'),0,'C',false);

       $pdf->Ln(1);
       $pdf->Cell(0,5,utf8_decode("------------------------------------------------------"),0,0,'C');
       $pdf->Ln(5);

       $pdf->MultiCell(0,5,utf8_decode('Fecha: '. $dataV[0]['fecha']),0,'C',false);
       $pdf->SetFont('Arial','B',10);
       $pdf->MultiCell(0,5,utf8_decode(strtoupper("Ticket Nro: ". $dataV[0]['num_fact'])),0,'C',false);
       $pdf->SetFont('Arial','',9);

       $pdf->Ln(1);
       $pdf->Cell(0,5,utf8_decode("------------------------------------------------------"),0,0,'C');
       $pdf->Ln(5);

       $pdf->MultiCell(0,5,utf8_decode("Cliente: ". $dataV[0]['nombre'].' '. $dataV[0]['apellido']),0,'C',false);
       $pdf->MultiCell(0,5,utf8_decode("Documento: ".$item['cedula_cliente']),0,'C',false);
       $pdf->MultiCell(0,5,utf8_decode("Teléfono: ".$item['celular']),0,'C',false);
       $pdf->MultiCell(0,5,utf8_decode("Dirección: ".$item['direccion']),0,'C',false);

       $pdf->Ln(1);
       $pdf->Cell(0,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');
       $pdf->Ln(3);

       $tableWidth = 74;
       $pdf->SetLeftMargin(($pdf->GetPageWidth() - $tableWidth) / 2);

       $pdf->Cell(18,4,utf8_decode('Articulo'),0,0,'C');
       $pdf->Cell(19,5,utf8_decode('Cant.'),0,0,'C');
       $pdf->Cell(15,5,utf8_decode('Precio'),0,0,'C');
       $pdf->Cell(28,5,utf8_decode('Total'),0,0,'C');

       $pdf->Ln(3);
       $pdf->Cell($tableWidth,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');
       $pdf->Ln(5);

       foreach ($dataP as $col => $value) {
         $pdf->Cell(18,4,utf8_decode($value[0]),0,0,'C');
         $pdf->Cell(19,4,utf8_decode($value[1]),0,0,'C');
         $pdf->Cell(19,4,utf8_decode($value[2]),0,0,'C');
         $pdf->Cell(28,4,utf8_decode($value[1] * $value[2]),0,1,'C');

       }
       $pdf->Ln(4);

       $pdf->Cell($tableWidth,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');

       $pdf->Ln(5);

       $montoTotal = $dataV[0]['monto_total'];

       $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
       $pdf->Cell(22,5,utf8_decode("SUBTOTAL"),0,0,'C');
       $pdf->Cell(32,5,utf8_decode($montoTotal / 1.16),0,0,'C');

       $pdf->Ln(5);

       $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
       $pdf->Cell(22,5,utf8_decode("IVA (16%)"),0,0,'C');
       $pdf->Cell(32,5,utf8_decode($montoTotal -($montoTotal / 1.16)),0,0,'C');

       $pdf->Ln(5);

       $pdf->Cell($tableWidth,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');

       $pdf->Ln(5);

       $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
       $pdf->Cell(22,5,utf8_decode("TOTAL"),0,0,'C');
       $pdf->Cell(32,5,utf8_decode($montoTotal),0,0,'C');

       $pdf->Ln(5);

       $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
       $pdf->Cell(22,5,utf8_decode("CAMBIO"),0,0,'C');
       $pdf->Cell(32,5,utf8_decode($dataV[0]['total_divisa']),0,0,'C');

       $pdf->Ln(10);

       $pdf->MultiCell($tableWidth,5,utf8_decode('*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar este ticket ***'),0,'C',false);

       $pdf->SetFont('Arial','B',9);
       $pdf->Cell($tableWidth,7,utf8_decode('Gracias por su compra'),'',0,'C');

       $pdf->Ln(9);

       $repositorio = 'assets/tickets/'.$nombre;
       $pdf->Output('F',$repositorio);

       $respuesta = ['respuesta' => 'Archivo guardado', 'ruta' => $repositorio];
       echo json_encode($respuesta);
       $this->binnacle("Venta",$_SESSION['cedula'], "Exporto Ticket de Venta");
       parent::desconectarDB();
       die();

      }catch(\PDOexection $error){
        die($error);
      }
    }

     //--------------------------------- VALIDAR CLIENTE --------------------------------

     public function validarCliente($cedula){
     
       $this->cedula = $cedula;

       return $this->validarC();

     }

     private function validarC(){
       parent::conectarDB();

       $new = $this->con->prepare("SELECT `cedula` FROM `cliente` WHERE `status` = 1 and `cedula` = ?");
       $new->bindValue(1, $this->cedula);
       $new->execute();
       $data = $new->fetchAll();
       parent::desconectarDB();
       
       if(isset($data[0]["cedula"])){
        echo json_encode(['resultado' => 'cedula valida.']);
        die();
       }else{
        echo json_encode(['resultado' => 'Error de cedula', 'error' => 'La cedula no está registrado.']);
        die();
       }

     }

     //---------------------------------DETALLES PRODUCTOS POR VENTA--------------------------------

    public function getDetalleV($id){
      try{
        $this->id = $id;
        parent::conectarDB();

        $new = $this->con->prepare("SELECT p.descripcion , vp.cantidad , vp.precio_actual , v.num_fact FROM venta_producto vp INNER JOIN producto p ON vp.cod_producto = p.cod_producto INNER JOIN venta v ON v.num_fact = vp.num_fact WHERE v.status = 1 AND v.num_fact = ?");
        $new->bindValue(1, $this->id);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        parent::desconectarDB();
        die();

      }catch(\PDOexection $error){
        return $error;
      }
    }

         //---------------------------------DETALLES PRODUCTOS POR VENTA--------------------------------

    public function getDetalleTipoPago($id){
      try{
        $this->id = $id;
        parent::conectarDB();

        $new = $this->con->prepare("SELECT v.num_fact , tp.des_tipo_pago , dp.monto_pago FROM venta v INNER JOIN pago p ON v.num_fact = p.num_fact INNER JOIN detalle_pago dp ON dp.id_pago = p.id_pago INNER JOIN tipo_pago tp ON tp.id_tipo_pago = dp.id_tipo_pago WHERE v.num_fact = ?");
        $new->bindValue(1, $this->id);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        parent::desconectarDB();
        die();

      }catch(\PDOexection $error){
        return $error;
      }
    }


     //---------------------------------MOSTRAR PRODUCTO--------------------------------

    public function getMostrarProducto(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM producto p WHERE status = 1 and stock > 0");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        parent::desconectarDB();
        die();

      }catch(\PDOexection $error){

       return $error;   

     }   
    }
     //---------------------------------MOSTRA CANTIDAD Y PRECIO DE PRODUCTO--------------------------------

    public function productoDetalle($id){
      $this->producto = $id;

      try {
         parent::conectarDB();
        $new = $this->con->prepare("SELECT p_venta, stock FROM producto WHERE cod_producto = ? and status = 1");
        $new->bindValue(1, $this->producto);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        
        echo json_encode($data);
        parent::desconectarDB();
        die();

      } catch (\PDOException $e) {
        return $e;
      }
    }

    public function getMostrarMoneda(){
     try{
      parent::conectarDB();
      $new = $this->con->prepare("SELECT * FROM( 
        SELECT c.id_cambio, m.nombre, c.cambio FROM cambio c INNER JOIN moneda m ON c.moneda = m.id_moneda WHERE c.status = 1 ORDER BY c.fecha DESC LIMIT 9999999) as tabla GROUP BY tabla.nombre");
      $new->execute();
      $data = $new->fetchAll(\PDO::FETCH_OBJ);

      echo json_encode($data);
      parent::desconectarDB();
      die();

    }catch(\PDOexection $error){

     return $error;   

   } 
 }


     //---------------------------------MOSTRAR METODO DE PAGO--------------------------------

    public function getMostrarMetodo(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM `tipo_pago` WHERE status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        parent::desconectarDB();
        die();

      }catch(\PDOexection $error){

       return $error;   

     }   
    }
    
     //---------------------------------MOSTRAR CLIENTE--------------------------------
    
    public function getMostrarCliente(){
      try{
        parent::conectarDB();
        $this->key = parent::KEY();
        $this->iv = parent::IV();
        $this->cipher = parent::CIPHER();

        $new = $this->con->prepare("SELECT c.cedula AS cedulaE, c.cedula , c.nombre , c.apellido FROM cliente c WHERE status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        foreach ($data as $item) {
          $item->cedula = openssl_decrypt($item->cedula, $this->cipher, $this->key, 0 , $this->iv);
        }
        return $data;
        
      }catch(\PDOexection $error){

       return $error;   

     }   
    }
    
  }

?>