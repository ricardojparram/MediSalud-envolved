<?php

  namespace modelo;
  use config\connect\DBConnect as DBConnect;


class moneda extends DBConnect{
	 
	private $moneda;
	private $alcambio;
  private $id;
  private $idedit;



   
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
      parent::conectarDB();
      $new = $this->con->prepare("INSERT INTO `cambio`(`id_cambio`, `cambio`, `fecha`, `moneda`, `status`) VALUES (DEFAULT,?,DEFAULT,?,1)");
      $new->bindValue(1 , $this->alcambio);
      $new->bindValue(2 , $this->moneda);
      $new->execute();
      $resultado = ['resultado' => 'Registado con exito'];
      echo json_encode($resultado);
      $this->binnacle("Moneda",$_SESSION['cedula'],"Registró un Valor de Moneda.");
      parent::desconectarDB();
      die();

     }catch(\PDOexection $error){
    	die($error);
      }

   }
   public function getMostrarCambio($nombreMon){
   	try{
        parent::conectarDB();
       $new = $this->con->prepare("
        SELECT m.nombre, format(c.cambio,2,'de_DE') as monto, c.fecha, c.id_cambio  FROM moneda m INNER JOIN cambio c ON c.moneda = m.id_moneda WHERE c.status = 1 AND m.status = 1");

       $new->execute();
       $data = $new->fetchAll();
       echo json_encode($data);
       parent::desconectarDB();
       die();

     }catch(\PDOexection $error){

       return $error;

     }
  }

  public function SelectM(){
    try{
      parent::conectarDB();
       $new = $this->con->prepare("SELECT * FROM `moneda` WHERE status = 1");
       $new->execute();
       $data = $new->fetchAll();
       echo json_encode($data);
       parent::desconectarDB();
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
      parent::conectarDB();
      $new = $this->con->prepare("UPDATE `cambio` SET `status` = '0' WHERE `id_cambio` = ? and status = 1");
      $new->bindValue(1, $this->id);
      $new->execute();
      $resultado = ['resultado' => 'Eliminado'];
      $this->binnacle("Moneda",$_SESSION['cedula'],"Eliminó un Valor de Moneda.");
      echo json_encode($resultado);
      parent::desconectarDB();
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
      parent::conectarDB();
      $new = $this->con->prepare("SELECT * FROM `cambio` WHERE id_cambio = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $datas = $new->fetchAll();
      echo json_encode($datas);
      parent::desconectarDB();
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
      parent::conectarDB();
      $new = $this->con->prepare("UPDATE `cambio` SET `cambio`= ?,`moneda`= ?, `fecha`= ? WHERE id_cambio = ? and status = 1");
      $new->bindValue(1, $this->alcambio);
      $new->bindValue(2, $this->moneda);
      $new->bindValue(3, $this->fechaActual);
      $new->bindValue(4, $this->idedit);
      $new->execute();
      $data = $new->fetchAll();
      $resultado = ['resultado' => 'Editado'];
      $this->binnacle("Moneda",$_SESSION['cedula'],"Editó un Valor de Moneda.");
      parent::desconectarDB();
      echo json_encode($resultado);      
      die();

     }catch(\PDOexection $error){
      return $error;
      }

   }

   public function getMoneda($bitacora = false){
      try{
        parent::conectarDB();
       $new = $this->con->prepare("SELECT m.id_moneda, m.nombre, tabla_cambio.cambio, tabla_cambio.fecha FROM moneda m 
                                    LEFT JOIN (
                                        SELECT c.cambio, c.fecha, c.moneda FROM cambio c 
                                        WHERE c.status = 1
                                        ORDER BY c.fecha ASC LIMIT 99999
                                    ) as tabla_cambio ON tabla_cambio.moneda = m.id_moneda
                                    WHERE m.status = 1
                                    GROUP BY m.id_moneda;");
       $new->execute();
       $data = $new->fetchAll();
       echo json_encode($data);
       if($bitacora) $this->binnacle("Moneda",$_SESSION['cedula'],"Consultó listado.");
       parent::desconectarDB();
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
      parent::conectarDB();
      $new = $this->con->prepare("INSERT INTO `moneda`(`id_moneda`, `nombre`, `status`) VALUES (DEFAULT,?,1)");
      $new->bindValue(1, $this->moneda);
      $new->execute();
      $resultado = ['resultado' => 'Registado con exito'];
      $this->binnacle("Moneda",$_SESSION['cedula'],"Registró una Moneda.");
      echo json_encode($resultado);
      parent::desconectarDB();      
      die();

    }catch(\PDOexection $error){
      return $error;
    }
   }

   public function mostrarM($id){
    $this->id = $id;
    
    try{
      parent::conectarDB();
       $new = $this->con->prepare("SELECT * FROM `moneda` WHERE status = 1 and id_moneda = ?");
       $new->bindValue(1, $this->id);
       $new->execute();
       $data = $new->fetchAll();
       echo json_encode($data);
       parent::desconectarDB();
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
      parent::conectarDB();
      $new = $this->con->prepare("UPDATE moneda SET nombre = ? WHERE status = 1 AND id_moneda = ?");
      $new->bindValue(1, $this->moneda);
      $new->bindValue(2, $this->id);
      $new->execute();
      $resultado = ['resultado' => 'Actualizado con exito'];
      $this->binnacle("Moneda",$_SESSION['cedula'],"Editó una Moneda.");
      echo json_encode($resultado);
      parent::desconectarDB(); 
      die();

    }catch(\PDOexection $error){
      return $error;
    }
  }

  public function getEliminarM($id){
    $this->id = $id;

    try{
      parent::conectarDB();
       $new = $this->con->prepare("UPDATE moneda SET status = 0 WHERE id_moneda = ? AND status = 1");
       $new->bindValue(1, $this->id);
       $new->execute();
       $data = ['resultado' => 'Eliminado con exito'];
       $this->binnacle("Moneda",$_SESSION['cedula'],"Eliminó una Moneda.");
       echo json_encode($data);
       parent::desconectarDB();
       die();

     }catch(\PDOexection $error){

       return $error;

     }
  }

  public function  actualizarMoneda(){
  //   if (extension_loaded('openssl')) {
  //     echo 'OpenSSL está habilitado en tu servidor.';
  // } else {
  //     echo 'OpenSSL no está habilitado en tu servidor.';
  // }
  // die();
    
    // Obtener el contenido HTML de una página web a través de su URL
    $html = file_get_contents('https://www.bcv.org.ve/');

    // Crear un objeto DOMDocument
    $dom = new DOMDocument();

    // Cargar el contenido HTML desde la variable
    $dom->loadHTML($html);

    // Crear un nuevo elemento y añadirlo al DOM
    $newElement = $dom->createElement('p', 'Nuevo párrafo');
    $dom->getElementsById('euro')->item(0)->appendChild($newElement);

    echo $newElement;
    die();
  }

}
?>