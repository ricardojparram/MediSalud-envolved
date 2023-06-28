<?php

  namespace modelo;
  use config\connect\DBConnect as DBConnect;


  class metodo extends DBConnect{
      
    	private $metodo;
      private $id;
      private $idedit;



    	function __construct(){
       parent::__construct();
     }
     
     public function getAgregarMetodo($metodo){
       if(preg_match_all("/[$%&|<>0-9]/", $metodo) == true){
        $resultado = ['resultado'=> 'error de metodo', 'error'=>'metodo invalido'];
        echo json_encode($resultado);
        die();
      }

      
      $this->metodo = $metodo;

      $this->agregarMetodo(); 

    }

    private function agregarMetodo(){
     try{
      $new = $this->con->prepare("INSERT INTO `tipo_pago`(`cod_tipo_pago`, `des_tipo_pago`, `status`) VALUES (DEFAULT,?,1)");

      $new->bindValue(1 , $this->metodo);
      $new->execute();
      $data = $new->fetchAll();
      
      $resultado = ["resultado" => "registrado correctamente"];
      echo json_encode($resultado);
      die();



      
    }catch(\PDOexection $error){
     return $error;
    }

    }
    public function getMostrarMetodo(){

      try{
       $new = $this->con->prepare("SELECT des_tipo_pago, CONCAT('<button type=\"button\" class=\"btn btn-success editar\" id=\"',cod_tipo_pago,'\" data-bs-toggle=\"modal\" data-bs-target=\"#editarModal\"><i class=\"bi bi-pencil\"></i></button> <button id=\"',cod_tipo_pago,'\" type=\"button\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#delModal\"><i class=\"bi bi-trash3\"></i> </button>') AS opciones  FROM `tipo_pago` WHERE status = 1");
       $new->execute();
       $data = $new->fetchAll();
      echo json_encode($data);
      die();


     }catch(\PDOexection $error){

       return $error;

     }
    }

    public function getEliminarMetodo($id){
      $this->id = $id;

      $this->eliminarMetodo();
    }

    private function eliminarMetodo(){
     
     try{
      $new = $this->con->prepare("UPDATE `tipo_pago` SET `status` = '0' WHERE `tipo_pago`.`cod_tipo_pago` = ?");
      $new->bindValue(1,$this->id);
      $new->execute();
      $resultado = ['resultado' => 'Eliminado'];
      echo json_encode($resultado);
      die();
     } 
     catch (\PDOexception $error) {
      return $error;
     }

    }
    public function mostrarunicas($unicas){
      $this->id = $unicas;

      $this->juanita();

  }
  private function juanita(){
    try{
      $new = $this->con->prepare("SELECT `cod_tipo_pago`, `des_tipo_pago`, `status` FROM `tipo_pago` WHERE cod_tipo_pago = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $data = $new->fetchAll();
      echo json_encode($data);
      die();
    }catch (\PDOexception $error) {
return $error;
    }

  }
  public function getEditarMetodo($metodo, $unicas){
    if(preg_match_all("/[$%&|<>0-9]/", $metodo) == true){
            $resultado = ['resultado' => 'Error de metodo' , 'error' => 'metodo inválido.'];
            echo json_encode($resultado);
            die();
  }
  $this->metodo = $metodo;
  $this->idedit = $unicas;

      $this->editarMetodo(); 

}
private function editarMetodo(){
  try{
$new = $this->con->prepare("UPDATE `tipo_pago` SET `des_tipo_pago`= ? WHERE cod_tipo_pago = ?");
$new->bindValue(1, $this->metodo);
$new->bindValue(2,$this->idedit);
$new->execute();

$resultado = ['resultado'=> 'Editado'];
echo json_encode($resultado);
die();
  }catch(\PDOexception $error){
    return$error;
  }

}
}
?>