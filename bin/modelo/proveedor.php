<?php 
   
    namespace modelo;
    use config\connect\DBConnect as DBConnect;

    class proveedor extends DBConnect{

      private $cod_pro;
      private $rif;
      private $direccion;
      private $razon;
      private $telefono;
      private $contacto;

      public function __construct(){
        parent::__construct();

      }


      public function mostrarProveedorAjax(){
        try{
          $new = $this->con->prepare("SELECT p.rif, p.razon_social, p.direccion, cp.telefono, cp.contacto, CONCAT('<button type=\"button\" id=\"', p.cod_prove ,'\" class=\"btn btn-success editar\" data-bs-toggle=\"modal\" data-bs-target=\"#Editar\"><i class=\"bi bi-pencil\"></i></button>
            <button type=\"button\" id=\"', p.cod_prove ,'\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#Borrar\"><i class=\"bi bi-trash3\"></i></button>') as opciones FROM proveedor p
            INNER JOIN contacto_prove cp 
            ON cp.cod_prove = p.cod_prove
            WHERE p.status = 1;");

          $new->execute();
          $data = $new->fetchAll();
          echo json_encode($data);
          die();

        }catch(\PDOException $e){
          return $e;
        }
      } 


      public function mostrarProveedores(){

        $new = $this->con->prepare("SELECT * FROM drogueria l INNER JOIN contacto_drogue cl ON l.cod_drogue = cl.cod_drogue WHERE l.status = 1;");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      } 



      public function getDatosPro($rif,$razon,$direccion,$telefono,$contacto){




        $this->rif = $rif;
        $this->direccion = $direccion;
        $this->razon = $razon;
        $this->telefono = $telefono;
        $this->contacto = $contacto;

        return $this->registrarPro();


      }

      private function registrarPro(){


        try{

          $new = $this->con->prepare("SELECT rif FROM proveedor WHERE status = 1 and rif = ?");
          $new->bindValue(1, $this->rif);
          $new->execute();
          $data = $new->fetchAll();

            if(!isset($data[0]["rif"])){ 

              $new = $this->con->prepare("INSERT INTO proveedor(cod_prove,rif,direccion,razon_social,status) VALUES(DEFAULT,?,?,?,1)");
              
              $new->bindValue(1, $this->rif); 
              $new->bindValue(2, $this->direccion); 
              $new->bindValue(3, $this->razon);
              $new->execute();
              $lastInsertId = $this->con->lastInsertId();


              $new = $this->con->prepare("INSERT INTO contacto_prove(id_contacto_prove, telefono, contacto, cod_prove) VALUES (DEFAULT, ?, ?, ?)");
              $new->bindValue(1, $this->telefono);
              $new->bindValue(2, $this->contacto);
              $new->bindValue(3, $lastInsertId);
              $new->execute();
              
            }else{
              return ("El proveedor ha sido registrado");
            }

       }catch(\PDOException $error){
         return $error;
        }  
      }

 public function getPro($id){
      $this->id = $id;

      $this->selectPro();
    }

    private function selectPro(){

      try{
        $new = $this->con->prepare("SELECT * FROM proveedor p INNER JOIN contacto_prove cp ON p.cod_prove = cp.cod_prove WHERE p.status = 1 and p.cod_prove = ? ;");
        $new->bindValue(1, $this->id);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);

        die();

        }catch(\PDOException $e){ 
          return $e;
        }

    }





  public function getEliminar($id){
      
      $this->id = $id;

      $this->eliminarProveedor();
    }

    private function eliminarProveedor(){
      try{

        $new = $this->con->prepare("
            UPDATE proveedor p SET status = 0 WHERE p.cod_prove = ?; 
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


     public function getEditar($rif, $razon, $direccion, $telefono, $contacto, $id){


        $this->rif = $rif;
        $this->direccion = $direccion;
        $this->razon = $razon;
        $this->telefono = $telefono;
        $this->contacto = $contacto;
        $this->idedit = $id;

        $this->editarProv();
    }

    private function editarProv(){

        try{

            $new = $this->con->prepare("UPDATE proveedor p INNER JOIN contacto_prove cp ON p.cod_prove = cp.cod_prove SET p.rif= ?, p.razon_social = ? , p.direccion= ?, cp.telefono = ? , cp.contacto = ? WHERE p.cod_prove = ?");
            $new->bindValue(1, $this->rif);
            $new->bindValue(2, $this->razon);
            $new->bindValue(3, $this->direccion);
            $new->bindValue(4, $this->telefono);
            $new->bindValue(5, $this->contacto);
            $new->bindValue(6, $this->idedit);
            $new->execute();
            $resultado = ['resultado' => 'Editado'];
            echo json_encode($resultado);
            die();

        }catch(\PDOException $error){
            echo json_encode($error);
            die();
        }

    }

  }

?>