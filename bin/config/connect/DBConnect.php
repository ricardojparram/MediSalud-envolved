<?php 

  namespace config\connect;
  use config\componentes\configSistema as configSistema;
  use \PDO;

  class DBConnect extends configSistema{

   protected $con;
   private $puerto;
   private $usuario;
   private $contra;
   private $local;
   private $nameBD;
   
   public function __construct(){
    
    $this->usuario = parent::_USER_();
    $this->contra = parent::_PASS_();
    $this->local = parent::_LOCAL_();
    $this->nameBD = parent::_BD_();
    $this->connectarDB();
  }

  protected function connectarDB(){
    try {
      $this->con = new \PDO("mysql:host={$this->local};dbname={$this->nameBD}", $this->usuario, $this->contra);  
    } catch (\PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  protected function binnacle($modulo, $usuario, $descripcion){
    try {
      $new = $this->con->prepare("INSERT INTO bitacora(id, modulo, usuario, descripcion, fecha, status) VALUES (DEFAULT,?,?,?,DEFAULT,1)");
      $new->bindValue(1, $modulo);
      $new->bindValue(2, $usuario);
      $new->bindValue(3, $descripcion);
      $new->execute();
    } catch (\PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  }


?>