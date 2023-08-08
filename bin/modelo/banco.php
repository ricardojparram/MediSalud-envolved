<?php 

namespace modelo;

use config\connect\DBConnect as DBConnect;

class banco extends DBConnect{

    private $id;
	private $nombre;
	private $cedulaRif;
	private $tipoP;
	private $telefono;
	private $cuentaBank;
	private $codBank;

	public function __construct(){
		parent::__construct();
	}

	public function mostrarBank(){

		try{

			$sql = 'SELECT b.id_banco , tp.des_tipo_pago , b.nombre , b.cedulaRif , b.telefono , b.NumCuenta , b.CodBanco FROM banco b INNER JOIN tipo_pago tp ON b.tipo_pago = tp.cod_tipo_pago WHERE b.status = 1 and tp.online = 1';

			$new = $this->con->prepare($sql);
			$new->execute();
			$data = $new->fetchAll(\PDO::FETCH_OBJ);
			echo json_encode($data);
			die();

		}catch(\PDOException $e){
			die($e);
		}

	}

	public function SelecTipoPago(){
		try{

			$sql = 'SELECT `cod_tipo_pago`, `des_tipo_pago`, `online`, `status` FROM `tipo_pago` WHERE status = 1 and online = 1';

			$new = $this->con->prepare($sql);
			$new->execute();
			$data = $new->fetchAll(\PDO::FETCH_OBJ);
			echo json_encode($data);
			die();

		}catch(\PDOException $e){
			die($e);
		}

	}

	public function validarTipoP($id){
     
		if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
			echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
			die();
		}

        $this->id = $id;

        return $this->validarT();
	}

	private function validarT(){

		try{
			$new = $this->con->prepare("SELECT * FROM tipo_pago tp WHERE tp.online = 1 and tp.status = 1 and tp.cod_tipo_pago = ?");
			$new->bindValue(1, $this->id);
			$new->execute();
			$data = $new->fetchAll();

			if(isset($data[0]['cod_tipo_pago'])) {
				echo json_encode(['resultado' => 'Codigo tipo válido.']);
				die();
			}else{
				echo json_encode(['resultado' => 'Error de tipoP', 'error' => 'El tipo pago no está registrado.']);
				die();
			}

		}catch(\PDOException $e){
			die($e);
		}
	}

	public function ValidarDatos($tipoP, $nombre ,$cedulaRif){
		if(preg_match_all("/^[0-9]{1,10}$/", $tipoP) != 1){
			echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
			die();
		}

		if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $nombre) !== 1){
			echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
			die();
		}

		if(preg_match_all("/^[0-9]{7,10}$/", $cedulaRif) != 1) {
			echo json_encode(['resultado' => 'Error de rif o cedula','error' => 'Rif o cedula inválido.']);
			die();
		}

		$this->tipoP = $tipoP;
		$this->nombre = $nombre;
		$this->cedulaRif = $cedulaRif;

		return $this->validDatos();
	}

	private function validDatos(){
		try {
			$new = $this->con->prepare('SELECT * FROM banco b WHERE b.tipo_pago = ? and b.nombre = ? and b.cedulaRif = ? and b.status = 1');
			$new->bindValue(1, $this->tipoP);
			$new->bindValue(2, $this->nombre);
			$new->bindValue(3, $this->cedulaRif);
			$new->execute();
			$data = $new->fetchAll();
            
			if (isset($data[0])) {
				echo json_encode(['resultado' => 'Error Datos', 'error' => 'Cedula ya registrada al mismo tipo de pago y banco']);
				die();
			}else{
				echo json_encode(['resultado' => 'Datos validos']);
				die();
			}
		} catch (\PDOException $e) {
			die($e);
		}

	}

	public function getRegistrarBanco($datos){

		$datosA = $datos;
		$count = count($datosA);

		switch ($count) {

			case 4 :

			if(preg_match_all("/^[0-9]{1,10}$/", $datosA[0]) != 1){
				echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
				die();
			}

			if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $datosA[1]) !== 1){
				echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
				die();
			}

			if(preg_match_all("/^[0-9]{7,10}$/", $datosA[2]) != 1) {
				echo json_encode(['resultado' => 'Error de rif o cedula','error' => 'Rif o cedula inválido.']);
				die();
			}
			if(preg_match_all("/^(?=.*[0-9])(?=.*[-])[0-9-]{1,25}$/", $datosA[3]) != 1){
				echo json_encode(['resultado' => 'Error de cuenta de Banco','error' => 'Cuenta de Banco inválida.']);
				die();
			}

			$this->tipoP = $datosA[0];
			$this->nombre = $datosA[1];
			$this->cedulaRif = $datosA[2];
			$this->cuentaBank = $datosA[3];

            return $this->registrarBanco();
			break;

			case 5 :
			
			if(preg_match_all("/^[0-9]{1,10}$/", $datosA[0]) != 1){
				echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
				die();
			}

			if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $datosA[1]) !== 1){
				echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
				die();
			}

			if(preg_match_all("/^[0-9]{7,10}$/", $datosA[2]) != 1) {
				echo json_encode(['resultado' => 'Error de rif o cedula','error' => 'Rif o cedula inválido.']);
				die();
			}
			if(preg_match_all("/^[0-9]{1,10}$/", $datosA[3]) != 1){
				echo json_encode(['resultado' => 'Error de Codigo Banco','error' => 'Codigo Banco inválida.']);
				die();
			}
			if(preg_match_all("/^[0-9]{10,30}$/", $datosA[4]) != 1){
				echo json_encode(['resultado' => 'Error de telefono','error' => 'telefono inválida.']);
				die();
			}
            
			$this->tipoP = $datosA[0];
			$this->nombre = $datosA[1];
			$this->cedulaRif = $datosA[2];
			$this->codBank = $datosA[3];
			$this->telefono = $datosA[4];

            return $this->registrarBanco();
			break;

			default:
			die("Error");
			break;
		} 

	}

	private function registrarBanco(){

		try {
        $new = $this->con->prepare("INSERT INTO `banco`(`id_banco`, `tipo_pago`, `nombre`, `cedulaRif`, `telefono`, `NumCuenta`, `CodBanco`, `status`) VALUES (DEFAULT,?,?,?,?,?,?,1)");
        $new->bindValue(1 ,$this->tipoP);
        $new->bindValue(2 ,$this->nombre);
        $new->bindValue(3 ,$this->cedulaRif);
        $new->bindValue(4 ,$this->telefono);
        $new->bindValue(5 ,$this->cuentaBank);
        $new->bindValue(6 ,$this->codBank);
        $new->execute();
        $data = $new->fetchAll(); 
        $resultado = ['resultado' => 'banco registrado.'];
        echo json_encode($resultado);
        die();
		} catch (\PDOException $e) {
			die($e);
		}

	}

    public function validarSelect($id){

      if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
      	echo json_encode(['resultado' => 'Error de id','error' => 'id inválida.']);
      	die();
      }

      $this->id = $id;

      $new = $this->con->prepare("SELECT * FROM banco b WHERE b.status = 1 and b.id_banco = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $data = $new->fetchAll();

      if(isset($data[0]["id_banco"])){
        echo json_encode(['resultado' => 'Si existe esa banco.', 'tipo' => $data[0]['tipo_pago'] ]);
        die();
      }else{
       echo json_encode(['resultado' => 'Error de banco']);
       die();
     }
    }

}

?>