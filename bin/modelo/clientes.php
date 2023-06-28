<?php 

namespace modelo;

Use config\connect\DBConnect as DBConnect;

class clientes extends DBConnect{

    private $nombre;
    private $apellido;
    private $cedula;
    private $direccion;
    private $telefono;
    private $correo;
    private $id;
    private $unico;

    public function __construct(){
        parent::__construct();
    }

    public function getRegistrarClientes($nombre, $apellido, $cedula, $direccion, $telefono, $correo){

        if(preg_match_all("/^[a-zA-ZÀ-ÿ]{0,30}$/", $nombre) == false){
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
        if(preg_match_all("/[$%&|<>]/", $direccion) == true){
            $resultado = ['resultado' => 'Error de direccion' , 'error' => 'Direccion inválida.'];
            echo json_encode($resultado);
            die();
        }

        $this->nombre =$nombre;
        $this->apellido =$apellido;
        $this->cedula =$cedula;
        $this->direccion =$direccion;
        $this->telefono =$telefono;
        $this->correo =$correo;

        return $this->registraCliente();
    }

    private function registraCliente(){

        try {
            $new = $this->con->prepare("SELECT cedula FROM cliente WHERE status = 1 and cedula = ?");
            $new->bindValue(1, $this->cedula);
            $new->execute();
            $data = $new->fetchAll();

            if(!isset($data[0]["cedula"])){ 

              $new = $this->con->prepare("INSERT INTO cliente(cedula, nombre, apellido, direccion, status) VALUES (?,?,?,?,1)");
              $new->bindValue(1, $this->cedula);
              $new->bindValue(2, $this->nombre);
              $new->bindValue(3, $this->apellido);
              $new->bindValue(4, $this->direccion);
              $new->execute();

              $new = $this->con->prepare("INSERT INTO contacto_cliente(id_contacto, celular, correo, cedula) VALUES (DEFAULT,?,?,?)");
              $new->bindValue(1, $this->telefono);
              $new->bindValue(2, $this->correo); 
              $new->bindValue(3, $this->cedula);
              $new->execute();
              $resultado = ['resultado' => 'Registrado correctamente.'];
              echo json_encode($resultado);
              die();



          }else{
            $resultado = ['resultado' => 'Error de cedula' , 'error' => 'La cédula ya está registrada.'];
            echo json_encode($resultado);
            die();
        }

    }catch(PDOException $error){
        return $error;
    }

    }

    public function eliminarClientes($cedulaDel){
        $this->id = $cedulaDel;

        return $this->eliminar();
    }

    private function eliminar(){
        try{
            $new = $this->con->prepare("DELETE FROM `cliente` WHERE cedula = ?"); //"UPDATE `cliente` SET `status`= 0 WHERE cedula = ?"
            $new->bindValue(1, $this->id);
            $new->execute();
            $resultado = ['resultado' => 'Eliminado'];
            echo json_encode($resultado);
            die();

        }
        catch(PDOexection $error){
            return $error;
        }
    }

    public function mostrarClientes(){
        try{
            $query = "SELECT c.nombre, c.apellido, c.cedula, c.direccion, cc.celular, cc.correo, CONCAT('<button type=\"button\" class=\"btn btn-success editar\" id=\"',c.cedula,'\" data-bs-toggle=\"modal\" data-bs-target=\"#editModal\"><i class=\"bi bi-pencil\"></i></button> <button type=\"button\" class=\"btn btn-danger eliminar\" id=\"',c.cedula,'\" data-bs-toggle=\"modal\" data-bs-target=\"#delModal\"><i class=\"bi bi-trash3\"></i></button>') AS opciones FROM cliente c INNER JOIN contacto_cliente cc ON c.cedula = cc.cedula WHERE status = 1";
            $new = $this->con->prepare($query);
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
        }
        catch(\PDOexection $error){
            return $error;
        }
    }


    public function unicoCliente($id){
        $this->unico = $id;

        return $this->selectCliente(); 
    }

    private function selectCliente(){
        try{
            $new = $this->con->prepare("SELECT * FROM cliente c INNER JOIN contacto_cliente cc ON c.cedula = cc.cedula WHERE status = 1 and c.cedula = ?");
            $new->bindValue(1, $this->unico);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        }
        catch(\PDOexection $error){
            return $error;
        }
    }

    public function getEditar($nombre, $apellido, $cedula, $direccion, $telefono, $correo, $id){

        if(preg_match_all("/^[a-zA-Z]{0,30}$/", $nombre) == false){
            $resultado = ['resultado' => 'Error de nombre' , 'error' => 'Nombre inválido.'];
            echo json_encode($resultado);
            die();
        }
        if(preg_match_all("/^[a-zA-Z]{0,30}$/", $apellido) == false){
            $resultado = ['resultado' => 'Error de apellido' , 'error' => 'Apellido inválido.'];
            echo json_encode($resultado);
            die();
        }
        if(preg_match_all("/^[0-9]{7,10}$/", $cedula) == false){
            $resultado = ['resultado' => 'Error de cedula' , 'error' => 'Cédula inválida.'];
            echo json_encode($resultado);
            die();
        }
        if(preg_match_all("/[$%&|<>]/", $direccion) == true){
            $resultado = ['resultado' => 'Error de direccion' , 'error' => 'Direccion inválida.'];
            echo json_encode($resultado);
            die();
        }

        $this->nombre =$nombre;
        $this->apellido =$apellido;
        $this->cedula =$cedula;
        $this->direccion =$direccion;
        $this->telefono =$telefono;
        $this->correo =$correo;
        $this->id = $id;

        return $this->editarCliente();
    }

    private function editarCliente(){
        try {
            $new = $this->con->prepare("UPDATE cliente c INNER JOIN contacto_cliente cc ON c.cedula = cc.cedula SET c.cedula = ?, c.nombre = ?, c.apellido = ?, c.direccion = ?, cc.celular= ?, cc.correo = ?, cc.cedula = ? WHERE c.cedula = ?");
            $new->bindValue(1, $this->cedula);
            $new->bindValue(2, $this->nombre);
            $new->bindValue(3, $this->apellido);
            $new->bindValue(4, $this->direccion);
            $new->bindValue(5, $this->telefono);
            $new->bindValue(6, $this->correo);
            $new->bindValue(7, $this->cedula);
            $new->bindValue(8, $this->id);
            $new->execute();
            $resultado = ['resultado' => 'Editado'];
            echo json_encode($resultado);
            die();
        } catch (\PDOException $error) {
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
          $new = $this->con->prepare("SELECT `cedula` FROM `cliente` WHERE `status` = 1 and `cedula` = ?");
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


}

?>    