<?php 

    namespace modelo;
    use config\connect\DBConnect as DBConnect;

    class pago extends DBConnect{

        public function __construct(){
            parent::__construct();
        }

        public function tipoP($tipo){
            try {
                parent::conectarDB();
                $new = $this->con->prepare("SELECT * FROM banco WHERE tipo_pago = ? AND status = 1");
                $new->bindValue(1, $tipo);
                $new->execute();
                $data = $new->fetchAll();
                echo json_encode($data);
                parent::desconectarDB();
                die();
            } catch (\PDOException $error){
                return $error;
              }
        }

        public function mostrarDatosP($cedula){
            try {
                parent::conectarDB();
                $new = $this->con->prepare("SELECT * FROM cliente c INNER JOIN contacto_cliente cc ON c.cedula = cc.cedula WHERE status = 1 and c.cedula = ?");
                $new->bindValue(1, $cedula);
                $new->execute();
                $data = $new->fetchAll();

                if(isset($data[0]["cedula"])){ 
                    echo json_encode($data);
                    parent::desconectarDB();
                    die();
                }elseif (!isset($data[0]["cedula"])) {
                    $new = $this->con->prepare("SELECT u.cedula, u.nombre, u.apellido, u.correo FROM usuario u WHERE u.cedula = ?");
                    $new->bindValue(1, $cedula);
                    $new->execute();
                    $data = $new->fetchAll();
                    echo json_encode($data);
                    parent::desconectarDB();
                    die();
                }
                
                
            } catch(\PDOexection $error){
                return $error;
            }
        }

        public function mostrarPrecio($cedula){
            try {
                parent::conectarDB();
                $new = $this->con->prepare('SELECT
                    (SELECT SUM(round(car.cantidad*car.precioActual)) FROM carrito car WHERE car.cedula = ?) AS total,
                    (SELECT COUNT(*) FROM carrito car WHERE car.cedula = ?) AS cuenta,
                    (SELECT c.cambio FROM cambio c INNER JOIN moneda m ON c.moneda = m.id_moneda  WHERE c.status = 1 AND m.nombre = "Dolar" or m.nombre = "dolar"ORDER BY c.fecha DESC LIMIT 1) AS cambio');
                $new->bindValue(1, $cedula);
                $new->bindValue(2, $cedula);
                $new->execute();
                $data = $new->fetchAll();
                echo json_encode($data);
                parent::desconectarDB();
                die();

            } catch(\PDOexection $error){
                return $error;
            }
        }

        public function mostrarEmpresa(){
            try {
                parent::conectarDB();
                $new = $this->con->prepare('SELECT * FROM `empresa_envio` WHERE status = 1;');
                $new->execute();
                $data = $new->fetchAll();
                echo json_encode($data);
                parent::desconectarDB();
                die();

            } catch(\PDOexection $error){
                return $error;
            }
        }

        public function mostrarSede($sede){
            try {
                parent::conectarDB();
                $new = $this->con->prepare('SELECT * FROM sede_envio WHERE id_empresa =  ? and status = 1');
                $new->bindValue(1, $sede);
                $new->execute();
                $data = $new->fetchAll();
                echo json_encode($data);
                parent::desconectarDB();
                die();

            } catch(\PDOexection $error){
                return $error;
            }
        }
    }
?>