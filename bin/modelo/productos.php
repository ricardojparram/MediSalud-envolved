<?php

  namespace modelo;
  use config\connect\DBConnect as DBConnect;


  class productos extends DBConnect{
     
     private $id;
     private $fechaV;
     private $composicionP;
     private $posologia;
     private $laboratorio;
     private $tipoP;
     private $clase;
     private $presentación;
     private $ubicación;
     private $contraIn;
     private $cantidad;
     private $precioV;
     private $descripcion;
     private $nombre;
     private $img;
     private $codigo;
     private $img_defecto;



     function __construct(){
      parent::__construct();
    }


    public function getRegistraProd($codigo, $descripcion, $fechaV ,$composicionP, $posologia , $ubicación , $laboratorio , $presentación  , $tipoP , $clase , $contraIn, $cantidad, $precioV){
  

     if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $descripcion) !== 1){
      return "Error de descripcion!";
    }
    
    if(preg_match_all("/^([0-9]{4}\-[0-9]{2}\-[0-9]{2})$/", $fechaV) !== 1){
      return ['resultado' => 'Error fecha', 'error' => 'Error de fecha vencimiento !'];
    }
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $composicionP) !== 1){
      return "Error de composicion de productos!";
    }
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $posologia) !== 1){
      return "Error de posologia!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $laboratorio) !== 1){
      return "Error de laboratorio!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $tipoP) !== 1){
      return "Error de tipo producto!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $clase) !== 1){
      return "Error de clase!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $presentación) !== 1){
      return "Error de presentación!";
    }
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $ubicación) !== 1){
      return "Error de ubicación!";
    }
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $contraIn) !== 1){
      return "Error de Contraindicaciones!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $cantidad) !== 1){
      return "Error de cantidad!";
    }
    if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $precioV) !== 1){
      return "Error de precio de venta!";
    }

    date_default_timezone_set("america/caracas");
    $time = date("Y-m-d");

    if(strftime($time) > strftime($fechaV)){

    $result = ['resultado' => 'Error de fecha', 'error' => 'La fecha es menor'];
    echo json_encode($result);
    die();
    }

    


    $this->codigo = $codigo;
    $this->descripcion = $descripcion;
    $this->composicionP = $composicionP;
    $this->fechaV = $fechaV;
    $this->contraIn = $contraIn;
    $this->ubicación = $ubicación;
    $this->posologia = $posologia;
    $this->cantidad = $cantidad;
    $this->precioV = $precioV;



    $this->laboratorio = $laboratorio;
    $this->tipoP = $tipoP;
    $this->clase = $clase;
    $this->presentación = $presentación;  


    return $this->registraProd();

    }

    private function registraProd(){
     try{
      parent::conectarDB();

      $new = $this->con->prepare("INSERT INTO `producto`(`codigo`, `descripcion`, `ubicacion`, `composicion`, `contraindicaciones`, `posologia`, `vencimiento`, `p_venta`, `stock`, `cod_lab`, `cod_tipo`, `cod_clase`, `cod_pres`,`status`) VALUES ( ? , ? , ? , ? , ? , ? ,? , ? , ? , ? , ? , ? , ? , 1)");

      $new->bindValue(1, $this->codigo);
      $new->bindValue(2, $this->descripcion);
      $new->bindValue(3, $this->ubicación);
      $new->bindValue(4, $this->composicionP);
      $new->bindValue(5, $this->contraIn);
      $new->bindValue(6, $this->posologia);
      $new->bindValue(7, $this->fechaV);
      $new->bindValue(8, $this->precioV);
      $new->bindValue(9, $this->cantidad);
      $new->bindValue(10, $this->laboratorio);
      $new->bindValue(11, $this->tipoP);
      $new->bindValue(12, $this->clase);
      $new->bindValue(13, $this->presentación); 
     
      $new->execute();
             
      $result = ['resultado' => 'Registrado'];

     echo json_encode($result);
     parent::desconectarDB();
     die();

    }catch(\PDOexection $error) {
     $error;

    }
  }




   public function MostrarEditProductos($id){
      try{
        $this->id = $id;
        $new = $this->con->prepare("SELECT `cod_producto`, `codigo` , `descripcion`, `ubicacion`, `composicion`, `contraindicaciones`, `posologia`, `vencimiento`, `p_venta`, `stock`, `cod_lab`, `cod_tipo`, `cod_clase`, `cod_pres`,  `status` FROM producto p WHERE p.status = 1 and p.cod_producto = ?");
        $new->bindValue(1, $this->id);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        die();
        
      }catch(\PDOexection $error){
        
       return $error;   
     } 
    }



   public function getEditarProd($codigoEd, $descripcionEd, $fechaEd ,$composicionEd,$posologiaEd,$ubicaciónEd,$laboratorioEd,$presentaciónEd,$tipoEd,$claseEd,$contraInEd,$cantidadEd,$VentaEd,$id){

 
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $descripcionEd) !== 1){
      return "Error de nombre!";
    }
    if(preg_match_all("/^([0-9]{4}\-[0-9]{2}\-[0-9]{2})$/", $fechaEd) !== 1){
      return ['resultado' => 'Error fecha', 'error' => 'Error de fecha vencimiento !'];
    }
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $composicionEd) !== 1){
      return "Error de composicion de productos!";
    }
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $posologiaEd) !== 1){
      return "Error de pasologia!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $laboratorioEd) !== 1){
      return "Error de laboratorio!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $tipoEd) !== 1){
      return "Error de tipo producto!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $claseEd) !== 1){
      return "Error de clase!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $presentaciónEd) !== 1){
      return "Error de presentación!";
    }
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $ubicaciónEd) !== 1){
      return "Error de ubicación!";
    }
    if(preg_match_all("/^[a-zA-ZÀ-ÿ]+([a-zA-ZÀ-ÿ0-9\s,.-]){3,50}$/", $contraInEd) !== 1){
      return "Error de Contraindicaciones!";
    }
    if(preg_match_all("/^[0-9]{1,10}$/", $cantidadEd) !== 1){
      return "Error de cantidad!";
    }
    if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $VentaEd) !== 1){
      return "Error de precio de venta!";
    }

   
    $this->id = $id;
    $this->codigo = $codigoEd;
    $this->descripcion = $descripcionEd;
    $this->composicionP = $composicionEd;
    $this->fechaV = $fechaEd;
    $this->contraIn = $contraInEd;
    $this->ubicación = $ubicaciónEd;
    $this->posologia = $posologiaEd;
    $this->cantidad = $cantidadEd;
    $this->precioV = $VentaEd;  
    $this->laboratorio = $laboratorioEd;
    $this->tipoP = $tipoEd;
    $this->clase = $claseEd;
    $this->presentación = $presentaciónEd; 

    return $this->editarProd();

    }


    private function editarProd(){
      try{
    parent::conectarDB();
      $new = $this->con->prepare("UPDATE producto p SET `codigo`= ? ,`descripcion`= ? ,`ubicacion`= ? ,`composicion`= ? ,`contraindicaciones`= ? ,`posologia`= ? ,`vencimiento`= ? ,`p_venta`= ?,`stock`= ? ,`cod_lab`= ? ,`cod_tipo`= ? ,`cod_clase`= ? ,`cod_pres`= ? WHERE p.status = 1 AND p.cod_producto = ?");

      $new->bindValue(1, $this->codigo);
      $new->bindValue(2, $this->descripcion);
      $new->bindValue(3, $this->ubicación);
      $new->bindValue(4, $this->composicionP);   
      $new->bindValue(5, $this->contraIn);
      $new->bindValue(6, $this->posologia);
      $new->bindValue(7, $this->fechaV);
      $new->bindValue(8, $this->precioV);
      $new->bindValue(9, $this->cantidad);
      $new->bindValue(10, $this->laboratorio);
      $new->bindValue(11, $this->tipoP);
      $new->bindValue(12, $this->clase); 
      $new->bindValue(13, $this->presentación);
      $new->bindValue(14, $this->id);
      $new->execute();
             
      $resultado = ['resultado' => 'Editado'];
      echo json_encode($resultado);
      parent::desconectarDB();
      die();

    }catch(\PDOexection $error) {
     $error;

    }
  }

   
   public function getEliminarProd($id){
     try{
      $this->id = $id;
      $new = $this->con->prepare("UPDATE `producto` SET `status`= 0 WHERE cod_producto = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $data = $new->fetchAll(\PDO::FETCH_OBJ);
      }
      catch(\PDOexection $error){
      return $error;
      }
    }

    public function MostrarProductos(){
      try{
        parent::conectarDB();
        $query = "SELECT `cod_producto`, `codigo`, `descripcion`, `vencimiento`, format(p_venta,2,'de_DE') as venta, `stock`, t.des_tipo FROM producto p INNER JOIN tipo t ON t.cod_tipo = p.cod_tipo WHERE p.status = 1";

        $new = $this->con->prepare($query);
        $new->execute();
        $data = $new->fetchAll();
        echo json_encode($data);
        parent::desconectarDB();
        die();
      }catch(\PDOexection $error){
        
       return $error;   
     } 
    } 


    public function mostrarLaboratorio(){
      try{
    parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM laboratorio l WHERE l.status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;
   parent::desconectarDB();
      }catch(\PDOexection $error){

       return $error;   
     } 
    }

   
    public function mostrarTipo(){
      try{
        $new = $this->con->prepare("SELECT * FROM tipo t WHERE t.status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      }catch(\PDOexection $error){

       return $error;   
     } 
    }

    public function mostrarPresentacion(){
      try{
        $new = $this->con->prepare("SELECT * FROM presentacion p WHERE p.status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      }catch(\PDOexection $error){

       return $error;   
     } 
    }

    public function mostrarClase(){
      try{
        $new = $this->con->prepare("SELECT * FROM clase c WHERE c.status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      }catch(\PDOexection $error){

       return $error;   
     } 
    }

  }

?>