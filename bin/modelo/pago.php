<?php 

    namespace modelo;
    use config\connect\DBConnect as DBConnect;

    class pago extends DBConnect{

        public function __construct(){
            parent::__construct();
        }

        public function tipoP($tipo){
            try {
                $new = $this->con->prepare("SELECT * FROM banco WHERE tipo_pago = ? AND status = 1");
                $new->bindValue(1, $tipo);
                $new->execute();
                $data = $new->fetchAll();
                echo json_encode($data);
                die();
            } catch (\PDOException $error){
                return $error;
              }
        }

        public function mostrarDatosP($cedula){
            try {
                $new = $this->con->prepare("SELECT u.cedula, u.nombre, u.apellido, u.correo FROM usuario u  WHERE u.cedula = ?");
                $new->bindValue(1, $cedula);
                $new->execute();
                $data = $new->fetchAll();
                echo json_encode($data);
                die();
            } catch(\PDOexection $error){
                return $error;
            }
        }
    }
?>