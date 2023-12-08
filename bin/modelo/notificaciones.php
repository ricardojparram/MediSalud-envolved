<?php  
	
	namespace modelo;
    use config\connect\DBConnect as DBConnect;

    class notificaciones extends DBConnect{

    	public function __construct(){
			parent::__construct();
		}

		public function getNotificaciones(){
			try {

				$this->conectarDB();
				$resultado = [
					'productos_vencidos' => $this->getProductosVencidos(),
					'productos_stock_bajo' => $this->getProductosStockBajo(),
					'dia_de_inventario' => $this->getDiaDeInventario()
				]; 

				$this->desconectarDB();
				die(json_encode($resultado));

			} catch (\PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}

		private function getProductosVencidos(){
			try {

				$query="SELECT p.cod_producto, p.nombre, DATEDIFF(p.vencimiento, NOW()) AS dias_vencidos,
						TIMEDIFF(DATE_FORMAT(p.vencimiento, '%Y-%m-%d %H:%i:%s'), NOW()) AS horas_vencidas FROM producto p 
						WHERE p.vencimiento < NOW() AND p.stock > 0 AND p.status = 1";
				$new = $this->con->prepare($query);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				return $data;
			} catch (\PDOException $e) {
				die($e);
			}
		}

		private function getDiaDeInventario(){
			try {

				$query="SELECT p.cod_producto , p.descripcion , v.fecha , p.stock , SUM(vp.cantidad) as cantidadXmes,
						SUM(vp.cantidad)/30 as dia_inventario FROM producto p 
						INNER JOIN venta_producto vp ON p.cod_producto = vp.cod_producto 
						INNER JOIN venta v ON v.num_fact = vp.num_fact 
						WHERE MONTH(v.fecha) = (MONTH(NOW())-1) AND p.status = 1 AND v.status = 1 
						GROUP BY p.cod_producto";
				$new2 = $this->con->prepare($query);
				$new2->execute();
				return $new2->fetchAll(\PDO::FETCH_OBJ);

			} catch (\PDOException $e) {
				die($e);
			}
		}

		private function getProductosStockBajo(){
			try {
				
				$query="SELECT p.cod_producto , p.descripcion , p.stock FROM producto p 
						WHERE p.stock <= 10 AND p.status = 1";
				$new = $this->con->prepare($query);
				$new->execute();
				return $new->fetchAll(\PDO::FETCH_OBJ);

			} catch (\PDOException $e) {
				die($e);
			}
		}

	}

?>