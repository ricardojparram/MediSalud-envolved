<?php  
	
	namespace modelo;
	use config\connect\DBConnect as DBConnect;

	class carrito extends DBConnect{

		private $user;
		private $productos;
		private $cod_producto;
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
<<<<<<< HEAD
				$sql = "SELECT cod_producto, cantidad FROM carrito WHERE cedula = ?;";
=======
				$sql = "SELECT * FROM carrito c
				INNER JOIN producto p ON p.cod_producto = c.cod_producto 
				WHERE c.cedula = ?;";
>>>>>>> 47b90ecf60cdca7963cf419a73a4de5ff8a78247
				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->user);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				$this->desconectarDB();
<<<<<<< HEAD
				$resultado = ['resultado' => 'ok', 'carrito' => $data];
				die(json_encode($resultado));
=======
				die(json_encode($data));
>>>>>>> 47b90ecf60cdca7963cf419a73a4de5ff8a78247

			} catch (\PDOException $e) {
				die($e);
			}

		}

<<<<<<< HEAD
		public function getAgregarProducto($cedula, array $productos){
			$this->user = $cedula;
			$this->productos = $productos;
=======
		public function getAgregarProducto($cedula, $id, $cantidad){
			if(preg_match_all("/^[0-9]{1,10}$/", $cantidad) != 1){
				die(json_encode(['error' => 'Id inválida.']));
			}
			$this->id_producto = $id;
			$this->cantidad = $cantidad;
			$this->user = $cedula;
>>>>>>> 47b90ecf60cdca7963cf419a73a4de5ff8a78247

			$this->agregarAlCarrito();
		}

		private function agregarAlCarrito(){

			try {

<<<<<<< HEAD
				$this->conectarDB();
				$new = $this->con->prepare("DELETE FROM carrito WHERE cedula = ?");
				$new->bindValue(1, $this->user);
				$new->execute();

				foreach($this->productos as $producto){
					$new = $this->con->prepare("INSERT INTO carrito(cedula, cod_producto, cantidad)
												VALUES(?, ?, ?)");
					$new->bindValue(1,  $this->user);
					$new->bindValue(2,  $producto['cod_producto']);
					$new->bindValue(3,  $producto['cantidad']);
					$new->execute();
				}
				$this->desconectarDB();
				$resultado = ['resultado' => true, "msg" => "Se ha agregado el producto al carrito."];
				die(json_encode($resultado));

			}catch(\PDOException $e){
=======
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
>>>>>>> 47b90ecf60cdca7963cf419a73a4de5ff8a78247
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
					$new->bindValue(1, $producto['cod_producto']);
					$new->execute();
					$data = $new->fetchAll(\PDO::FETCH_OBJ);

					if($data[0]->stock >= $producto['cantidad']){
						$resultado = ['resultado' => true, 'msg' => 'Cantidad disponible.'];
						$respuesta[] = ['cod_producto' => $producto['cod_producto'], 'info' => $resultado];
					}else{
						$resultado = ['resultado' => false, 'msg' => 'Cantidad no disponible.'];
						$respuesta[] = ['cod_producto' => $producto['cod_producto'], 'info' => $resultado];
					}
				}
				$this->desconectarDB();
				die(json_encode($respuesta));

			} catch (\PDOException $e) {
				die($e);
			}

		}

<<<<<<< HEAD
		public function getEditarProd($cod_producto, $cantidad, $user){
			$this->cod_producto = $cod_producto;
=======
		public function getEditarProd($id_producto, $cantidad, $user){
			$this->id_producto = $id_producto;
>>>>>>> 47b90ecf60cdca7963cf419a73a4de5ff8a78247
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
				$new->bindValue(2, $this->cod_producto);
				$new->bindValue(3, $this->user);
				$new->execute();

				$query='SELECT c.cantidad, p.p_venta FROM carrito c
						INNER JOIN producto p ON c.cod_producto = p.cod_producto
						WHERE c.cedula = ? AND c.cod_producto = ?;';
				$new = $this->con->prepare($query);
				$new->bindValue(1, $this->user);
				$new->bindValue(2, $this->cod_producto);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				$info = ['cantidad' => $data[0]->cantidad, 'precioActual' => $data[0]->p_venta];
				$resultado;

				$resultado = ['resultado' => true, 'msg' => 'Se ha editado la cantidad correctamente.', 'info' => $info];
				$this->desconectarDB();
				die(json_encode($resultado));

			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function getEliminarProd($cod_producto, $user){
			$this->cod_producto = $cod_producto;
			$this->user = $user;

			$this->eliminarProd();
		}

		private function eliminarProd(){

			try {

				$this->conectarDB();
				$sql = "DELETE FROM carrito WHERE cod_producto = ? AND cedula = ?";
				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->cod_producto);
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