<?php 
	
	namespace modelo;
	use config\connect\DBConnect as DBConnect;
	use \PDO;

	class roles extends DBConnect{

		private $id;
		private $modulos;
		private $permisos;

		public function __construct(){
			parent::__construct();	
		}

		public function mostrarRoles(){

			try{

				$sql = 'SELECT * FROM(
							SELECT n.cod_nivel as id, n.nombre, COUNT(*) as totales FROM nivel n
							INNER JOIN usuario u
							ON u.nivel = n.cod_nivel
						    GROUP BY n.cod_nivel
						    UNION
						    SELECT n.cod_nivel, n.nombre, 0 as totales FROM nivel n
						) as tabla
						WHERE tabla.id != 1
						GROUP BY tabla.id;';
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

			try {

				$sql = 'SELECT m.nombre, p.id_modulo, p.status FROM permisos p
					INNER JOIN modulos m 
					ON m.id = p.id_modulo
					WHERE p.cod_nivel = ?';

				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->id);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				die(json_encode($data));
				
			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function getAccesoModulos($datos, $id){
			$this->modulos = $datos;
			$this->id = $id;

			$this->actualizarAccesoModulos();
		}

		private function actualizarAccesoModulos(){

			$sql = "UPDATE permisos SET status = ?
					WHERE cod_nivel = ? AND id_modulo = ?";

			foreach ($this->modulos as $modulo) {
				try{

					$new = $this->con->prepare($sql);
					$new->bindValue(1, $modulo['status']);
					$new->bindValue(2, $this->id);
					$new->bindValue(3, $modulo['id_modulo']);
					$new->execute();

				}catch(\PDOException $e){
					die($e);
				}
			}

			$respuesta = ['respuesta' => 'ok', 'msg' => 'Se ha actualizado el acceso a los módulos correctamente.'];
			die(json_encode($respuesta));

		}

		public function getPermisos($id){
			$this->id = $id;

			$this->mostrarPermisos();
		}

		private function mostrarPermisos(){

			try {
				
				$sql = 'SELECT m.nombre, p.id_modulo, p.consultar, p.registrar, p.editar, p.eliminar FROM permisos p
						INNER JOIN modulos m 
						ON m.id = p.id_modulo
						WHERE p.cod_nivel = ? AND p.status = 1;';

				$new = $this->con->prepare($sql);
				$new->bindValue(1, $this->id);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				die(json_encode($data));
				
			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function getDatosPermisos($datos, $id){
			$this->permisos = $datos;
			$this->id = $id;

			// die(json_encode($this->permisos));
			$this->actualizarPermisos();
		}

		private function actualizarPermisos(){

			try {
				
				$sql = "UPDATE permisos SET registrar = ?, consultar = ?, editar = ?, eliminar = ?
						WHERE id_modulo = ? AND cod_nivel = ?";

				foreach ($this->permisos as $modulo) {
					try{

						$new = $this->con->prepare($sql);
						$new->bindValue(1, $modulo['registrar']);
						$new->bindValue(2, $modulo['consultar']);
						$new->bindValue(3, $modulo['editar']);
						$new->bindValue(4, $modulo['eliminar']);
						$new->bindValue(5, $modulo['id_modulo']);
						$new->bindValue(6, $this->id);
						$new->execute();

					}catch(\PDOException $e){
						die($e);
					}
				}

				$respuesta = ['respuesta' => 'ok', 'msg' => 'Se han actualizado los permisos correctamente.'];
				die(json_encode($respuesta));

			} catch (\PDOException $e) {
				die($e);
			}

		}
	}

?>