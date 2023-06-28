<?php 
   
    namespace modelo;
    use config\connect\DBConnect as DBConnect;
   
    class laboratorio extends DBConnect{

      private $cod_lab;
      private $rif;
      private $direccion;
      private $razon;
      private $telefono;
      private $contacto;

      private $id;
      private $idedit;

      public function __construct(){
      	parent::__construct();

      }
 
      public function mostrarLaboratoriosAjax(){
        try{
          $new = $this->con->prepare("SELECT l.rif, l.razon_social, l.direccion, cl.telefono, cl.contacto, CONCAT('<button type=\"button\" id=\"', l.cod_lab ,'\" class=\"btn btn-success editar\" data-bs-toggle=\"modal\" data-bs-target=\"#Editar\"><i class=\"bi bi-pencil\"></i></button>
            <button type=\"button\" id=\"', l.cod_lab ,'\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#Borrar\"><i class=\"bi bi-trash3\"></i></button>') as opciones FROM laboratorio l
            INNER JOIN contacto_lab cl 
            ON cl.cod_lab = l.cod_lab
            WHERE l.status = 1;");

          $new->execute();
          $data = $new->fetchAll();
          echo json_encode($data);
          die();

        }catch(\PDOException $e){
          return $e;
        }
      } 

      public function getDatosLab($rif, $direccion, $razon, $telefono, $contacto){

        if(preg_match_all("/^[0-9]{7,10}$/", $rif) != 1){
          echo json_encode(['resultado' => 'Error de rif','error' => 'Rif inválido.']);
          die();
        }
        if(preg_match_all("/^[a-zA-ZÀ-ÿ]{0,30}$/", $razon) != 1){
          echo json_encode(['resultado' => 'Error de nombre','error' => 'Nombre inválido.']);
          die();
        }

        if(preg_match_all('/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s#"/,.-]){7,50}$/', $direccion) == 1){
          echo json_encode(['resultado' => 'Error de direccion','error' => 'Direccion inválida.']);
          die();
        }
        if(preg_match_all("/^[0-9]{10,30}$/", $telefono) != 1){
          echo json_encode(['resultado' => 'Error de telefono','error' => 'Telefono inválido.']);
          die();
        }

        $this->rif = $rif;
        $this->direccion = $direccion;
        $this->razon = $razon;
        $this->telefono = $telefono;
        $this->contacto = $contacto;

        return $this->registrarLab();

      }

      private function registrarLab(){

          try{

            $new = $this->con->prepare("SELECT rif FROM laboratorio WHERE status = 1 and rif = ?");
            $new->bindValue(1, $this->rif);
            $new->execute();
            $data = $new->fetchAll();

              if(!isset($data[0]["rif"])){ 

                $new = $this->con->prepare("INSERT INTO laboratorio(cod_lab,rif,direccion,razon_social,status) VALUES(DEFAULT,?,?,?,1)");
                $new->bindValue(1, $this->rif); 
                $new->bindValue(2, $this->direccion); 
                $new->bindValue(3, $this->razon);
                $new->execute();
                $lastInsertId = $this->con->lastInsertId();

                  $new = $this->con->prepare("INSERT INTO contacto_lab(id_contacto_lab, telefono, contacto, cod_lab) VALUES (DEFAULT, ?, ?, ?)");
                  $new->bindValue(1, $this->telefono);
                  $new->bindValue(2, $this->contacto);
                  $new->bindValue(3, $lastInsertId);
                  $new->execute();
                  $resultado = ['resultado' => 'Laboratorio registrado.'];
                  echo json_encode($resultado);
                  die();
                
              }else{
                $resultado = ['resultado' => 'Error de rif' , 'error' => 'El rif ya está registrado.'];
                echo json_encode($resultado);
                die();
              }
            

        }catch(\PDOException $error){
            return $error;
        } 
      
    }

    public function getRif($rif){

      if(preg_match_all("/^[0-9]{7,10}$/", $rif) != 1){
        echo json_encode(['resultado' => 'Error de rif','error' => 'Rif inválido.']);
        die();
      }

      $this->rif = $rif;

      $this->validarRif();
    }

    private function validarRif(){

      try {

        $new = $this->con->prepare("SELECT rif FROM laboratorio WHERE status = 1 and rif = ?");
        $new->bindValue(1, $this->rif);
        $new->execute();
        $data = $new->fetchAll();

        if(isset($data[0]['rif'])){
          echo json_encode(['resultado' => 'Error de rif', 'error' => 'El rif ya está registrado.']);
          die();
        }else{
          echo json_encode(['resultado' => 'Rif válido.']);
          die();
        }

      } catch (PDOException $e) {
        return $e;
      }

    }

    
    public function getItem($id){

      if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
       echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
       die();
     }

     $this->id = $id;

     $this->selectItem();
    }

    private function selectItem(){

      try{
        $new = $this->con->prepare("SELECT * FROM laboratorio l 
                                    INNER JOIN contacto_lab cl 
                                    ON l.cod_lab = cl.cod_lab 
                                    WHERE l.status = 1 and l.cod_lab = ? ;");
        $new->bindValue(1, $this->id);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        die();

        }catch(\PDOException $e){
          return $e;
        }

    }

    public function getEditar($rif, $direccion, $razon, $telefono, $contacto, $id){

      if(preg_match_all("/^[0-9]{7,10}$/", $rif) != 1){
         echo json_encode(['resultado' => 'Error de rif','error' => 'Rif inválido.']);
         die();
      }
      if(preg_match_all("/^[a-zA-ZÀ-ÿ]{0,30}$/", $razon) != 1){
        echo json_encode(['resultado' => 'Error de nombre','error' => 'Nombre inválido.']);
        die();
      }

      if(preg_match_all('/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s#"/,.-]){7,50}$/', $direccion) == 1){
        echo json_encode(['resultado' => 'Error de direccion','error' => 'Direccion inválida.']);
        die();
      }
      if(preg_match_all("/^[0-9]{10,30}$/", $telefono) != 1){
        echo json_encode(['resultado' => 'Error de telefono','error' => 'Telefono inválido.']);
        die();
      }
      if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
         echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
         die();
      }

      $this->rif = $rif;
      $this->direccion = $direccion;
      $this->razon = $razon;
      $this->telefono = $telefono;
      $this->contacto = $contacto;
      $this->idedit = $id;

      $this->editarLaboratorio();
    }

    private function editarLaboratorio(){

        try{

          $new = $this->con->prepare("SELECT rif FROM laboratorio WHERE status = 1 and rif = ?");
          $new->bindValue(1, $this->rif);
          $new->execute();
          $data = $new->fetchAll();

          if(!isset($data[0]["rif"])){ 

            $new = $this->con->prepare("
              UPDATE laboratorio l
              INNER JOIN contacto_lab cl 
              ON l.cod_lab = cl.cod_lab
              SET l.rif = ? , l.direccion = ? , l.razon_social = ? , cl.telefono = ?, cl.contacto = ?
              WHERE l.cod_lab = ?");
            $new->bindValue(1, $this->rif);
            $new->bindValue(2, $this->direccion);
            $new->bindValue(3, $this->razon);
            $new->bindValue(4, $this->telefono);
            $new->bindValue(5, $this->contacto);
            $new->bindValue(6, $this->idedit);
            $new->execute();
            $resultado = ['resultado' => 'Editado'];
            echo json_encode($resultado);
            die();


          }else{
            $resultado = ['resultado' => 'Error de rif' , 'error' => 'El rif ya está registrado.'];
            echo json_encode($resultado);
            die();
          }

        }catch(\PDOException $error){
            echo json_encode($error);
            die();
        }

    } 


    public function getEliminar($id){
      if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
         echo json_encode(['resultado' => 'Error de id','error' => 'Id inválida.']);
         die();
      }

      $this->id = $id;

      $this->eliminarLaboratorio();
    }

    private function eliminarLaboratorio(){
      try{

        $new = $this->con->prepare("
            UPDATE laboratorio SET status = 0 WHERE laboratorio.cod_lab = ?; 
          ");
        $new->bindValue(1, $this->id);
        $new->execute();
        $resultado = ['resultado' => 'Eliminado'];
        echo json_encode($resultado);
        die();

      }catch(\PDOException $e){
        return $e;
      }

    }
  }

?>