<?php  
	
	namespace modelo;
	use config\connect\DBConnect as DBConnect;

	class carrito extends DBConnect{

		private $user;

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
	}


?>