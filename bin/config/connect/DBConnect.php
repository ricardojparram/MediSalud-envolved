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

  }


?>