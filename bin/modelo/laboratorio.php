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
 
      public function mostrarLaboratoriosAjax($bitacora){
        try{
          $this->conectarDB();
          $sql = "SELECT l.rif, l.razon_social, l.direccion, cl.telefono, cl.contacto, l.cod_lab FROM laboratorio l
                  INNER JOIN contacto_lab cl ON cl.cod_lab = l.cod_lab
                  WHERE l.status = 1;";
          $new = $this->con->prepare($sql);
          $new->execute();
          $data = $new->fetchAll(\PDO::FETCH_OBJ);
          if($bitacora == "true") $this->binnacle("Laboratorio",$_SESSION['cedula'],"Consultó listado.");
          $this->desconectarDB();
          die(json_encode($data));

        }catch(\PDOException $e){
          print "¡Error!: " . $e->getMessage() . "<br/>";
          die();
        }
      } 

      public function getDatosLab($rif, $direccion, $razon, $telefono, $contacto){

        if(preg_match_all("/^[0-9]{7,10}$/", $rif) != 1){
          die(json_encode(['resultado' => 'Error de rif','msg' => 'Rif inválido.']));
        }
        if(preg_match_all("/^[a-zA-ZÀ-ÿ]{0,30}$/", $razon) != 1){
          die(json_encode(['resultado' => 'Error de nombre','msg' => 'Nombre inválido.']));
        }
        if(preg_match_all('/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s#\/,.-]){7,160}$/', $direccion) != 1){
          die(json_encode(['resultado' => 'Error de direccion','msg' => 'Direccion inválida.']));
        }
        if(preg_match_all("/^[0-9]{10,30}$/", $telefono) != 1){
          die(json_encode(['resultado' => 'Error de telefono','msg' => 'Telefono inválido.']));
        }

        $this->rif = $rif;
        $this->direccion = $direccion;
        $this->razon = $razon;
        $this->telefono = $telefono;
        $this->contacto = $contacto;

        $this->registrarLab();

      }

      private function registrarLab(){

        try{
          $this->conectarDB();
          $pk = $this->uniqueID();
          $new = $this->con->prepare("INSERT INTO laboratorio(cod_lab,rif,direccion,razon_social,status) VALUES(?,?,?,?,1)");
          $new->bindValue(1, $pk);
          $new->bindValue(2, $this->rif); 
          $new->bindValue(3, $this->direccion); 
          $new->bindValue(4, $this->razon);
          $new->execute();

          $new = $this->con->prepare("INSERT INTO contacto_lab(id_contacto_lab, telefono, contacto, cod_lab) VALUES (DEFAULT, ?, ?, ?)");
          $new->bindValue(1, $this->telefono);
          $new->bindValue(2, $this->contacto);
          $new->bindValue(3, $pk);
          $new->execute();
          $resultado = ['resultado' => 'ok', 'msg' => "Laboratorio registrado."];
          $this->binnacle("Laboratorio",$_SESSION['cedula'],"Registró laboratorio.");
          $this->desconectarDB();
          die(json_encode($resultado));            

        }catch(\PDOException $error){
          print "¡Error!: " . $e->getMessage() . "<br/>";
          die();
        } 

      }

      public function getRif($rif, $idLab){

        if(preg_match_all("/^[0-9]{7,10}$/", $rif) != 1){
          die(json_encode(['resultado' => 'Error de rif','msg' => 'Rif inválido.']));
        }

        $this->idedit = ($idLab === "false") ? false : $idLab;
        $this->rif = $rif;

        return $this->validarRif();
      }

      private function validarRif(){

        try {
          $this->conectarDB();

          if($this->idedit === false){
            $new = $this->con->prepare('SELECT rif FROM laboratorio WHERE status = 1 and rif = ?');
            $new->bindValue(1, $this->rif);
          }else{
            $new = $this->con->prepare('SELECT rif FROM laboratorio WHERE status = 1 and rif = ? AND cod_lab != ?');
            $new->bindValue(1, $this->rif);
            $new->bindValue(2, $this->idedit);
          }
          
          $new->execute();
          $data = $new->fetchAll();

          $resultado;
          if(isset($data[0]['rif'])){
            $resultado = ['resultado' => 'Error de rif', 'msg' => 'El rif ya está registrado.', 'res' => false];
          }else{
            $resultado = ['resultado' => 'Rif válido.', 'res' => true];
          }
          $this->desconectarDB();
          return $resultado;

        } catch (PDOException $e) {
          print "¡Error!: " . $e->getMessage() . "<br/>";
          die();
        }

      }


      public function getItem($id){

        if(preg_match_all("/^[a-fA-F0-9]{10}$/", $id) != 1){
          die(json_encode(['resultado' => 'Error de id','msg' => 'Id inválida.']));
        }

        $this->id = $id;

        $this->selectItem();
      }

      private function selectItem(){

        try{
          $this->conectarDB();
          $sql = "SELECT * FROM laboratorio l 
          INNER JOIN contacto_lab cl ON l.cod_lab = cl.cod_lab 
          WHERE l.status = 1 and l.cod_lab = ? ;";
          $new = $this->con->prepare($sql);
          $new->bindValue(1, $this->id);
          $new->execute();
          $data = $new->fetchAll(\PDO::FETCH_OBJ);
          $this->desconectarDB();
          die(json_encode($data));

        }catch(\PDOException $e){
          print "¡Error!: " . $e->getMessage() . "<br/>";
          die();
        }

      }

      public function getEditar($rif, $direccion, $razon, $telefono, $contacto, $id){

        if(preg_match_all("/^[0-9]{7,10}$/", $rif) != 1){
          die(json_encode(['resultado' => 'Error de rif','msg' => 'Rif inválido.']));
        }
        if(preg_match_all("/^[a-zA-ZÀ-ÿ]{0,30}$/", $razon) != 1){
          die(json_encode(['resultado' => 'Error de nombre','msg' => 'Nombre inválido.']));
        }
        if(preg_match_all('/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s#\"\/,.-]){7,160}$/', $direccion) != 1){
          die(json_encode(['resultado' => 'Error de direccion','msg' => 'Direccion inválida.']));
        }
        if(preg_match_all("/^[0-9]{10,30}$/", $telefono) != 1){
          die(json_encode(['resultado' => 'Error de telefono','msg' => 'Telefono inválido.']));
        }
        if(preg_match_all("/^[a-fA-F0-9]{10}$/", $id) != 1){
          die(json_encode(['resultado' => 'Error de id','msg' => 'Id inválida.']));
        }

        $this->rif = $rif;
        $this->direccion = $direccion;
        $this->razon = $razon;
        $this->telefono = $telefono;
        $this->contacto = $contacto;
        $this->idedit = $id;

        $validarRif = $this->validarRif();
        if($validarRif['res'] === false) die(json_encode(["resultado" => "error", "msg" => "Rif ya registrado"]));

        $this->editarLaboratorio();
      }

      private function editarLaboratorio(){

        try{
          $this->conectarDB();
          $sql = "UPDATE laboratorio l
          INNER JOIN contacto_lab cl ON l.cod_lab = cl.cod_lab
          SET l.rif = ? , l.direccion = ? , l.razon_social = ? , cl.telefono = ?, cl.contacto = ?
          WHERE l.cod_lab = ?";
          $new = $this->con->prepare($sql);
          $new->bindValue(1, $this->rif);
          $new->bindValue(2, $this->direccion);
          $new->bindValue(3, $this->razon);
          $new->bindValue(4, $this->telefono);
          $new->bindValue(5, $this->contacto);
          $new->bindValue(6, $this->idedit);
          $new->execute();
          $resultado = ['resultado' => 'ok', "msg" => "Laboratorio editado correctamente."];
          $this->binnacle("Laboratorio",$_SESSION['cedula'],"Editó laboratorio.");
          $this->desconectarDB();
          die(json_encode($resultado));

        }catch(\PDOException $error){
          print "¡Error!: " . $e->getMessage() . "<br/>";
          die();
        }

      } 


      public function getEliminar($id){
        if(preg_match_all("/^[a-fA-F0-9]{10}$/", $id) != 1){
          die(json_encode(['resultado' => 'Error de id','msg' => 'Id inválida.']));
        }

        $this->id = $id;

        $this->eliminarLaboratorio();
      }

      private function eliminarLaboratorio(){
        try{
          $this->conectarDB();
          $new = $this->con->prepare("UPDATE laboratorio SET status = 0 WHERE laboratorio.cod_lab = ?; ");
          $new->bindValue(1, $this->id);
          $new->execute();
          $resultado = ['resultado' => 'ok', 'msg' => "Laboratorio eliminado correctamente."];
          $this->binnacle("Laboratorio",$_SESSION['cedula'],"Eliminó laboratorio.");
          $this->desconectarDB();
          die(json_encode($resultado));

        }catch(\PDOException $e){
          print "¡Error!: " . $e->getMessage() . "<br/>";
          die();
        }

      }
  }

?>