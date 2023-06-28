<?php 
   
	 namespace modelo;
   use config\connect\DBConnect as DBConnect;
   
    class registro extends DBConnect{
      private $cedula;
      private $name;
      private $apellido;
      private $email;
      private $password;
      private $nivel;
      private $repass;

      public function __construct(){
      	parent::__construct();

      } 

      public function getRegistrarSistema($cedula,$name,$apellido,$email,$password,$repass){

        if(preg_match_all("/^[a-zA-ZÀ-ÿ]{0,30}$/", $name) == false){
          $resultado = ['resultado' => 'Error de nombre' , 'error' => 'Nombre inválido.'];
          echo json_encode($resultado);
          die();
        }
        if(preg_match_all("/^[a-zA-ZÀ-ÿ]{0,30}$/", $apellido) == false){
          $resultado = ['resultado' => 'Error de apellido' , 'error' => 'Apellido inválido.'];
          echo json_encode($resultado);
          die();
        }
        if(preg_match_all("/^[0-9]{7,10}$/", $cedula) == false){
          $resultado = ['resultado' => 'Error de cedula' , 'error' => 'Cédula inválida.'];
          echo json_encode($resultado);
          die();
        }
        if(preg_match_all("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email) == false){
          $resultado = ['resultado' => 'Error de email' , 'error' => 'Correo inválida.'];
          echo json_encode($resultado);
          die();
        }
        if(preg_match_all("/^[A-Za-z0-9 *?=&_!¡()@#]{3,30}$/", $password) == false) {
          $resultado = ['resultado' => 'Error de contraseña' , 'error' => 'Correo inválida.'];
          echo json_encode($resultado);
          die();
        }
        if($password != $repass) {
          $resultado = ['resultado' => 'Error de repass' , 'error' => 'Las contraseñas no coinciden.'];
          echo json_encode($resultado);
          die();
        }

        $this->name = $name;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->email = $email;
        $this->password = $password;
        $this->repass = $repass;
           //$this->nivel = $nivel;

        return $this->registraSistema();
      }

      private function registraSistema(){

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

              $new = $this->con->prepare("INSERT INTO `usuario`(`cedula`, `nombre`, `apellido`, `correo`, `password`, `nivel`, `status`) VALUES (?,?,?,?,?,3,1)");
              $new->bindValue(1, $this->cedula);
              $new->bindValue(2, $this->name); 
              $new->bindValue(3, $this->apellido);
              $new->bindValue(4, $this->email);
              $new->bindValue(5, $this->password);
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