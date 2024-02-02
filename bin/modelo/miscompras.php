<?php 

  namespace modelo; 
  use FPDF as FPDF;
  use config\connect\DBConnect as DBConnect;

  class miscompras extends DBConnect{

      private $id;
      private $cedula;
      private $monto;
      private $codigoP;
      private $cantidad;
      private $metodo;
      private $moneda;

   
    //---------------------------------MOSTRAR VENTA--------------------------------

      public function getMostrarVentas($bitacora = false){
      try{
         parent::conectarDB();

         $this->key = parent::KEY();
         $this->iv = parent::IV();
         $this->cipher = parent::CIPHER();

         $cedula = $_SESSION['cedula'];
     
        $query = "SELECT v.num_fact, v.fecha, v.cedula_cliente , format(p.monto_total,2,'de_DE') as monto, 
        CONCAT(IF(MOD(format(p.monto_total,2,'de_DE') / format(cm.cambio,2,'de_DE'), 1) >= 0.5, 
        CEILING(p.monto_total / cm.cambio), 
        FLOOR(format(p.monto_total,2,'de_DE')  / format(cm.cambio,2,'de_DE') ) + 0.5), ' ', m.nombre) as 'total_divisa' FROM venta v 
        INNER JOIN pago p ON p.num_fact = v.num_fact 
        INNER JOIN detalle_pago dp ON p.id_pago = dp.id_pago 
        INNER JOIN cambio cm ON cm.id_cambio = dp.id_cambio 
        INNER JOIN moneda m ON cm.moneda = m.id_moneda WHERE v.status = 1 and v.cedula_cliente = '$cedula' GROUP by v.cedula_cliente";

        $new = $this->con->prepare($query);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);

        foreach ($data as $item) {
          $item->cedula_cliente = openssl_decrypt($item->cedula_cliente, $this->cipher, $this->key, 0 , $this->iv);
        }

        if($bitacora) $this->binnacle("Ventas",$_SESSION['cedula'],"Consultó sus compras.");
        parent::desconectarDB();
        return $data;
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
       $this->binnacle("Venta",$_SESSION['cedula'], "Exporto Ticket de Venta");
       parent::desconectarDB();
       return $respuesta;

      }catch(\PDOexection $error){
        return($error);
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
        die (json_encode($data));
        parent::desconectarDB();
        return $data;

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
        die (json_encode($data));
        parent::desconectarDB();
        return $data;
      }catch(\PDOexection $error){
        return $error;
      }
    }


    
    

    
  }

?>