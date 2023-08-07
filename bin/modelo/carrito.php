<?php  
	
	namespace modelo;
	use config\connect\DBConnect as DBConnect;

	class carrito extends DBConnect{

		private $user;
		private $productos;
		private $id_producto;
		private $cantidad;

		public function __construct(){
			parent::__construct();
		}

		public function getCarritoUsuario($user){
			$this->user = $user;

			$this->mostrarCarrito();
		}

		private function mostrarCarrito(){

			try {

				$sql = "SELECT * FROM carrito c
				INNER JOIN producto p ON p.cod_producto = c.cod_producto 
				WHERE c.cedula = ?;";
				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->user);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				die(json_encode($data));

			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function getValidarStock(array $productos){
			$this->productos = $productos;

			$this->validarStock();
		}

		private function validarStock(){

			try {

				$respuesta = [];
				foreach($this->productos as $producto){

					$sql = 'SELECT stock FROM producto WHERE cod_producto = ?;';
					$new = $this->con->prepare($sql);
					$new->bindValue(1, $producto['id_producto']);
					$new->execute();
					$data = $new->fetchAll(\PDO::FETCH_OBJ);

					if($data[0]->stock >= $producto['cantidad']){
						$resultado = ['resultado' => true, 'msg' => 'Cantidad disponible.'];
						$respuesta[] = ['id_producto' => $producto['id_producto'], 'info' => $resultado];
					}else{
						$resultado = ['resultado' => false, 'msg' => 'Cantidad no disponible.'];
						$respuesta[] = ['id_producto' => $producto['id_producto'], 'info' => $resultado];
					}
				}

				die(json_encode($respuesta));

			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function getEditarProd($id_producto, $cantidad){
			$this->id_producto = $id_producto;
			$this->cantidad = $cantidad;

			$this->editarProducto();
		}

		private function editarProducto(){

			try {

				$sql = 'UPDATE carrito SET cantidad = ? WHERE cod_producto = ?';
				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->cantidad);
				$new->bindValue(2, $this->id_producto);
				$resultado;
				
				if($new->execute()){
					$resultado = ['resultado' => true, 'msg' => 'Se ha editado la cantidad correctamente.'];
				}else{
					$resultado = ['resultado' => false, 'msg' => 'Ha ocurrido un error.'];
				}

				die(json_encode($resultado));

			} catch (\PDOException $e) {
				die($e);
			}

		}

	}


?>