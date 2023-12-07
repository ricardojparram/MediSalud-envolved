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

    private $modulo;
    private $rol;

    
    public function __construct(){

      $this->usuario = parent::_USER_();
      $this->contra = parent::_PASS_();
      $this->local = parent::_LOCAL_();
      $this->nameBD = parent::_BD_();
      // $this->connectarDB();
    }

    protected function conectarDB(){
      try {
        $this->con = new \PDO("mysql:host={$this->local};dbname={$this->nameBD}", $this->usuario, $this->contra);  
      } catch (\PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        
        die();
      }
    }

    // protected function conectarDB(){
      
    // }
    protected function desconectarDB(){
      $this->con = NULL;  
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

    public function getPermisosRol($rol){
      $this->rol = $rol;

      return $this->consultarPermisos();
    }

    private function consultarPermisos(){

      try {
        $this->conectarDB();
        $new = $this->con->prepare('SELECT id_modulo, nombre FROM modulos');
        $new->execute();
        $modulos = $new->fetchAll(\PDO::FETCH_OBJ);
        $permisos = [];
        foreach ($modulos as $modulo) { $permisos[$modulo->nombre] = ''; }

        $query = 'SELECT m.nombre, p.nombre_accion, p.status FROM permisos p
                  INNER JOIN modulos m ON m.id_modulo = p.id_modulo
                  WHERE p.id_rol = ? AND m.nombre = ? AND p.status = 1';

        foreach ($permisos as $nombre_modulo => $valor) {

          $new = $this->con->prepare($query);
          $new->bindValue(1, $this->rol);
          $new->bindValue(2, $nombre_modulo);
          $new->execute();
          $data = $new->fetchAll(\PDO::FETCH_OBJ);
          $acciones = []; 

          foreach($data as $modulo){
            $acciones += [$modulo->nombre_accion => $modulo->status];
          }
          $permisos[$nombre_modulo] = $acciones;
        }
        $this->desconectarDB();

        return $permisos;

      } catch (\PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
      }

    }

    public function getNotificacion(){

      $this->notificaciones();
    }

    private function notificaciones(){
      try {
        $this->conectarDB();

        // consulta de productos por vencer 
        $new = $this->con->prepare("SELECT p.cod_producto, p.nombre, DATEDIFF(p.vencimiento, NOW()) AS dias_restantes, TIMEDIFF(DATE_FORMAT(p.vencimiento, '%Y-%m-%d %H:%i:%s'), NOW()) AS horas_restantes FROM producto p WHERE p.vencimiento BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) AND p.stock > 0 AND p.status = 1");

        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);

        // consulta de productos vencidos  
        $new1 = $this->con->prepare("SELECT p.cod_producto, p.nombre, DATEDIFF(p.vencimiento, NOW()) AS dias_vencidos, TIMEDIFF(DATE_FORMAT(p.vencimiento, '%Y-%m-%d %H:%i:%s'), NOW()) AS horas_vencidas FROM producto p WHERE p.vencimiento BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() AND p.stock > 0 AND p.status = 1");
        $new1->execute();
        $data1 = $new1->fetchAll(\PDO::FETCH_OBJ);

        // Dia de Inventario
        $new2 = $this->con->prepare("SELECT p.cod_producto , p.descripcion , v.fecha , p.stock , SUM(vp.cantidad) as cantidadXmes, SUM(vp.cantidad)/30 as dia_inventario FROM producto p INNER JOIN venta_producto vp ON p.cod_producto = vp.cod_producto INNER JOIN venta v ON v.num_fact = vp.num_fact WHERE MONTH(v.fecha) = (MONTH(NOW())-1) AND p.status = 1 AND v.status = 1 GROUP BY p.cod_producto");
        $new2->execute();
        $data2 = $new2->fetchAll(\PDO::FETCH_OBJ);

        // Productos proximos a terminar y terminados 
        $new = $this->con->prepare('SELECT p.cod_producto , p.descripcion , p.stock FROM producto p WHERE p.stock <= 10 AND p.status = 1');
        $new->execute();
        $data3 = $new->fetchAll(\PDO::FETCH_OBJ);

        $resultado = ['PorVencer' => $data , 'vencidos' => $data1 , 'diaDeInventario' => $data2 , 'StockBajo' => $data3]; 

        echo json_encode($resultado);
        $this->desconectarDB();
        die();
        
      } catch (\PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
      }


    }


  }


?>