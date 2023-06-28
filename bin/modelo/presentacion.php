<?php 
   
    namespace modelo;
    use config\connect\DBConnect as DBConnect;

    class presentacion extends DBConnect{

      private $cod_pres;
      private $medida;
      private $cantidad;
      private $peso;

      public function __construct(){
        parent::__construct();

      }


      public function mostrarPresentacionAjax(){

        try{
          $new = $this->con->prepare("SELECT  cantidad, medida, peso, CONCAT('<button type=\"button\" id=\"', cod_pres ,'\" class=\"btn btn-success editar\" data-bs-toggle=\"modal\" data-bs-target=\"#Editar\"><i class=\"bi bi-pencil\"></i></button>

            <button type=\"button\" id=\"', cod_pres ,'\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#Borrar\"><i class=\"bi bi-trash3\"></i></button>') as opciones FROM presentacion WHERE status = 1;");

          $new->execute();
          $data = $new->fetchAll();
          echo json_encode($data);
          die();

        }catch(\PDOException $e){
          return $e;
        }
      } 


      public function getDatosPres($medida,$cantidad,$peso){



        $this->medida = $medida;
        $this->cantidad = $cantidad;
        $this->peso = $peso;

        return $this->registrarPres();

      }

      private function registrarPres(){


        try{
     
              $new = $this->con->prepare("INSERT INTO presentacion(cod_pres,medida,cantidad,peso,status) VALUES(DEFAULT,?,?,?,1)");
              
              $new->bindValue(1, $this->medida); 
              $new->bindValue(3, $this->cantidad); 
              $new->bindValue(2, $this->peso); 
              $new->execute();
              

              return ("La presentacion ha sido registrada");
            

       }catch(\PDOException $error){
         return $error;
        }  
      }

  public function getPres($id){
      $this->id = $id;

      $this->selectPres();
    }

    private function selectPres(){

      try{
        $new = $this->con->prepare("SELECT * FROM presentacion WHERE status = 1 and cod_pres = ? ;");
        $new->bindValue(1, $this->id);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);

        die();

        }catch(\PDOException $e){ 
          return $e;
        }

    }

   public function getEditar($medida, $cantidad, $peso,$id){

        $this->medida= $medida;
        $this->cantidad = $cantidad;
        $this->peso = $peso;
        $this->idedit = $id;

        $this->editarPresentacion();
    }

    private function editarPresentacion(){

        try{

            $new = $this->con->prepare("
              UPDATE presentacion SET medida = ?, cantidad= ?, peso= ? WHERE cod_pres= ?");
            $new->bindValue(1, $this->medida);
            $new->bindValue(2, $this->cantidad);
            $new->bindValue(3, $this->peso);
            $new->bindValue(4, $this->idedit);
            $new->execute();
            $resultado = ['resultado' => 'Editado'];
            echo json_encode($resultado);
            die();

        }catch(\PDOException $error){
            echo json_encode($error);
            die();
        }

    } 


  public function getEliminar($id){
      
      $this->id = $id;

      $this->eliminarPres();
    }

    private function eliminarPres(){
      try{

        $new = $this->con->prepare("
            UPDATE presentacion SET status = 0 WHERE cod_pres = ?; 
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