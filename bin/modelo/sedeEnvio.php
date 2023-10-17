<?php  

	namespace modelo;
	use config\connect\DBConnect as DBConnect;

	class sedeEnvio extends DBConnect{

		private $empresa;
		private $ubicacion;
		private $id;

		public function __construct(){
			parent::__construct();    
		}

		public function mostrarSedes($bitacora = false){
			try{
				$this->conectarDB();
				$sql = "SELECT s.id_sede, e.nombre, s.ubicacion, s.id_empresa FROM sede_envio s
						INNER JOIN empresa_envio e ON s.id_empresa = e.id_empresa
						WHERE s.status = 1;";
				$new = $this->con->prepare($sql);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				if($bitacora ===  "true") $this->binnacle("Sede de envío",$_SESSION['cedula'],"Consultó listado.");
				$this->desconectarDB();
				die(json_encode($data));

			}catch(\PDOException $e){
				return $e;
			}
		}

		public function selectEmpresas(){
			try{
				$this->conectarDB();
				$sql = "SELECT * FROM empresa_envio WHERE status = 1";
				$new = $this->con->prepare($sql);
				$new->execute();
				$this->desconectarDB();
				return $new->fetchAll(\PDO::FETCH_OBJ);

			}catch(\PDOException $e){
				die($e);
			}
		}

		public function validarEmpresa($empresa){
			$this->empresa = $empresa;
			try {
				$this->conectarDB();
				$new = $this->con->prepare('SELECT * FROM empresa_envio WHERE id_empresa = ? AND status = 1');
				$new->bindValue(1,$this->empresa);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				$this->desconectarDB();
				return isset($data[0]->id_empresa);

			} catch (\PDOException $e) {
				die($e);
			}
		}

		public function getRegistrarSede($empresa, $ubicacion){

			if(preg_match_all('/^[a-zA-ZÀ-ÿ0-9\s,.\-\/\'"#]{7,70}$/', $ubicacion) != 1){
				echo json_encode(['resultado' => 'Error de sede','error' => 'Direccion inválida.']);
				die();
			}
			if(preg_match_all("/^[0-9]{1,5}$/", $empresa) != 1){
				echo json_encode(['resultado' => 'Error de empresa','error' => 'Empresa inválido.']);
				die();
			}

			$this->empresa = $empresa;
			$this->ubicacion = $ubicacion;

			if($this->validarEmpresa($this->empresa)){
				$this->registrarSede();
			}else{
				die(json_encode(['resultado' => false, 'msg' => 'La empresa no existe.']));
			}
		}

		private function registrarSede(){

			try{
				$this->conectarDB();
				$new = $this->con->prepare("INSERT INTO sede_envio(id_sede, ubicacion, id_empresa, status) VALUES (DEFAULT,?, ?, 1)");
				$new->bindValue(1, $this->ubicacion); 
				$new->bindValue(2, $this->empresa); 
				$new->execute();

				$resultado = ['resultado' => true, 'msg' => 'Sede registrada.'];
				$this->binnacle("Sede de envío",$_SESSION['cedula'],"Registró sede de envío .");
				$this->desconectarDB();
				die(json_encode($resultado));


			}catch(\PDOException $error){
				return $error;
			} 

		}

		public function getSede($id){

			if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
				echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
				die();
			}

			$this->id = $id;

			return $this->selectSede();
		}

		private function selectSede(){

			try{
				$this->conectarDB();
				$new = $this->con->prepare("SELECT * FROM sede_envio WHERE id_sede = ? AND status = 1;");
				$new->bindValue(1, $this->id);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				$this->desconectarDB();
				if(!isset($data[0])){
					return false;
				}else{
					return $data[0];
				}

			}catch(\PDOException $e){
				return $e;
			}

		}

		public function getEditarSede($empresa, $ubicacion, $id){

			if(preg_match_all('/^[a-zA-ZÀ-ÿ0-9\s,.\-\/\'"#]{7,70}$/', $ubicacion) != 1){
				echo json_encode(['resultado' => 'Error de sede','error' => 'Direccion inválida.']);
				die();
			}
			if(preg_match_all("/^[0-9]{1,5}$/", $empresa) != 1){
				echo json_encode(['resultado' => 'Error de empresa','error' => 'Empresa inválido.']);
				die();
			}

			$this->empresa = $empresa;
			$this->ubicacion = $ubicacion;
			$this->id = $id;

			if($this->validarEmpresa($this->empresa)){
				if($this->selectSede() != false){
					$this->editarSede();
				}
			}else{
				die(json_encode(['resultado' => false, 'msg' => 'La empresa no existe.']));
			}

		}

		private function editarSede(){

			try{
				$this->conectarDB();
				$new = $this->con->prepare("
					UPDATE sede_envio SET ubicacion = ?, id_empresa = ? 
					WHERE id_sede = ?;");
				$new->bindValue(1, $this->ubicacion);
				$new->bindValue(2, $this->empresa);
				$new->bindValue(3, $this->id);
				$new->execute();

				$this->binnacle("Sede de envío",$_SESSION['cedula'],"Editó sede de envío.");
				$resultado = ['resultado' => true, 'msg' => 'Sede de envío editada.'];
				$this->desconectarDB();
				die(json_encode($resultado));

			}catch(\PDOException $error){
				echo json_encode($error);
				die();
			}

		} 


		public function getEliminarSede($id){
			if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
				echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
				die();
			}

			$this->id = $id;

			if($this->selectSede() != false){
				$this->eliminarSede();
			}else {
				die(json_encode(['resultado' => true, 'msg' => 'La sede de envío no existe.']));
			}
		}

		private function eliminarSede(){
			try{
				$this->conectarDB();
				$new = $this->con->prepare("UPDATE sede_envio SET status = 0 WHERE id_sede = ?;");
				$new->bindValue(1, $this->id);
				$new->execute();
				$this->binnacle("Sede de envío",$_SESSION['cedula'],"Eliminó sede de envío.");
				$this->desconectarDB();
				$resultado = ['resultado' => true, 'msg' => 'Se eliminó la sede correctamente.'];
				die(json_encode($resultado));

			}catch(\PDOException $e){
				return $e;
			}

		}

	}

?>