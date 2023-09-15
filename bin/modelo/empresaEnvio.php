<?php

namespace modelo;
use config\connect\DBConnect as DBConnect;

class empresaEnvio extends DBConnect{

	private $id;
	private $rif;
	private $nombre;
	private $contacto;

	function __construct(){
		parent::__construct();
	}

    public function mostrarEmpresas($bitacora = false){
    	try {
    	  $sql = 'SELECT * FROM empresa_envio e WHERE e.status = 1';
          $new = $this->con->prepare($sql);
          $new->execute();
          $data = $new->fetchAll(\PDO::FETCH_OBJ);
          echo json_encode($data);
          if($bitacora) $this->binnacle("Empresa de envio",$_SESSION['cedula'],"Consultó listado.");
          die();

    	} catch (\PDOException $e) {
    		return $e;
    	}
    }

    public function validarRif($rif, $id){
    	if(preg_match_all("/^[0-9]{7,10}$/", $rif) != 1){
    		echo json_encode(['resultado' => 'Error de rif','error' => 'Rif inválido.']);
    		die();
    	}

    	$this->rif = $rif;

    	if ($id != null) {
    		if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
    			echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
    			die();
    		}
            $this->id = $id;

    		return $this->vRifEdit();

    	}else{

    		return $this->vRif();

    	}

    }

    private function vRif(){
    	try {
    		$new = $this->con->prepare('SELECT * FROM empresa_envio e WHERE e.status = 1 and e.rif = ? ');
    		$new->bindValue(1, $this->rif);
    		$new->execute();
    		$data = $new->fetchAll();

    		if(isset($data[0]['rif'])) {
    			echo json_encode(['resultado' => 'Error Datos', 'error' => 'El rif ya está registrado.']);
    			die();
    		}else{
    			echo json_encode(['resultado' => 'Datos validos.']);
    			die();
    		}

    	} catch (\PDOException $e) {
    		die($e);
    	}
    }

    private function vRifEdit(){
    	try {
    		$new = $this->con->prepare('SELECT * FROM empresa_envio e WHERE e.status = 1 and e.rif = ? and e.id_empresa != ?');
    		$new->bindValue(1, $this->rif);
    		$new->bindValue(2, $this->id);
    		$new->execute();
    		$data = $new->fetchAll();

    		if(isset($data[0]['rif'])) {
    			echo json_encode(['resultado' => 'Error Datos', 'error' => 'El rif ya está registrado.']);
    			die();
    		}else{
    			echo json_encode(['resultado' => 'Datos validos.']);
    			die();
    		}

    	} catch (\PDOException $e) {
    		die($e);
    	}
    }

    public function getRegistrarEmpresa($rif, $nombre, $contacto){
    	if(preg_match_all("/^[0-9]{7,10}$/", $rif) != 1){
    		echo json_encode(['resultado' => 'Error de rif','error' => 'Rif inválido.']);
    		die();
    	}
    	if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $nombre) !== 1){
			echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
			die();
		}
		if($contacto != null) {
			if(preg_match_all("/^[0-9]{10,30}$/", $contacto) != 1){
				echo json_encode(['resultado' => 'Error de telefono','error' => 'Telefono inválido.']);
				die();
			}
		}

		$this->rif = $rif;
		$this->nombre = $nombre;
		$this->contacto = $contacto;

		return $this->registrarEmpresa();

    }

    private function registrarEmpresa(){
    	try {
    	$new = $this->con->prepare('INSERT INTO `empresa_envio`(`id_empresa`, `rif`, `nombre`, `contacto`, `status`) VALUES (DEFAULT,?,?,?,1)');
    	$new->bindValue(1, $this->rif);
    	$new->bindValue(2, $this->nombre);
    	$new->bindValue(3, $this->contacto);
    	$new->execute();
    	$data = $new->fetchAll();
    	$resultado = ['resultado' => 'Empresa registrado.'];
        echo json_encode($resultado);
        $this->binnacle("Empresa de envío",$_SESSION['cedula'],"Registró empresa de envío .");
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

		$new = $this->con->prepare("SELECT * FROM empresa_envio e WHERE e.status = 1 AND e.id_empresa = ?");
		$new->bindValue(1, $this->id);
		$new->execute();
		$data = $new->fetchAll();

		if(isset($data[0]["id_empresa"])){
			echo json_encode(['resultado' => 'Si existe esa empresa.']);
			die();
		}else{
			echo json_encode(['resultado' => 'Error de empresa']);
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
			$new = $this->con->prepare("SELECT * FROM empresa_envio e WHERE e.status = 1 AND e.id_empresa = ?");
			$new->bindValue(1, $this->id);
			$new->execute();
			$data = $new->fetchAll(\PDO::FETCH_OBJ);
			echo json_encode($data);
			die();

		}catch (\PDOException $e) {
			die($e);
		}
	} 

	public function getEditarEmpresa($rifEdit, $nameEdit, $contactoEdit ,$id){
		if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
			echo json_encode(['resultado' => 'Error de id','error' => 'id inválida.']);
			die();
		}
		if(preg_match_all("/^[0-9]{7,10}$/", $rifEdit) != 1){
			echo json_encode(['resultado' => 'Error de rif','error' => 'Rif inválido.']);
			die();
		}
		if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $nameEdit) !== 1){
			echo json_encode(['resultado' => 'Error de Tipo pago','error' => 'Tipo pago inválida.']);
			die();
		}
		if($contactoEdit != null) {
			if(preg_match_all("/^[0-9]{10,30}$/", $contactoEdit) != 1){
				echo json_encode(['resultado' => 'Error de telefono','error' => 'Telefono inválido.']);
				die();
			}
		}

		$this->rif = $rifEdit;
		$this->nombre = $nameEdit;
		$this->contacto = $contactoEdit;
		$this->id = $id;

        return $this->editarEmpresa();

	}

	private function editarEmpresa(){
		try {
			$new = $this->con->prepare('UPDATE empresa_envio e SET `rif`= ?,`nombre`= ? ,`contacto`= ? WHERE e.status = 1 AND e.id_empresa = ?');
			$new->bindValue(1, $this->rif);
			$new->bindValue(2, $this->nombre);
			$new->bindValue(3, $this->contacto);
			$new->bindValue(4, $this->id);
			$new->execute();
			$data = $new->fetchAll();
			$resultado = ['resultado' => 'Empresa editado.'];
			echo json_encode($resultado);
			$this->binnacle("Empresa de envío",$_SESSION['cedula'],"Editó empresa de envío .");
			die();
		} catch (\PDOException $e) {
			die($e);
		}

	}

	public function getEliminarEmpresa($id){
		if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
			echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
			die();
		}

		$this->id = $id;

		return $this->eliminarEmpresa();

	}

	private function eliminarEmpresa(){
		try{

		$new = $this->con->prepare("UPDATE empresa_envio e SET `status`= 0 WHERE e.status = 1 AND e.id_empresa = ?");
		$new->bindValue(1, $this->id);
		$new->execute();
		$this->binnacle("Empresa de envío",$_SESSION['cedula'],"Eliminó empresa de envío .");
		$resultado = ['resultado' => 'Empresa eliminada.'];
		die(json_encode($resultado));


		} catch (\PDOException $e) {
			die($e);
		}
	}

}

 ?>