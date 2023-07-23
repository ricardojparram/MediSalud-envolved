<?php 
	
	namespace modelo;
	use config\connect\DBConnect as DBConnect;
	use \PDO;

	class roles extends DBConnect{

		private $id;

		public function __construct(){
			parent::__construct();	
		}

		public function mostrarRoles(){

			try{

				$sql = 'SELECT n.cod_nivel as id, n.nombre, COUNT(*) as totales FROM nivel n
						INNER JOIN usuario u
						ON n.cod_nivel = u.nivel
						WHERE n.cod_nivel != 1 AND n.status = 1
						GROUP BY n.cod_nivel;';
				$new = $this->con->prepare($sql);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				die(json_encode($data));

			}catch(\PDOException $e){
				die($e);
			}
		}

		public function getModulo($id){
			$this->id = $id;

			$this->selectModulo();
		}

		private function selectModulo(){

			$sql = 'SELECT m.nombre, p.id_modulo, p.status FROM permisos p
				INNER JOIN modulos m 
				ON m.id = p.id_modulo
				WHERE p.cod_nivel = ?';

			$new = $this->con->prepare($sql);
			$new->bindValue(1, $this->id);
			$new->execute();
			$data = $new->fetchAll(\PDO::FETCH_OBJ);

			die(json_encode($data));

		}
	}

?>