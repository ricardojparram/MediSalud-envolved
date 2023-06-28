<?php 

namespace modelo;
use config\connect\DBConnect as DBConnect;

class usuarios extends DBConnect{

  private $cedula;
  private $name;
  private $apellido;
  private $email;
  private $password;
  private $nivel;
  private $id;

  function __construct(){
    parent::__construct();
  }

  public function getAgregarUsuario($cedula,$name,$apellido,$email,$password,$tipoUsuario){

    if(preg_match_all("/^[a-zA-ZÀ-ÿ]{0,30}$/", $name) == false){
      $resultado = ['resultado' => 'Error de nombre' , 'error' => 'Nombre invalido.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]{0,30}$/", $apellido) == false){
      $resultado = ['resultado' => 'Error de apellido' , 'error' => 'Apellido invalido.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^[0-9]{7,10}$/", $cedula) == false){
      $resultado = ['resultado' => 'Error de cedula' , 'error' => 'Cédula invalida.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email) == false){
      $resultado = ['resultado' => 'Error de email' , 'error' => 'Correo invalida.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^[A-Za-z0-9 *?=&_!¡()@#]{3,30}$/", $password) == false) {
      $resultado = ['resultado' => 'Error de contraseña' , 'error' => 'Correo invalida.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^[0-9]{1,2}$/", $tipoUsuario) == false){
      $resultado = ['resultado' => 'Error de Nivel' , 'error' => 'Nivel invalido.'];
      echo json_encode($resultado);
      die();
    }

    $this->cedula = $cedula;
    $this->name = $name;
    $this->apellido = $apellido;
    $this->email = $email;
    $this->password = $password;
    $this->nivel = $tipoUsuario;

    return $this->agregarUsuario();
  }

  private function agregarUsuario(){
   try{
    $new = $this->con->prepare("SELECT `cedula` FROM `usuario` WHERE `status` = 1 and `cedula` = ?");
    $new->bindValue(1, $this->cedula);
    $new->execute();
    $data = $new->fetchAll();

    if(!isset($data[0]["cedula"])){

      $new = $this->con->prepare("SELECT `correo` FROM `usuario` WHERE `status` = 1 and `correo` = ?");
      $new->bindValue(1, $this->email);
      $new->execute();
      $data = $new->fetchAll();

      if(!isset($data[0]["correo"])){

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        $new = $this->con->prepare("INSERT INTO `usuario`(`cedula`, `nombre`, `apellido`, `correo`, `password`, `nivel`, `status`) VALUES (?,?,?,?,?,?,1)");
        $new->bindValue(1, $this->cedula);
        $new->bindValue(2, $this->name); 
        $new->bindValue(3, $this->apellido);
        $new->bindValue(4, $this->email);
        $new->bindValue(5, $this->password);
        $new->bindValue(6, $this->nivel);
        $new->execute();
        $resultado = ['resultado' => 'Registrado correctamente.'];
        echo json_encode($resultado);
        die();

      }else{
        $resultado = ['resultado' => 'Error de email' , 'error' => 'El correo ya está registrado.'];
        echo json_encode($resultado);
        die();
      }

    }else{
      $resultado = ['resultado' => 'Error de cedula' , 'error' => 'La cédula ya está registrada.'];
      echo json_encode($resultado);
      die();
    }

  }catch(exection $error){
   return $error;
 }

}

public function getMostrarUsuario(){

  try{
    $query = "SELECT u.cedula, u.nombre, u.apellido, u.correo, u.nivel, CONCAT('<button type=\"button\" class=\"btn btn-success editar\" id=\"',u.cedula,'\" data-bs-toggle=\"modal\" data-bs-target=\"#editModal\"><i class=\"bi bi-pencil\"></i></button> <button type=\"button\" class=\"btn btn-danger eliminar\" id=\"',u.cedula,'\" data-bs-toggle=\"modal\" data-bs-target=\"#delModal\"><i class=\"bi bi-trash3\"></i></button>') AS opciones FROM usuario u WHERE u.status = 1";

    $new = $this->con->prepare($query);
    $new->execute();
    $data = $new->fetchAll();
    echo json_encode($data);
    die();

  }catch(\PDOexection $error){

   return $error;

 }
}

public function mostrarNivel(){
  try{
    $new = $this->con->prepare("SELECT * FROM `nivel` WHERE status = 1");
    $new->execute();
    $data = $new->fetchAll(\PDO::FETCH_OBJ);
    return $data;
  }catch(\PDOexection $error){

   return $error;

 }
}

public function getEliminar($cedula){
  $this->cedula = $cedula;

  $this->eliminarUsuario();
}

private function eliminarUsuario(){
  try {
        $new = $this->con->prepare("DELETE FROM `usuario` WHERE `usuario`.`cedula` = ?"); //"UPDATE `usuario` SET `status` = '0' WHERE `usuario`.`cedula` = ?"
        $new->bindValue(1, $this->cedula);
        $new->execute();
        $resultado = ['resultado' => 'Eliminado'];
        echo json_encode($resultado);
        die();
        
      }catch (\PDOexection $error) {
        return $error;
      }
    }

    public function getUnico($cedula){
      $this->cedula = $cedula;

      $this->seleccionarUnico();
    }

    private function seleccionarUnico(){
      try{
        $new = $this->con->prepare("SELECT cedula, nombre, apellido, correo, nivel FROM `usuario` WHERE `usuario`.`cedula` = ?");
        $new->bindValue(1, $this->cedula);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        die();

      }catch(\PDOexection $error){

       return $error;

     }
   }

   public function getEditar($cedula,$name,$apellido,$email,$password,$tipoUsuario,$id){

    if(preg_match_all("/^[a-zA-Z]{0,30}$/", $name) == false){
      $resultado = ['resultado' => 'Error de nombre' , 'error' => 'Nombre invalido.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^[a-zA-Z]{0,30}$/", $apellido) == false){
      $resultado = ['resultado' => 'Error de apellido' , 'error' => 'Apellido invalido.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^[0-9]{7,10}$/", $cedula) == false){
      $resultado = ['resultado' => 'Error de cedula' , 'error' => 'Cédula invalida.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email) == false){
      $resultado = ['resultado' => 'Error de email' , 'error' => 'Correo invalida.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^[A-Za-z0-9 *?=&_!¡()@#]{3,30}$/", $password) == false) {
      $resultado = ['resultado' => 'Error de contraseña' , 'error' => 'Correo invalida.'];
      echo json_encode($resultado);
      die();
    }
    if(preg_match_all("/^[0-9]{1,2}$/", $tipoUsuario) == false){
      $resultado = ['resultado' => 'Error de Nivel' , 'error' => 'Nivel invalido.'];
      echo json_encode($resultado);
      die();
    }

    $this->cedula = $cedula;
    $this->name = $name;
    $this->apellido = $apellido;
    $this->email = $email;
    $this->password = $password;
    $this->nivel = $tipoUsuario;
    $this->id = $id;

    $this->editarUsuario();
  }

  private function editarUsuario(){

    try{
      $new = $this->con->prepare("UPDATE `usuario` SET `cedula`= ?,`nombre`= ?,`apellido`= ?,`correo`= ?,`password`=?,`nivel`=? WHERE `usuario`.`cedula` = ?");
      $new->bindValue(1, $this->cedula);
      $new->bindValue(2, $this->name); 
      $new->bindValue(3, $this->apellido);
      $new->bindValue(4, $this->email);
      $new->bindValue(5, $this->password);
      $new->bindValue(6, $this->nivel);
      $new->bindValue(7, $this->id);
      $new->execute();
      $data = $new->fetchAll();
      $resultado = ['resultado' => 'Editado'];
      echo json_encode($resultado);
      die();
    }catch(\PDOexection $error){

     return $error;

   }
 }

 public function getValidarC($cedula){
  if(preg_match_all("/^[0-9]{7,10}$/", $cedula) == false){
    $resultado = ['resultado' => 'Error de cedula' , 'error' => 'Cédula inválida.'];
    echo json_encode($resultado);
    die();
  }
  $this->cedula = $cedula;

  $this->validarC();
}

private function validarC(){
  try{
    $new = $this->con->prepare("SELECT `cedula` FROM `usuario` WHERE `status` = 1 and `cedula` = ?");
    $new->bindValue(1, $this->cedula);
    $new->execute();
    $data = $new->fetchAll();
    if(isset($data[0]['cedula'])){
      $resultado = ['resultado' => 'Error de cedula' , 'error' => 'La cédula ya está registrada.'];
      echo json_encode($resultado);
      die();
    }
  }catch(\PDOException $error){
    return $error;
  }
}

public function getValidarE($email){
  if( preg_match_all("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email) == false){
    $resultado = ['resultado' => 'Error de email' , 'error' => 'Correo inválido.'];
    echo json_encode($resultado);
    die();
  }
  $this->email = $email;

  $this->validarE();
}

private function validarE(){
  try{
    $new = $this->con->prepare("SELECT `correo` FROM `usuario` WHERE `status` = 1 and `correo` = ?");
    $new->bindValue(1, $this->email);
    $new->execute();
    $data = $new->fetchAll();
    if(isset($data[0]['correo'])){
      $resultado = ['resultado' => 'Error de email' , 'error' => 'El email ya está registrado.'];
      echo json_encode($resultado);
      die();
    }
  }catch(\PDOException $error){
    return $error;
  }
}


}

?>


