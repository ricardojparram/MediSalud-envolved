<?php  

	namespace modelo;
	use config\connect\DBConnect;

	class envios extends DBConnect{

		private $id_envio;
		private $estado;

		public function __construct(){
			parent::__construct();
		}

		public function mostrarEnvios($bitacora){
			try{
				$this->conectarDB();
				$query='SELECT v.num_fact, e.id_envio, e.status, e.fecha_envio, e.fecha_entrega, 
						CONCAT(c.nombre," ", c.apellido) as nombre_cliente, c.cedula, 
						CONCAT(emp.nombre," ",sd.ubicacion) as sede_empresa FROM envio e 
						INNER JOIN venta v ON v.id_envio = e.id_envio
						INNER JOIN cliente c ON c.cedula = v.cedula_cliente
						INNER JOIN sede_envio sd ON sd.id_sede = e.id_sede
						INNER JOIN empresa_envio emp ON emp.id_empresa = sd.id_empresa';
				$new = $this->con->prepare($query);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				if($bitacora === "true") $this->binnacle("Envios",$_SESSION['cedula'],"Consultó listado.");
				$this->desconectarDB();
				die(json_encode($data));
				
			}catch(\PDOexection $e){
				print("Error!: ".$e);
				die();
			}
		}

		public function getComprobacion($id_envio, $estado){
			$this->id_envio = $id_envio;
			$this->estado = $estado;

			$this->asignarEstadoEnvio();
		}

		private function asignarEstadoEnvio(){
			try{
				$this->conectarDB();
 				
 				$sql = [
 					"1" => "UPDATE envio SET status = ?, fecha_entrega = NOW() WHERE id_envio = ?;",
 					"2" => "UPDATE envio SET status = ?, fecha_envio = NOW() WHERE id_envio = ?;",
 					"3" => "UPDATE envio SET status = ?, fecha_envio = NULL, fecha_entrega = NULL WHERE id_envio = ?;"
 				];

				$new = $this->con->prepare($sql[$this->estado]);
				$new->bindValue(1, $this->estado);
				$new->bindValue(2, $this->id_envio);
				$resultado;
				if(!$new->execute()){
					$resultado = ['resultado' => 'error', 'msg' => 'Ha ocurrido un error en la base de datos.'];
				}

				$this->binnacle("Envios",$_SESSION['cedula'],"Modificó estado del envío #$this->id_envio.");
				$resultado = ['resultado' => 'ok', 'msg' => "Se ha actualizado el estado del envio correctamente."];
				$this->desconectarDB();
				die(json_encode($resultado));

			}catch(\PDOexection $e){
				print("Error!: ".$e);
				die();
			}

		}

		public function calcularPrecioEnvio(){
			$url = "http://agencias.com.ve/sys/ajax.php";

			$body = [
				"courier" => "MRW", 
				"cmd" => "calculo_tarifa", 
				"origen" => "",
				"destino" => "",
				"formapago" => "enorigen",
				"tipoenvio" => "age",
				"peso" => "1",
				"size_x" => "10",
				"size_y" => "10",
				"size_z" => "5",
				"valorseguro" => ""
			];

			$options = [
				'http' => [
					'method'  => 'POST',
					'header'  => "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
					'content' => http_build_query($body),
				]
			];

			$context = stream_context_create($options);

			$response = file_get_contents($url, false, $context);


			$dom = new DOMDocument();
			$dom->loadHTML($response);

			$total_envio =	$dom->getElementsByTagName('tbody')
								->item(0)->lastChild
								->childNodes->item(2)->textContent;

			$precio = floatval(str_replace('Bs. ', '', $total_envio));

			$resultado = ['precio_solo' => $precio, 'precio_bs' => "$total_envio"];
			die(json_encode($resultado));

		}

	}

?>