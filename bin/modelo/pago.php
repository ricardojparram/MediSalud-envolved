<?php 

    namespace modelo;
    use config\connect\DBConnect as DBConnect;

    class pago extends DBConnect{

        private $cedula;
        private $nombre;
        private $apellido;
        private $direccionF;
        private $telefono;
        private $correo;
        private $sede;
        private $direccionE;
        private $detalles;



        public function tipoP($tipo){
            try {
                switch ($tipo) {
                    case '4':
                        $query = "SELECT * from banco c INNER JOIN datos_cobro_farmacia d on c.id_banco = d.id_banco WHERE d.num_cuenta is NULL and c.status =1;";
                        break;

                     case '5':
                        $query = "SELECT * from banco c INNER JOIN datos_cobro_farmacia d on c.id_banco = d.id_banco WHERE d.telefono is NULL and c.status = 1;";
                        break;
                    
                    default:
                        die();
                        break;
                }
                parent::conectarDB();
                $new = $this->con->prepare($query);
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
                    (SELECT c.cambio FROM cambio c INNER JOIN moneda m ON c.moneda = m.id_moneda  WHERE c.status = 1 AND m.nombre = "Dolar" or m.nombre = "dolar"ORDER BY c.fecha DESC LIMIT 1) AS cambio,
                    (SELECT c.id_cambio FROM cambio c INNER JOIN moneda m ON c.moneda = m.id_moneda  WHERE c.status = 1 AND m.nombre = "Dolar" or m.nombre = "dolar"ORDER BY c.fecha DESC LIMIT 1) AS id_cambio');
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

        public function getMostrarMetodo(){
            try{
              parent::conectarDB();
              $new = $this->con->prepare("SELECT * FROM `tipo_pago` WHERE status = 1 and online = 1");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              echo json_encode($data);
              parent::desconectarDB();
              die();
      
            }catch(\PDOexection $error){
      
             return $error;   
      
           }   
        }

        public function banco(){
            try{
                parent::conectarDB();
                $new = $this->con->prepare("SELECT * FROM `banco` WHERE status = 1");
                $new->execute();
                $data = $new->fetchAll(\PDO::FETCH_OBJ);
                echo json_encode($data);
                parent::desconectarDB();
                die();
        
              }catch(\PDOexection $error){
        
               return $error;   
        
             }   
        }

          public function nunca($cedula, $nombre, $apellido, $direccionF, $telefono, $correo, $sede, $direccionE, $detalles){

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

            if(preg_match_all("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $correo) == false){
                $resultado = ['resultado' => 'Error de email' , 'error' => 'Correo invalida.'];
                echo json_encode($resultado);
                die();
            }



            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->direccionF = $direccionF;
            $this->telefono = $telefono;
            $this->correo = $correo;
            $this->sede = $sede;
            $this->direccionE = $direccionE;
            $this->detalles = $detalles;
            $this->hola2();
          }

          private function hola2(){
            try {
                parent::conectarDB();
                $new = $this->con->prepare("SELECT cedula FROM cliente WHERE status = 1 and cedula = ?");
                $new->bindValue(1, $this->cedula);
                $new->execute();
                $data = $new->fetchAll();
                parent::desconectarDB();
                if(isset($data[0]["cedula"])){ 
                    
                    parent::conectarDB();
                    $new = $this->con->prepare("UPDATE cliente c INNER JOIN contacto_cliente cc ON c.cedula = cc.cedula SET c.cedula = ?, c.nombre = ?, c.apellido = ?, c.direccion = ?, cc.celular= ?, cc.correo = ?, cc.cedula = ? WHERE c.cedula = ?");
                    $new->bindValue(1, $this->cedula);
                    $new->bindValue(2, $this->nombre);
                    $new->bindValue(3, $this->apellido);
                    $new->bindValue(4, $this->direccionF);
                    $new->bindValue(5, $this->telefono);
                    $new->bindValue(6, $this->correo);
                    $new->bindValue(7, $this->cedula);
                    $new->bindValue(8, $this->cedula);
                    $new->execute();
                    parent::desconectarDB();
                    // $resultado = ['resultado' => 'Editado'];
                    // echo json_encode($resultado);
                    // die();
                }else {
                    parent::conectarDB();
                    $new = $this->con->prepare("INSERT INTO cliente(cedula, nombre, apellido, direccion, status) VALUES (?,?,?,?,1)");
                    $new->bindValue(1, $this->cedula);
                    $new->bindValue(2, $this->nombre);
                    $new->bindValue(3, $this->apellido);
                    $new->bindValue(4, $this->direccionF);
                    $new->execute();

                    $new = $this->con->prepare("INSERT INTO contacto_cliente(id_contacto, celular, correo, cedula) VALUES (DEFAULT,?,?,?)");
                    $new->bindValue(1, $this->telefono);
                    $new->bindValue(2, $this->correo); 
                    $new->bindValue(3, $this->cedula);
                    $new->execute();
                    $resultado = ['resultado' => 'Registrado correctamente.'];
                    // echo json_encode($resultado);
                    // die();
                    parent::desconectarDB();
                }

                parent::conectarDB();
                if($this->sede != "" || $this->sede != NULL){

                    $new = $this->con->prepare("INSERT INTO `envio`(`id_envio`, `id_sede`, `status`) VALUES (DEFAULT, ?, 3)");
                    $new->bindValue(1, $this->sede);
                    $new->execute();

                    $new = $this->con->prepare("INSERT INTO `venta`(`num_fact`, `fecha`, `cedula_cliente`, `direccion`, `id_envio`, `online`, `status`) 
                                                VALUES (DEFAULT, DEFAULT, ?, NULL, ?, 1, 1)");
                    $new->bindValue(1, $this->cedula);
                    $new->bindValue(2, $this->sede);
                    $new->execute();
                    // $resultado = ['resultado' => 'Registrado Sede'];
                    // echo json_encode($resultado);
                }elseif ($this->direccionE != NULL || $this->direccionE != "") {

                    $new = $this->con->prepare("INSERT INTO `venta`(`num_fact`, `fecha`, `cedula_cliente`, `direccion`, `id_envio`, `online`, `status`) 
                                                VALUES (DEFAULT, DEFAULT, ?, ?, NULL, 1, 1)");
                    $new->bindValue(1, $this->cedula);
                    $new->bindValue(2, $this->direccionE);
                    $new->execute();

                    // $resultado = ['resultado' => 'Registrado Direccion'];
                    // echo json_encode($resultado);
                }else{

                    $new = $this->con->prepare("INSERT INTO `venta`(`num_fact`, `fecha`, `cedula_cliente`, `direccion`, `id_envio`, `online`, `status`) 
                                                VALUES (DEFAULT, DEFAULT, ?, NULL, NULL, 1, 1)");
                    $new->bindValue(1, $this->cedula);
                    $new->execute();
                    // $resultado = ['resultado' => 'Registrado Entrega'];
                    // echo json_encode($resultado);
                }
                $numFactura = $this->con->lastInsertId();

                $new = $this->con->prepare("SELECT c.cod_producto, c.cantidad, c.precioActual FROM carrito c INNER JOIN producto p ON c.cod_producto = p.cod_producto WHERE c.cedula = ?;");
                $new->bindValue(1, $this->cedula);
                $new->execute();
                $data = $new->fetchAll();

                foreach ($data as $dato) {
                    $new = $this->con->prepare("INSERT INTO `venta_producto`(`num_fact`, `cod_producto`, `cantidad`, `precio_actual`) 
                                                VALUES (?, ?, ?, ?)");
                    $new->bindValue(1, $numFactura);
                    $new->bindValue(2, $dato['cod_producto']);
                    $new->bindValue(3, $dato['cantidad']);
                    $new->bindValue(4, $dato['precioActual']);
                    $new->execute();
                }

                $new = $this->con->prepare("DELETE FROM carrito WHERE cedula = ?");
                $new->bindValue(1, $this->cedula);
                $new->execute();

                $monto = array_column($this->detalles, 'monto');
                $totalMonto = array_sum($monto);
                

                    $new = $this->con->prepare("INSERT INTO `pago`(`id_pago`, `monto_total`, `num_fact`, `status`) 
                                            VALUES (DEFAULT, ?, ?, 1)");
                    $new->bindValue(1, $totalMonto);
                    $new->bindValue(2, $numFactura);
                    $new->execute();
                    $idPago = $this->con->lastInsertId();

                
                    

                foreach($this->detalles as $deta){
                    try{
                        $deta['bancoReceptor'] = ($deta['bancoReceptor'] == " ") ? NULL : $deta['bancoReceptor'] ;
                        $deta['bancoEmisor'] = ($deta['bancoEmisor'] == " ") ? NULL : $deta['bancoEmisor'] ;
                        $deta['referencia'] = ($deta['referencia'] == " ") ? NULL : $deta['referencia'] ;

                        $new = $this->con->prepare("INSERT INTO detalle_pago(id_pago, id_tipo_pago, id_datos_cobro, id_banco_cliente, monto_pago, id_cambio, referencia) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $new->bindValue(1, $idPago);
                        $new->bindValue(2, $deta['tipo']);
                        $new->bindValue(3, $deta['bancoReceptor']);
                        $new->bindValue(4, $deta['bancoEmisor']);
                        $new->bindValue(5, $deta['monto']);
                        $new->bindValue(6, $deta['cambio']);
                        $new->bindValue(7, $deta['referencia']);
                        $new->execute();

                    }catch(\PDOException $e){
                        die($e);
                    }

                }


                parent::desconectarDB();
                $resultado = ['resultado' => 'Registrado Pedido'];
                echo json_encode($resultado);

                die();
            } catch (\PDOException $error) {
                return $error;
            }
          }
    }
?>