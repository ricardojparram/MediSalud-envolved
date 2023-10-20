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

				$this->conectarDB();
				$sql = "SELECT * FROM carrito c
				INNER JOIN producto p ON p.cod_producto = c.cod_producto 
				WHERE c.cedula = ?;";
				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->user);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				$this->desconectarDB();
				die(json_encode($data));

			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function getAgregarProducto($cedula, $id, $cantidad){
			if(preg_match_all("/^[0-9]{1,10}$/", $cantidad) != 1){
				die(json_encode(['error' => 'Id inválida.']));
			}
			$this->id_producto = $id;
			$this->cantidad = $cantidad;
			$this->user = $cedula;

			$this->agregarAlCarrito();
		}

		private function agregarAlCarrito(){

			try {

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

				$resultado = ['resultado' => true, "msg" => "Se ha agregado el producto al carrito."];
				die(json_encode($resultado));

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
				$this->conectarDB();
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
				$this->desconectarDB();
				die(json_encode($respuesta));

			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function getEditarProd($id_producto, $cantidad, $user){
			$this->id_producto = $id_producto;
			if(preg_match_all("/^[0-9]{1,10}$/", $cantidad) != 1){
				die(json_encode(['error' => 'Id inválida.']));
			}
			$this->cantidad = $cantidad;
			$this->user = $user;

			$this->editarProducto();
		}

		private function editarProducto(){

			try {
				$this->conectarDB();
				$sql = 'UPDATE carrito SET cantidad = ? 
						WHERE cod_producto = ? AND cedula = ?';
				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->cantidad);
				$new->bindValue(2, $this->id_producto);
				$new->bindValue(3, $this->user);
				$new->execute();

				$query = 'SELECT cantidad, precioActual FROM carrito
						WHERE cedula = ? AND cod_producto = ?';
				$new = $this->con->prepare($query);
				$new->bindValue(1, $this->user);
				$new->bindValue(2, $this->id_producto);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				$info = ['cantidad' => $data[0]->cantidad, 'precioActual' => $data[0]->precioActual];
				$resultado;

				$resultado = ['resultado' => true, 'msg' => 'Se ha editado la cantidad correctamente.', 'info' => $info];
				$this->desconectarDB();
				die(json_encode($resultado));

			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function getEliminarProd($id_producto, $user){
			$this->id_producto = $id_producto;
			$this->user = $user;

			$this->eliminarProd();
		}

		private function eliminarProd(){

			try {

				$this->conectarDB();
				$sql = "DELETE FROM carrito WHERE cod_producto = ? AND cedula = ?";
				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->id_producto);
				$new->bindValue(2, $this->user);
				$resultado = [];

				if($new->execute() === true){
					$resultado = ['resultado' => true, 'msg' => 'Se ha eliminado el producto del carrito.'];
				}else{
					$resultado = ['resultado' => false, 'msg' => 'Ha ocurrido un error.'];
				}
				$this->desconectarDB();
				die(json_encode($resultado));

			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function vaciarCarrito($user){
			$this->user = $user;

			try {

				$this->conectarDB();
				$sql = 'DELETE FROM carrito WHERE cedula = ?';
				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->user);
			
				$resultado;
				if($new->execute()){
					$resultado = ['resultado' => true, 'msg' => 'Se ha vaciado el carrito correctamente.'];
				}else{
					$resultado = ['resultado' => false, 'msg' => 'Ha ocurrido un error.'];
				}
				$this->desconectarDB();
				die(json_encode($resultado));
				
			} catch (\PDOException $e) {
				die($e);
			}
		}

	}


?>