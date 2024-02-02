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
            return $resultado;
        }

        $this->tipo = $tipo;

        return $this->agregarTipo();
	}

 private function agregarTipo(){
 	try{
    parent::conectarDB();
 		$new = $this->con->prepare("INSERT INTO `tipo`(`cod_tipo`, `des_tipo`, `status`) VALUES (DEFAULT,?,1)");
 		$new->bindValue(1, $this->tipo);
 		$new->execute();
 		$data = $new->fetchAll();

 		$resultado = ['resultado' => 'Registrado con exito'];
        parent::desconectarDB();
	   return $resultado;
 	}catch(\PDOexection $error){
 		return $error;
 	}
 }
 public function getMostrarTipo(){

   	try{
      parent::conectarDB();
     $new = $this->con->prepare("SELECT `cod_tipo`, `des_tipo`, `status` FROM tipo t WHERE t.status = 1;");
     $new->execute();
     $data = $new->fetchAll();
     parent::desconectarDB();
	 return $data;

    }catch(\PDOexection $error){

     return $error;

    }
  }



public function getEliminartipo($id){
	$this->id = $id;

	return $this->eliminartipo();
}

private function eliminartipo(){

	try{
    parent::conectarDB();
	 $new = $this->con->prepare("UPDATE tipo SET status = '0' WHERE cod_tipo = ?");
	 $new->bindValue(1, $this->id);
	 $new->execute();
	 $resultado = ['resultado' => 'Eliminado'];
      parent::desconectarDB();
      return $resultado;
	}catch (\PDOException $error) {
      return $error;
    }
}
public function mostrarlot($lott){
	$this->idedit = $lott;

	return $this->gol();
}
private function gol(){
	try{
    parent::conectarDB();
		$new = $this->con->prepare("SELECT * FROM tipo WHERE cod_tipo = ?");
		$new->bindValue(1, $this->idedit);
		$new->execute();
		$data = $new->fetchAll();	
		parent::desconectarDB();
		return $data;
	}catch(\PDOException $error){
		return $error;
	}
}
public function getEditarTipo($tipo, $id){
	if(preg_match_all("/^[a-zA-Z]{3,30}$/", $tipo) == false){
            return ['resultado' => 'Error de tipo de Producto' , 'error' => 'Tipo inválido.'];
           
        }
        $this->tipo = $tipo;
        $this->idedit = $id;

		return $this->editarTipo();

}
private function editarTipo(){
	try {
    parent::conectarDB();
		$new = $this->con->prepare("UPDATE `tipo` SET `des_tipo`= ? WHERE cod_tipo = ?");

      $new->bindValue(1, $this->tipo);
      $new->bindValue(2, $this->idedit);
      $new->execute();
      $data = $new->fetchAll();
      
      $resultado = ['resultado' => 'Editado'];
      parent::desconectarDB();    
	  return $resultado;
	} catch (\PDOexception $error) {
		return $error;
	}
}



}

?>