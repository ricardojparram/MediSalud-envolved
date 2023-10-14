<?php 
	
	namespace modelo;
	use config\connect\DBConnect as DBConnect;
	use \PDO;

	class roles extends DBConnect{

		private $id_rol;
		private $modulos;
		private $permisos;
		private array $roles;

		public function __construct(){
			parent::__construct();	
			$this->getRoles();
		}

		private function getRoles(){
			try{

				$this->conectarDB();
				$new = $this->con->prepare("SELECT id_rol as id, nombre FROM rol");
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_ASSOC);
				foreach ($data as $rol) {
					$this->roles[$rol['id']] = $rol['nombre'];
				}

			}catch(\PDOException $e){
				die($e);
			}
		}

		public function mostrarRoles($bitacora){

			try{
				$this->conectarDB();
				$sql = 'SELECT * FROM(
							SELECT r.id_rol as id, r.nombre, COUNT(*) as totales FROM rol r
							INNER JOIN usuario u
							ON u.rol = r.id_rol
						    GROUP BY r.id_rol
						    UNION
						    SELECT r.id_rol, r.nombre, 0 as totales FROM rol r
						) as tabla
						WHERE tabla.id != 1
						GROUP BY tabla.id;';
				$new = $this->con->prepare($sql);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				if($bitacora == "true") $this->binnacle("Roles",$_SESSION['cedula'],"Consultó listado.");
				$this->desconectarDB();
				die(json_encode($data));

			}catch(\PDOException $e){
				die($e);
			}
		}

		public function getPermisos($id){
			$this->id_rol = $id;

			$this->mostrarPermisos();
		}

		private function mostrarPermisos(){

			try {
				
				$this->conectarDB();
				$new = $this->con->prepare('SELECT id_modulo, nombre FROM modulos WHERE status = 1');
				$new->execute();
				$modulos = $new->fetchAll(\PDO::FETCH_OBJ);
				$permisos = [];
				foreach ($modulos as $modulo) { $permisos[$modulo->nombre] = ""; }

				$query='SELECT p.id_permiso, p.nombre_accion, p.status FROM permisos p
						INNER JOIN modulos m ON m.id_modulo = p.id_modulo
						WHERE p.id_rol = ? AND m.nombre = ? AND m.status = 1';

				foreach ($permisos as $nombre_modulo => $valor) {

					$new = $this->con->prepare($query);
					$new->bindValue(1, $this->id_rol);
					$new->bindValue(2, $nombre_modulo);
					$new->execute();
					$data = $new->fetchAll(\PDO::FETCH_OBJ);
					$acciones = []; 

					foreach($data as $permiso){
						$acciones += [$permiso->nombre_accion => [
							"id_permiso" => $permiso->id_permiso,
							"status" => $permiso->status]
						];
					}
					$permisos[$nombre_modulo] = $acciones;
				}
				$this->binnacle("Roles",$_SESSION['cedula'],"Consultó el los permisos del rol {$this->roles[$this->id_rol]}.");
				$this->desconectarDB();
				die(json_encode($permisos));
				
			} catch (\PDOException $e) {
				die($e);
			}

		}

		public function getDatosPermisos($datos, $id){
			$this->permisos = $datos;
			$this->id_rol = $id;

			$this->actualizarPermisos();
		}

		private function actualizarPermisos(){

			try {
				
				$this->conectarDB();
				$sql = "UPDATE permisos SET status = ? WHERE id_permiso = ?";

				foreach ($this->permisos as $modulo) {
					try{

						$status = ($modulo['status'] === "true") ? 1 : 0;
						$new = $this->con->prepare($sql);
						$new->bindValue(1, $status);
						$new->bindValue(2, $modulo['id_permiso']);
						$new->execute();

					}catch(\PDOException $e){
						die($e);
					}
				}
				$respuesta = ['respuesta' => 'ok', 'msg' => 'Se han actualizado los permisos correctamente.'];
				$this->binnacle("Roles",$_SESSION['cedula'],"Actualizó los permisos del rol {$this->roles[$this->id_rol]}.");
				$this->desconectarDB();
				die(json_encode($respuesta));

			} catch (\PDOException $e) {
				die($e);
			}

		}
	}

?>