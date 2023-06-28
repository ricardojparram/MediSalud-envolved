<?php
namespace modelo;
use config\connect\DBConnect as DBConnect;


class tipo extends DBConnect{

	private $tipo;
	private $id;
	private $idedit;

	function __construct(){
		parent::__construct();
	}

	public function getAgregarTipo($tipo){
		if(preg_match_all("/^[a-zA-Z]{0,30}$/", $tipo) == false){
            $resultado = ['resultado' => 'Error de nombre' , 'error' => 'Nombre inválido.'];
            echo json_encode($resultado);
            die();
        }

        $this->tipo = $tipo;

        $this->agregarTipo();
	}

 private function agregarTipo(){
 	try{
 		$new = $this->con->prepare("INSERT INTO `tipo`(`cod_tipo`, `des_tipo`, `status`) VALUES (DEFAULT,?,1)");
 		$new->bindValue(1, $this->tipo);
 		$new->execute();
 		$data = $new->fetchAll();

 		$resultado = ['resultado' => 'Registrado con exito'];
 		echo json_encode($resultado);
 		die();
 	}catch(\PDOexection $error){
 		return $error;
 	}
 }
 public function getMostrarTipo(){

   	try{
       $new = $this->con->prepare("SELECT  des_tipo, CONCAT('<button type=\"button\" class=\"btn btn-success editar\" data-bs-toggle=\"modal\" data-bs-target=\"#editarModal\" id=\"',cod_tipo,'\"><i class=\"bi bi-pencil\"></i></button>
        <button type=\"button\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#delModal\" id=\"',cod_tipo,'\">
        <i class=\"bi bi-trash3\"></i>
        </button>') AS Opciones FROM tipo WHERE status = 1");
     $new->execute();
     $data = $new->fetchAll();
     echo json_encode($data);
     die();

    }catch(\PDOexection $error){

     return $error;

    }
  }



public function getEliminartipo($id){
	$this->id = $id;

	$this->eliminartipo();
}

private function eliminartipo(){

	try{
	 $new = $this->con->prepare("UPDATE tipo SET status = '0' WHERE cod_tipo = ?");
	 $new->bindValue(1, $this->id);
	 $new->execute();
	 $resultado = ['resultado' => 'Eliminado'];
      echo json_encode($resultado);
      die();
	}catch (\PDOException $error) {
      return $error;
    }
}
public function mostrarlot($lott){
	$this->idedit = $lott;

	$this->gol();
}
private function gol(){
	try{
		$new = $this->con->prepare("SELECT * FROM tipo WHERE cod_tipo = ?");
		$new->bindValue(1, $this->idedit);
		$new->execute();
		$data = $new->fetchAll();
		echo json_encode($data);
		die();
	}catch(\PDOException $error){
		return $error;
	}
}
public function getEditarTipo($tipo, $id){
	if(preg_match_all("/^[a-zA-Z]{3,30}$/", $tipo) == false){
            $resultado = ['resultado' => 'Error de tipo de Producto' , 'error' => 'Tipo inválido.'];
            echo json_encode($resultado);
            die();

        }
        $this->tipo = $tipo;
        $this->idedit = $id;

        $this->editarTipo();

}
private function editarTipo(){
	try {
		$new = $this->con->prepare("UPDATE `tipo` SET `des_tipo`= ? WHERE cod_tipo = ?");

      $new->bindValue(1, $this->tipo);
      $new->bindValue(2, $this->idedit);
      $new->execute();
      $data = $new->fetchAll();
      
      $resultado = ['resultado' => 'Editado'];
      echo json_encode($resultado);      
      die();
	} catch (\PDOexception $error) {
		return $error;
	}
}



}

?>