<?php 

namespace modelo;

use config\connect\DBConnect as DBConnect;

class banco extends DBConnect{

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


}

?>