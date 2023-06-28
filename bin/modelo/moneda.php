<?php

  namespace modelo;
  use config\connect\DBConnect as DBConnect;


class moneda extends DBConnect{
	 
	private $moneda;
	private $alcambio;
  private $id;
  private $idedit;


	function __construct(){
	parent::__construct();
    }
   
   public function getAgregarCambio($alcambio,$tipo){

   	 if(preg_match_all("/^[0-9]{1,30}$/", $tipo) != 1){
            $resultado = ['resultado' => 'Error de moneda' , 'error' => 'moneda inválido.'];
            die($resultado);
        }
     if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $alcambio) != 1){
            die("Error de cambio!") ;
        }
    
    $this->moneda = $tipo;
    $this->alcambio = $alcambio;

     $this->agregarCambio(); 


   }
   
     private function agregarCambio(){
     try{
      $new = $this->con->prepare("INSERT INTO `cambio`(`id_cambio`, `cambio`, `fecha`, `moneda`, `status`) VALUES (DEFAULT,?,DEFAULT,?,1)");
      $new->bindValue(1 , $this->alcambio);
      $new->bindValue(2 , $this->moneda);
      $new->execute();
      $resultado = ['resultado' => 'Registado con exito'];
      echo json_encode($resultado);      
      die();

     }catch(\PDOexection $error){
    	return $error;
      }

   }
   public function getMostrarCambio(){
   	try{
       $new = $this->con->prepare("
        SELECT m.nombre,c.cambio,c.fecha, CONCAT('<button type=\"button\" class=\"btn btn-success editar\" data-bs-toggle=\"modal\" data-bs-target=\"#editarModal\" id=\"',c.id_cambio,'\"><i class=\"bi bi-pencil\"></i></button>
        <button type=\"button\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#delModal\" id=\"',c.id_cambio,'\">
        <i class=\"bi bi-trash3\"></i>
        </button>') AS Opciones FROM moneda m INNER JOIN cambio c ON c.moneda = m.id_moneda WHERE c.status = 1 AND m.status = 1");
       $new->execute();
       $data = $new->fetchAll();
       echo json_encode($data);
       die();

     }catch(\PDOexection $error){

       return $error;

     }
  }

  public function SelectM(){
    try{
       $new = $this->con->prepare("SELECT * FROM `moneda` WHERE status = 1");
       $new->execute();
       $data = $new->fetchAll();
       echo json_encode($data);
       die();

     }catch(\PDOexection $error){

       return $error;

     }
  }

  public function getEliminarCambio($id){
   $this->id = $id;

   $this->eliminarCambio();
  }

  private function eliminarCambio(){

    try {
      $new = $this->con->prepare("UPDATE `cambio` SET `status` = '0' WHERE `id_cambio` = ? and status = 1");
      $new->bindValue(1, $this->id);
      $new->execute();
      $resultado = ['resultado' => 'Eliminado'];
      echo json_encode($resultado);
      die();
    }
    catch (\PDOException $error) {
      return $error;
    }
  }


  public function mostrarUnico($unico){
    $this->id = $unico;

    $this->unico();
  }

  private function unico(){
    try {
      $new = $this->con->prepare("SELECT * FROM `cambio` WHERE id_cambio = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $datas = $new->fetchAll();
     echo json_encode($datas);
     die();
      
    } catch (\PDOException $error) {
      return $error;
    }
  }

  public function getEditarCambio($alcambio,$moneda, $unico){

     if(preg_match_all("/^[0-9]{1,30}$/", $moneda) != 1){
            $resultado = ['resultado' => 'Error de Moneda' , 'error' => 'Moneda inválido.'];
            echo json_encode($resultado);
            die();
        }
     if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $alcambio) != 1){
            die("Error de cambio!");
        }
    
    $this->moneda = $moneda;
    $this->alcambio = $alcambio;
    $this->idedit = $unico;
    
    date_default_timezone_set("america/caracas");
    $this->fechaActual = date("Y-m-d G:i:s");

     $this->editarCambio(); 


   }
   
     private function editarCambio(){
     try{
      $new = $this->con->prepare("UPDATE `cambio` SET `cambio`= ?,`moneda`= ?, `fecha`= ? WHERE id_cambio = ? and status = 1");

      $new->bindValue(1, $this->alcambio);
      $new->bindValue(2, $this->moneda);
      $new->bindValue(3, $this->fechaActual);
      $new->bindValue(4, $this->idedit);
      $new->execute();
      $data = $new->fetchAll();
      
      $resultado = ['resultado' => 'Editado'];
      echo json_encode($resultado);      
      die();

     }catch(\PDOexection $error){
      return $error;
      }

   }

   public function getMoneda(){
      try{
       $new = $this->con->prepare("SELECT`nombre`,CONCAT('<button type=\"button\" class=\"btn btn-success update\" data-bs-toggle=\"modal\" data-bs-target=\"#editModal\" id=\"',id_moneda,'\"><i class=\"bi bi-pencil\"></i></button> <button type=\"button\" class=\"btn btn-danger delete\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteModal\" id=\"',id_moneda,'\"> <i class=\"bi bi-trash3\"></i></button>') FROM `moneda` WHERE status = 1");
       $new->execute();
       $data = $new->fetchAll();
       echo json_encode($data);
       die();

     }catch(\PDOexection $error){

       return $error;

     }
   }

   public function getAgregarMoneda($name){
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]{3,30}$/", $name) == false){
      die('moneda inválido.');
    }
    
    $this->moneda = $name;

    return $this->agregarMoneda();

   }
   
   private function agregarMoneda(){
    try{
      $new = $this->con->prepare("INSERT INTO `moneda`(`id_moneda`, `nombre`, `status`) VALUES (DEFAULT,?,1)");
      $new->bindValue(1, $this->moneda);
      $new->execute();
      $resultado = ['resultado' => 'Registado con exito'];
      echo json_encode($resultado);      
      die();

    }catch(\PDOexection $error){
      return $error;
    }
   }

   public function mostrarM($id){
    $this->id = $id;
    
    try{
       $new = $this->con->prepare("SELECT * FROM `moneda` WHERE status = 1 and id_moneda = ?");
       $new->bindValue(1, $this->id);
       $new->execute();
       $data = $new->fetchAll();
       echo json_encode($data);
       die();

     }catch(\PDOexection $error){

       return $error;

     }


   }

   public function getEditarM($nameEdit, $id){
     if(preg_match_all("/^[a-zA-ZÀ-ÿ]{3,30}$/", $nameEdit) == false){
      die('moneda inválido.');
    }
    
    $this->id = $id;
    $this->moneda = $nameEdit;

    return $this->editarM();
  }

  private function editarM(){
    try{
      $new = $this->con->prepare("UPDATE moneda SET nombre = ? WHERE status = 1 AND id_moneda = ?");
      $new->bindValue(1, $this->moneda);
      $new->bindValue(2, $this->id);
      $new->execute();
      $resultado = ['resultado' => 'Actualizado con exito'];
      echo json_encode($resultado);      
      die();

    }catch(\PDOexection $error){
      return $error;
    }
  }

  public function getEliminarM($id){
    $this->id = $id;

    try{
       $new = $this->con->prepare("UPDATE moneda SET status = 0 WHERE id_moneda = ? AND status = 1");
       $new->bindValue(1, $this->id);
       $new->execute();
       $data = ['resultado' => 'Eliminado con exito'];
       echo json_encode($data);
       die();

     }catch(\PDOexection $error){

       return $error;

     }
  }

}
?>