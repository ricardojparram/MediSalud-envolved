<?php

namespace modelo;

Use config\connect\DBConnect as DBConnect;

class bitacora extends DBConnect{

    public function __construct(){
        parent::__construct();
    }

    public function mostrarBitacora(){
        try {
            $new = $this->con->prepare("SELECT b.modulo, concat(u.nombre,' ',u.apellido) as nombre, b.descripcion, b.fecha FROM bitacora b INNER JOIN usuario u ON b.usuario = u.cedula WHERE b.status = 1");
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
        } catch (\PDOexection $error) {
            return $error;
        }
    }

}

?>