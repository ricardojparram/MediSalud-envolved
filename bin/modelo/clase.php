<?php 

namespace modelo;

Use config\connect\DBConnect as DBConnect;

class clase extends DBConnect{

	private $clase;
	private $id;
	private $idEdit;
	
	public function __construct(){
        parent::__construct();
    }

    public function getAgregarClase($clase){
    	if(preg_match_all("/^[a-zA-Z]{3,30}$/", $clase) == false){
            $resultado = ['resultado' => 'Error de nombre' , 'error' => 'Nombre inválido.'];
            return $resultado;
        }

        $this->clase = $clase;

        return $this->agregarClase();
    }

    private function agregarClase(){
    	try {
            parent::conectarDB();
    		$new = $this->con->prepare("INSERT INTO `clase`(`cod_clase`, `des_clase`, `status`) VALUES (DEFAULT,?,1)");
    		$new->bindValue(1, $this->clase);
            $new->execute();
            $data = $new->fetchAll();

            $resultado = ['resultado' => 'Registrado correctamente.'];
             parent::desconectarDB();
            return $resultado;
    	} catch (\PDOException $error) {
    		return $error;
    	}
    }

    public function mostrarClase(){
    	try {
            parent::conectarDB();
    		$query = "SELECT * FROM clase c WHERE c.status = 1";
            $new = $this->con->prepare($query);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            parent::desconectarDB();
            return $data;
    	} catch (\PDOException $error) {
    		return $error;
    		
    	}
    }

    public function getEliminar($id){
    	$this->id = $id;

    	return $this->eliminarClase();
    }

    private function eliminarClase(){
    	try {
            parent::conectarDB();
    		$new = $this->con->prepare("UPDATE `clase` SET `status`= 0 WHERE cod_clase = ?"); //
            $new->bindValue(1, $this->id);
            $new->execute();
            $resultado = ['resultado' => 'Eliminado'];
            parent::desconectarDB();
            return $resultado;
    	} catch (\PDOException $error) {
    		return $error;
    	}
    }

    public function getItem($item){
    	$this->id = $item;

    	return $this->item();
    }

    private function item(){
    	try {
            parent::conectarDB();
    		$new = $this->con->prepare("SELECT * FROM clase WHERE cod_clase = ?");
            $new->bindValue(1, $this->id);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            parent::desconectarDB();
            return $data;

    	}catch (\PDOException $error) {
    		return $error;
    	}
    }

    public function getEditarClase($clase, $id){
    	if(preg_match_all("/^[a-zA-Z]{3,30}$/", $clase) == false){
            $resultado = ['resultado' => 'Error de nombre' , 'error' => 'Nombre inválido.'];
            return $resultado;
        }

        $this->clase = $clase;
        $this->idEdit = $id;

        return $this->editarClase();
    }

    private function editarClase(){
    	try {
            parent::conectarDB();
    		$new = $this->con->prepare("UPDATE `clase` SET `des_clase`= ? WHERE `cod_clase` = ?");
    		$new->bindValue(1, $this->clase);
    		$new->bindValue(2, $this->idEdit);
            $new->execute();
            $data = $new->fetchAll();

            $resultado = ['resultado' => 'Editado correctamente.'];
              parent::desconectarDB();
            return $resultado;
    	} catch (\PDOException $error) {
    		return $error;
    	}
    }

	
}



?>