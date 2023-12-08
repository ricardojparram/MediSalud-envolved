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


	public function mostrarBank($bitacora = false){

		try{
			parent::conectarDB();
			$sql = 'SELECT df.id_datos_cobro , df.rif_cedula, df.telefono , b.codigo , b.nombre FROM datos_cobro_farmacia df INNER JOIN banco b ON b.id_banco = df.id_banco WHERE df.status = 1';

			$new = $this->con->prepare($sql);
			$new->execute();
			$data = $new->fetchAll(\PDO::FETCH_OBJ);
			echo json_encode($data);
			if($bitacora) $this->binnacle("Banco",$_SESSION['cedula'],"Consultó listado.");
			parent::desconectarDB();
			die();

		}catch(\PDOException $e){
			die($e);
		}

	}

	public function datosBanco(){
		try{
			parent::conectarDB();
			
			$new = $this->con->prepare('SELECT b.id_banco, b.nombre, b.codigo, b.status FROM banco b WHERE b.status = 1');
			$new->execute();
			$data = $new->fetchAll(\PDO::FETCH_OBJ);
			return $data;
			parent::desconectarDB();


		}catch(\PDOException $e){
			die($e);
		}
	}

	public function SelecTipoPago(){
		try{
        	parent::conectarDB();
			$sql = 'SELECT tp.id_tipo_pago, tp.des_tipo_pago , tp.online FROM tipo_pago tp WHERE tp.online = 1 and tp.status = 1';

			$new = $this->con->prepare($sql);
			$new->execute();
			$data = $new->fetchAll(\PDO::FETCH_OBJ);
			echo json_encode($data);
			parent::desconectarDB();
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
			parent::conectarDB();
			$new = $this->con->prepare("SELECT * FROM tipo_pago tp WHERE tp.online = 1 and tp.status = 1 and tp.id_tipo_pago = ?");
			$new->bindValue(1, $this->id);
			$new->execute();
			$data = $new->fetchAll();

			parent::desconectarDB();

			if(isset($data[0]['id_tipo_pago'])) {
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

	public function ValidarDatos($tipoP, $tipo ,$cedulaRif ,$id){
		if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $tipoP) != 1){
			echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
			die();
		}

		if(preg_match_all("/^(?=.*[0-9])(?=.*[-])[0-9-]{1,25}$|^[0-9]{3,50}$/", $tipo) !== 1){
			echo json_encode(['resultado' => 'Error telefono o cuenta','error' => 'Tipo pago inválida.']);
			die();
		}

		if(preg_match_all("/^[0-9]{7,10}$/", $cedulaRif) != 1) {
			echo json_encode(['resultado' => 'Error de rif o cedula','error' => 'Rif o cedula inválido.']);
			die();
		}

		$this->tipoP = $tipoP;
		$this->nombre = $tipo;
		$this->cedulaRif = $cedulaRif;

		if ($id != null) {
		  
		  $this->id = $id;

		  $this->validDatosEdit();

		}else{

		  $this->validDatos();

		}


	}

	private function validDatos(){
		try {
			parent::conectarDB();
			$new = $this->con->prepare("SELECT * FROM (SELECT 'Pago movil' as  tipo_pago, id_datos_cobro as id, rif_cedula, telefono as tipo, id_banco as banco FROM datos_cobro_farmacia
				WHERE telefono IS NOT NULL
				UNION 
				SELECT 'Transferencia' as tipo_pago, id_datos_cobro, rif_cedula, num_cuenta, id_banco FROM datos_cobro_farmacia
				WHERE num_cuenta IS NOT NULL
				) as detalle
				WHERE detalle.tipo_pago = ? AND detalle.tipo = ? AND detalle.rif_cedula = ?");
			$new->bindValue(1, $this->tipoP);
			$new->bindValue(2, $this->nombre);
			$new->bindValue(3, $this->cedulaRif);
			$new->execute();
			$data = $new->fetchAll();

			parent::desconectarDB();
            
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

	private function validDatosEdit(){
		try {
		parent::conectarDB();
		$new = $this->con->prepare("SELECT * FROM (SELECT 'Pago movil' as  tipo_pago, id_datos_cobro as id, rif_cedula, telefono as tipo, id_banco as banco FROM datos_cobro_farmacia
				WHERE telefono IS NOT NULL
				UNION 
				SELECT 'Transferencia' as tipo_pago, id_datos_cobro, rif_cedula, num_cuenta, id_banco FROM datos_cobro_farmacia
				WHERE num_cuenta IS NOT NULL
				) as detalle
				WHERE detalle.tipo_pago = ? AND detalle.tipo = ? AND detalle.rif_cedula = ? AND detalle.id_datos_cobro != ?");
		$new->bindValue(1, $this->tipoP);
		$new->bindValue(2, $this->nombre);
		$new->bindValue(3, $this->cedulaRif);
		$new->bindValue(4, $this->id);
		$new->execute();
		$data = $new->fetchAll();

		parent::desconectarDB();

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

		switch ($datosA[0]) {

			case 'Transferencia' :


			if(preg_match_all("/^[0-9]{1,10}$/", $datosA[1]) !== 1){
				echo json_encode(['resultado' => 'Error de Nombre banco','error' => 'Nombre banco inválida.']);
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

			$this->nombre = $datosA[1];
			$this->cedulaRif = $datosA[2];
			$this->cuentaBank = $datosA[3];

            return $this->registrarBanco();
			break;

			case 'Pago movil' :
			

			if(preg_match_all("/^[0-9]{1,10}$/", $datosA[1]) !== 1){
				echo json_encode(['resultado' => 'Error de Nombre banco','error' => 'Nombre banco inválida.']);
				die();
			}

			if(preg_match_all("/^[0-9]{7,10}$/", $datosA[2]) != 1) {
				echo json_encode(['resultado' => 'Error de rif o cedula','error' => 'Rif o cedula inválido.']);
				die();
			}

			if(preg_match_all("/^[0-9]{10,30}$/", $datosA[3]) != 1){
				echo json_encode(['resultado' => 'Error de telefono','error' => 'telefono inválida.']);
				die();
			}
            
			$this->nombre = $datosA[1];
			$this->cedulaRif = $datosA[2];
			$this->telefono = $datosA[3];

            return $this->registrarBanco();
			break;

			default:
			die("Error");
			break;
		} 

	}

	private function registrarBanco(){

		try {
		parent::conectarDB();
        $new = $this->con->prepare("INSERT INTO `datos_cobro_farmacia`(`id_datos_cobro`, `num_cuenta`, `rif_cedula`, `telefono`, `id_banco`, `status`) VALUES (default, ? , ? , ? , ? , 1)");
        $new->bindValue(1 ,$this->cuentaBank);
        $new->bindValue(2 ,$this->cedulaRif);
        $new->bindValue(3 ,$this->telefono);
        $new->bindValue(4 ,$this->nombre);

        $new->execute();
        $data = $new->fetchAll(); 
        $resultado = ['resultado' => 'banco registrado.'];
        echo json_encode($resultado);
        $this->binnacle("Banco",$_SESSION['cedula'],"Registró un Banco .");
        parent::desconectarDB();
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
        parent::conectarDB();
		$new = $this->con->prepare("SELECT * FROM datos_cobro_farmacia df WHERE df.id_datos_cobro = ? AND df.status = 1");
		$new->bindValue(1, $this->id);
		$new->execute();
		$data = $new->fetchAll();
		parent::desconectarDB();

		if(isset($data[0]["id_banco"])){
			echo json_encode(['resultado' => 'Si existe esa banco.']);
			die();
		}else{
			echo json_encode(['resultado' => 'Error de banco']);
			die();
		}

	}

	public function rellenarEdit($id){

		if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
			echo json_encode(['resultado' => 'Error de id','error' => 'id inválida.']);
			die();
		}

        $this->id = $id;

        return $this->selectItem();

	}

	private function selectItem(){

		try {
			parent::conectarDB();
			$new = $this->con->prepare("SELECT * FROM datos_cobro_farmacia df WHERE df.status = 1 and df.id_datos_cobro = ?");
			$new->bindValue(1, $this->id);
			$new->execute();
			$data = $new->fetchAll(\PDO::FETCH_OBJ);
			echo json_encode($data);
			parent::desconectarDB();
			die();

		}catch (\PDOException $e) {
			die($e);
		}
	}

	public function getEditarBanco($datos , $id){
		
		$datosA = $datos;

		switch ($datosA[0]) {

			case 'Transferencia' :

            if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
				echo json_encode(['resultado' => 'Error de id','error' => 'id inválida.']);
				die();
			}

			if(preg_match_all("/^[0-9]{1,10}$/", $datosA[1]) !== 1){
				echo json_encode(['resultado' => 'Error de Nombre banco','error' => 'Nombre banco inválida.']);
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
            
            $this->id = $id;
			$this->nombre = $datosA[1];
			$this->cedulaRif = $datosA[2];
			$this->cuentaBank = $datosA[3];

            return $this->editarBanco();
			break;

			case 'Pago movil' :

			 if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
				echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
				die();
			}

			if(preg_match_all("/^[0-9]{1,10}$/", $datosA[1]) !== 1){
				echo json_encode(['resultado' => 'Error de Nombre banco','error' => 'Nombre banco inválida.']);
				die();
			}

			if(preg_match_all("/^[0-9]{7,10}$/", $datosA[2]) != 1) {
				echo json_encode(['resultado' => 'Error de rif o cedula','error' => 'Rif o cedula inválido.']);
				die();
			}
			if(preg_match_all("/^[0-9]{10,30}$/", $datosA[3]) != 1){
				echo json_encode(['resultado' => 'Error de telefono','error' => 'telefono inválida.']);
				die();
			}
            
            $this->id = $id;
			$this->nombre = $datosA[1];
			$this->cedulaRif = $datosA[2];
			$this->telefono = $datosA[3];

            return $this->editarBanco();
			break;

			default:
			die("Error XD");
			break;
		} 
	}

    private function editarBanco(){
       try {
       	parent::conectarDB();
       	$new = $this->con->prepare("UPDATE datos_cobro_farmacia df SET `num_cuenta`= ? ,`rif_cedula`= ? ,`telefono`= ?,`id_banco`= ? WHERE df.status = 1 AND df.id_datos_cobro  = ?");

       	$new->bindValue(1 ,$this->cuentaBank);
       	$new->bindValue(2 ,$this->cedulaRif);
        $new->bindValue(3 ,$this->telefono);
       	$new->bindValue(4 ,$this->nombre);
       	$new->bindValue(5 ,$this->id);
       	$new->execute();
       	$data = $new->fetchAll();

       	$resultado = ['resultado' => 'banco editado.' , $new->execute()];
       	echo json_encode($resultado);
       	$this->binnacle("Banco",$_SESSION['cedula'],"Editó un Banco .");
       	parent::desconectarDB();
       	die();

       } catch (\PDOException $e) {
       	die($e);
       }

    }

    public function getEliminarBanco($id){
    	if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
    		echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
    		die();
    	}

    	$this->id = $id;

    	return $this->eliminarBanco();

    }

    private function eliminarBanco(){
    	try {
        parent::conectarDB();
    	$new = $this->con->prepare("UPDATE datos_cobro_farmacia df SET df.status = 0 WHERE df.id_datos_cobro = ?");
    	$new->bindValue(1, $this->id);
    	$new->execute();
    	$data = $new->fetchAll();
        $resultado = ['resultado' => 'Eliminado'];
        echo json_encode($resultado);
        $this->binnacle("Banco",$_SESSION['cedula'],"Eliminó un Banco .");
        parent::desconectarDB();
        die();
	
    	} catch (\PDOException $e) {
    		die($e);	
    	}
    }


}

?>