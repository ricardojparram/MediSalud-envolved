<?php  

	namespace modelo;
	use config\connect\DBConnect;

	class comprobarPago extends DBConnect{



		public function __construct(){
			parent::__construct();
		}

		public function mostrarPagos($bitacora){
			try{
				$this->conectarDB();
				$query='SELECT p.id_pago, v.num_fact, c.cedula, CONCAT(c.nombre, " ", c.apellido) as nombre_cliente, p.monto_total, p.status FROM pago p 
						INNER JOIN venta v ON v.num_fact = p.num_fact
						INNER JOIN cliente c ON c.cedula = v.cedula_cliente
						WHERE v.online = 1;';
				$new = $this->con->prepare($query);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				if($bitacora === "true") $this->binnacle("Comprobar pagos",$_SESSION['cedula'],"Consultó listado.");
				$this->desconectarDB();
				die(json_encode($data));
				
			}catch(\PDOexection $e){
				print("Error!: ".$e);
				die();
			}
		}

	}

?>