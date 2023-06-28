<?php 
	
	namespace modelo;
	use FPDF as FPDF;

	use config\connect\DBConnect as DBConnect;

	class reportes extends DBConnect{

		private $tipo;
		private $fechaInicio;
		private $fechaFinal;
		private $sql;
		private $reporte;
		private $lista;


		public function __construct(){
			parent::__construct();
		}

		private function obtenerReporte(){
			switch ($this->tipo) {
				case 'compra':
				$this->sql="SELECT c.orden_compra, p.razon_social, SUM(cp.cantidad) as cantidad, c.fecha,
							CONCAT(IF(MOD(c.monto_total / cm.cambio, 1) >= 0.5, CEILING(c.monto_total / cm.cambio), FLOOR(c.monto_total / cm.cambio) + 0.5), ' ', m.nombre) as 'total_divisa', c.monto_total 
							FROM compra c 
							INNER JOIN compra_producto cp
								ON cp.cod_compra = c.cod_compra
							INNER JOIN proveedor p 
								ON c.cod_prove = p.cod_prove
							INNER JOIN cambio cm 
								ON cm.id_cambio = c.cod_cambio
							INNER JOIN moneda m 
								ON m.id_moneda = cm.moneda
							WHERE c.fecha BETWEEN ? AND ? AND c.status = 1
							GROUP BY cp.cod_compra ORDER BY c.fecha";
				break;
				case 'venta':
				$this->sql="SELECT v.num_fact, c.cedula, CONCAT(c.nombre,' ',c.apellido) as nombre,
							v.fecha, CONCAT(IF(MOD(v.monto / cm.cambio, 1) >= 0.5, CEILING(v.monto / cm.cambio), FLOOR(v.monto / cm.cambio) + 0.5), ' ', m.nombre) as 'total_divisa' ,v.monto  
							FROM venta v 
							INNER JOIN cliente c 
								ON v.cedula_cliente = c.cedula
							INNER JOIN cambio cm 
								ON cm.id_cambio = v.cod_cambio
							INNER JOIN moneda m 
								ON m.id_moneda = cm.moneda
							WHERE v.fecha BETWEEN CONCAT(?, ' 00:00:00') AND CONCAT(?, ' 23:59:59') AND c.status = 1
							ORDER BY v.fecha";
				break;
				
				default:
				echo json_encode(['Error' => 'Tipo de reporte inválido.']);
				break;
			}


			try {

				$new = $this->con->prepare($this->sql);
				$new->bindValue(1, $this->fechaInicio);
				$new->bindValue(2, $this->fechaFinal);
				$new->execute();

				$reporte = $new->fetchAll();
				return $reporte;

			} catch (\PDOException $e) {
				return $e;
			}
		}

		public function getMostrarReporte($tipo, $inicio, $final){
			$this->tipo = $tipo;
			$this->fechaInicio = $inicio;
			$this->fechaFinal = $final;

			$this->mostrarReporte();
		}

		private function mostrarReporte(){
			$this->reporte = $this->obtenerReporte();	
			echo json_encode($this->reporte);
			die();

		}

		public function getExportar($tipo, $fecha1, $fecha2){
			$this->tipo = $tipo;
			$this->fechaInicio = $fecha1;
			$this->fechaFinal = $fecha2;

			$this->exportarReporte();
		}

		private function exportarReporte(){
			$reporte = $this->obtenerReporte();
			if(empty($reporte)){
				die(json_encode(['Error' => 'Reporte vacío.']));
			}
			$fechaI = date('d-m-Y', strtotime($this->fechaInicio));
			$fechaF = date('d-m-Y', strtotime($this->fechaFinal));
			$nombre = ($this->tipo == 'compra') ? 'compras_'.$fechaI.'_'.$fechaF.'.pdf' : 'ventas_'.$fechaI.'_'.$fechaF.'.pdf';
			$titulo = ($this->tipo == 'compra') ? 'Reporte de Compras' : 'Reporte de Ventas';
			$subTitulo = $fechaI.' a '.$fechaF;
			$columnas = ($this->tipo == 'compra') ? [0 => 'Orden', 1 => 'Proveedor', 2 => 'Cantidad', 3 => 'Fecha', 4 => 'Total Divisa', 5 => 'Monto Total'] : [0 => 'N°', 1 => 'Cédula', 2 => 'Nombre', 3 => 'Fecha', 4 => 'Total Divisa', 5 => 'Monto Total'];

			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetMargins(15,30,15);
			
			$pdf->Image('assets/img/Logo_titulo.png',15,5,40);
			$pdf->SetFont('Arial','B',16);
			$pdf->setX(20);
			$pdf->setY(15);
			$pdf->Cell(0,10,$titulo,0,1,'C');
			$pdf->Cell(0,10,$subTitulo,0,0,'C');
			$pdf->Ln(18); 

			$pdf->SetFont('Helvetica','B',9);
			$pdf->SetFillColor(210, 224, 137);

			$pdf->Cell(20,10,utf8_decode($columnas[0]),1,0,'C',1);
			$pdf->Cell(30,10,utf8_decode($columnas[1]),1,0,'C',1);
			$pdf->Cell(35,10,utf8_decode($columnas[2]),1,0,'C',1);
			$pdf->Cell(35,10,utf8_decode($columnas[3]),1,0,'C',1);
			$pdf->Cell(30,10,utf8_decode($columnas[4]),1,0,'C',1);
			$pdf->Cell(30,10,utf8_decode($columnas[5]),1,1,'C',1);

			$pdf->SetFont('Arial','',9);
			$pdf->SetFillColor(245,245,245);

			$total = 0;

			foreach ($reporte as $col => $value) {

				$pdf->Cell(20,10,utf8_decode($value[0]),1,0,'C',1);
				$pdf->Cell(30,10,utf8_decode($value[1]),1,0,'C',1);
				$pdf->Cell(35,10,utf8_decode($value[2]),1,0,'C',1);
				$pdf->Cell(35,10,utf8_decode($value[3]),1,0,'C',1);
				$pdf->Cell(30,10,utf8_decode($value[4]),1,0,'C',1);
				$pdf->Cell(30,10,utf8_decode($value[5]),1,1,'C',1);
				$total += $value[5];
			}
			
			$pdf->SetFillColor(210, 224, 137);
			$pdf->setX(135);
			$pdf->Cell(30,10,utf8_decode('Monto total'),1,0,'C',1);
			$pdf->Cell(30,10,utf8_decode($total),1,1,'C',1);

			$repositorio = 'assets/reportes/'.$nombre;
			$pdf->Output('F',$repositorio);
			
			$respuesta = ['respuesta' => 'Archivo guardado', 'ruta' => $repositorio];
			echo json_encode($respuesta);
			die();
		}

	}


?>