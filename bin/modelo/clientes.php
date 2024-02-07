<?php

namespace modelo;

use config\connect\DBConnect as DBConnect;

class clientes extends DBConnect
{

    private $nombre;
    private $apellido;
    private $cedula;
    private $direccion;
    private $telefono;
    private $correo;
    private $id;
    private $unico;

    private $key;
    private $iv;
    private $cipher;

    public function __construct()
    {
        parent::__construct();
    }

    public function getRegistrarClientes($nombre, $apellido, $cedula, $direccion, $telefono, $correo)
    {

        if (preg_match_all("/^[a-zA-ZÀ-ÿ ]{0,30}$/", $nombre) == false) {
            $resultado = ['resultado' => 'Error', 'error' => 'Nombre inválido.'];
            return $resultado;
        }
        if (preg_match_all("/^[a-zA-ZÀ-ÿ ]{0,30}$/", $apellido) == false) {
            $resultado = ['resultado' => 'Error', 'error' => 'Apellido inválido.'];
            return $resultado;
        }
        if (preg_match_all("/^[0-9]{7,10}$/", $cedula) == false) {
            $resultado = ['resultado' => 'Error', 'error' => 'Cédula inválida.'];
            return $resultado;
        }
        if (preg_match_all("/[$%&|<>]/", $direccion) == true) {
            $resultado = ['resultado' => 'Error', 'error' => 'Direccion inválida.'];
            return $resultado;
        }
        if ($telefono != "") {
            if (preg_match_all("/^[0-9]{10,30}$/", $telefono) == false) {
                $resultado = ['resultado' => 'Error', 'error' => 'Telefono Invalido'];
                return $resultado;
            }
        }
        if ($correo != "") {
            
            if (preg_match_all("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $correo) == false) {
                $resultado = ['resultado' => 'Error', 'error' => 'Correo invalida.'];
                return $resultado;
            }
        }

        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->correo = $correo;

        return $this->registraCliente();
    }

    private function registraCliente()
    {

        try {

            $this->key = parent::KEY();
            $this->iv = parent::IV();
            $this->cipher = parent::CIPHER();

            $this->cedula = openssl_encrypt($this->cedula, $this->cipher, $this->key, 0, $this->iv);
            $this->correo = openssl_encrypt($this->correo, $this->cipher, $this->key, 0, $this->iv);
            $this->direccion = openssl_encrypt($this->direccion, $this->cipher, $this->key, 0, $this->iv);
            $this->telefono = openssl_encrypt($this->telefono, $this->cipher, $this->key, 0, $this->iv);

            parent::conectarDB();
            $new = $this->con->prepare("SELECT `cedula`, `status` FROM cliente WHERE cedula = ?");
            $new->bindValue(1, $this->cedula);
            $new->execute();
            $data = $new->fetchAll();

            parent::desconectarDB();
            if (!isset($data[0]["cedula"])) {

                parent::conectarDB();
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
                
                $this->binnacle("Cliente", $_SESSION['cedula'], "Registró un cliente");
                parent::desconectarDB();



            } elseif ($data[0]['status'] == 0) {
                parent::conectarDB();
                $new = $this->con->prepare("UPDATE cliente c INNER JOIN contacto_cliente cc ON c.cedula = cc.cedula SET c.nombre = ?, c.apellido = ?, c.direccion = ?, cc.celular= ?, cc.correo = ?, `status`= 1 WHERE c.cedula = ?");
                $new->bindValue(1, $this->nombre);
                $new->bindValue(2, $this->apellido);
                $new->bindValue(3, $this->direccion);
                $new->bindValue(4, $this->telefono);
                $new->bindValue(5, $this->correo);
                $new->bindValue(6, $this->cedula);
                $new->execute();
                $resultado = ['resultado' => 'Registrado correctamente.'];
                
                $this->binnacle("Cliente", $_SESSION['cedula'], "Registro");
                parent::desconectarDB();
            } else {
                $resultado = ['resultado' => 'Error', 'error' => 'La cédula ya está registrada.'];
                
            }
            return $resultado;

        } catch (PDOException $error) {
            return $error;
        }

    }

    public function eliminarClientes($cedulaDel)
    {
        $this->id = $cedulaDel;

        return $this->eliminar();
    }

    private function eliminar()
    {
        try {
            parent::conectarDB();
            $new = $this->con->prepare("UPDATE `cliente` SET `status`= 0 WHERE cedula = ?"); //"DELETE FROM `cliente` WHERE cedula = ?"
            $new->bindValue(1, $this->id);
            $new->execute();
            $resultado = ['resultado' => 'Eliminado'];
            $this->binnacle("Cliente", $_SESSION['cedula'], "Eliminó un cliente");
            parent::desconectarDB();
            return $resultado;

        } catch (PDOexection $error) {
            return $error;
        }
    }

    public function mostrarClientes($bitacora = false)
    {
        try {
            parent::conectarDB();

            $this->key = parent::KEY();
            $this->iv = parent::IV();
            $this->cipher = parent::CIPHER();
            $query = "SELECT c.nombre, c.apellido, c.cedula, c.cedula as cedulaE, c.direccion, cc.celular, cc.correo FROM cliente c INNER JOIN contacto_cliente cc ON c.cedula = cc.cedula WHERE status = 1";
            $new = $this->con->prepare($query);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            foreach ($data as $item) {
                $item->cedula = openssl_decrypt($item->cedula, $this->cipher, $this->key, 0, $this->iv);
                $item->direccion = openssl_decrypt($item->direccion, $this->cipher, $this->key, 0, $this->iv);
                $item->celular = openssl_decrypt($item->celular, $this->cipher, $this->key, 0, $this->iv);
                $item->correo = openssl_decrypt($item->correo, $this->cipher, $this->key, 0, $this->iv);
            }
            if ($bitacora)
                $this->binnacle("Clientes", $_SESSION['cedula'], "Consultó listado.");
            parent::desconectarDB();
            return $data;
        } catch (\PDOexection $error) {
            return $error;
        }
    }


    public function unicoCliente($id)
    {
        $this->unico = $id;

        return $this->selectCliente();
    }

    private function selectCliente()
    {
        try {
            parent::conectarDB();

            $this->key = parent::KEY();
            $this->iv = parent::IV();
            $this->cipher = parent::CIPHER();

            $new = $this->con->prepare("SELECT * FROM cliente c INNER JOIN contacto_cliente cc ON c.cedula = cc.cedula WHERE c.cedula = ?");
            $new->bindValue(1, $this->unico);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            $data[0]->cedula = openssl_decrypt($data[0]->cedula, $this->cipher, $this->key, 0, $this->iv);
            $data[0]->correo = openssl_decrypt($data[0]->correo, $this->cipher, $this->key, 0, $this->iv);
            $data[0]->celular = openssl_decrypt($data[0]->celular, $this->cipher, $this->key, 0, $this->iv);
            $data[0]->direccion = openssl_decrypt($data[0]->direccion, $this->cipher, $this->key, 0, $this->iv);

            parent::desconectarDB();
            return $data;
        } catch (\PDOexection $error) {
            return $error;
        }
    }

    public function getEditar($nombre, $apellido, $cedula, $direccion, $telefono, $correo, $id)
    {

        if (preg_match_all("/^[a-zA-ZÀ-ÿ ]{0,30}$/", $nombre) == false) {
            $resultado = ['resultado' => 'Error', 'error' => 'Nombre inválido.'];
            return $resultado;
        }
        if (preg_match_all("/^[a-zA-ZÀ-ÿ ]{0,30}$/", $apellido) == false) {
            $resultado = ['resultado' => 'Error', 'error' => 'Apellido inválido.'];
            return $resultado;
        }
        if (preg_match_all("/^[0-9]{7,10}$/", $cedula) == false) {
            $resultado = ['resultado' => 'Error', 'error' => 'Cédula inválida.'];
            return $resultado;
        }
        if (preg_match_all("/[$%&|<>]/", $direccion) == true) {
            $resultado = ['resultado' => 'Error', 'error' => 'Direccion inválida.'];
            return $resultado;
        }
        if ($telefono != "") {
            if (preg_match_all("/^[0-9]{10,30}$/", $telefono) == false) {
                $resultado = ['resultado' => 'Error', 'error' => 'Telefono Invalido'];
                return $resultado;
            }
        }
        if ($correo != "") {
            
            if (preg_match_all("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $correo) == false) {
                $resultado = ['resultado' => 'Error', 'error' => 'Correo invalida.'];
                return $resultado;
            }
        }

        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->id = $id;

        return $this->editarCliente();
    }

    private function editarCliente()
    {
        try {

            $this->key = parent::KEY();
            $this->iv = parent::IV();
            $this->cipher = parent::CIPHER();

            $this->cedula = openssl_encrypt($this->cedula, $this->cipher, $this->key, 0, $this->iv);
            $this->correo = openssl_encrypt($this->correo, $this->cipher, $this->key, 0, $this->iv);
            $this->direccion = openssl_encrypt($this->direccion, $this->cipher, $this->key, 0, $this->iv);
            $this->telefono = openssl_encrypt($this->telefono, $this->cipher, $this->key, 0, $this->iv);



            parent::conectarDB();
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
            $this->binnacle("Cliente", $_SESSION['cedula'], "Editó un cliente");
            $resultado = ['resultado' => 'Editado'];
            
            parent::desconectarDB();
            return $resultado;
        } catch (\PDOException $error) {
            return $error;
        }
    }

    public function getValidarC($cedula, $id)
    {
        $this->cedula = $cedula;
        $this->id = $id;

        return $this->validarC();
    }

    private function validarC()
    {
        try {
            $this->key = parent::KEY();
            $this->iv = parent::IV();
            $this->cipher = parent::CIPHER();
            if ($this->cedula == " ") {
                parent::conectarDB();
                $new = $this->con->prepare("SELECT `cedula` FROM `cliente` WHERE `cedula` = ?");
                $new->bindValue(1, $this->id);
                $new->execute();
                $data = $new->fetchAll();
                parent::desconectarDB();
                if (isset($data[0]['cedula'])) {
                    $resultado = ['resultado' => 'Correcto', 'msj' => 'La cédula está registrada.'];

                } else {
                    $resultado = ['resultado' => 'Error', 'msj' => 'Cedula no Registrada'];
                }
            } elseif ($this->id == " ") {
                $this->cedula = openssl_encrypt($this->cedula, $this->cipher, $this->key, 0, $this->iv);
                parent::conectarDB();
                $new = $this->con->prepare("SELECT `cedula` FROM `cliente` WHERE `status`= 1 and `cedula` = ?");
                $new->bindValue(1, $this->cedula);
                $new->execute();
                $data = $new->fetchAll();
                parent::desconectarDB();
                if (isset($data[0]['cedula'])) {
                    $resultado = ['resultado' => 'Error', 'msj' => 'La cédula ya está registrada.'];
                } else {
                    $resultado = ['resultado' => 'Correcto'];
                }
            } elseif ($this->id != " " && $this->cedula != " " && openssl_encrypt($this->cedula, $this->cipher, $this->key, 0, $this->iv) != $this->id) {
                $this->cedula = openssl_encrypt($this->cedula, $this->cipher, $this->key, 0, $this->iv);
                parent::conectarDB();
                $new = $this->con->prepare("SELECT `cedula`, `status` FROM cliente WHERE cedula = ?");
                $new->bindValue(1, $this->cedula);
                $new->execute();
                $data = $new->fetchAll();
                parent::desconectarDB();
                if (isset($data[0]['status']) && $data[0]['status'] == 0) {
                    $resultado = ['resultado' => 'Error', 'msj' => 'No Puede Ser Registrada'];
                } elseif (isset($data[0]['cedula']) && $data[0]['cedula'] == $this->cedula && $data[0]['status'] == 1) {
                    $resultado = ['resultado' => 'Error', 'msj' => 'La Cedula ya esta Registrada'];
                } else {
                    $resultado = ['resultado' => 'Correcto'];
                }
            } elseif (openssl_encrypt($this->cedula, $this->cipher, $this->key, 0, $this->iv) == $this->id) {
                $resultado = ['resultado' => 'Correcto'];
            }else{
                $resultado = ['resultado' => 'Ninguno'];
            }
            return $resultado;


        } catch (\PDOException $error) {
            return $error;
        }
    }

    public function getValidarE($correo, $id)
    {
        $this->correo = $correo;
        $this->id = $id;

        return $this->validarE();
    }

    private function validarE()
    {
        try {
            $this->key = parent::KEY();
            $this->iv = parent::IV();
            $this->cipher = parent::CIPHER();
            if ($this->correo == "") {
                $resultado = ['resultado' => 'Correcto'];
                return $resultado;
            }

            parent::conectarDB();
            $this->correo = openssl_encrypt($this->correo, $this->cipher, $this->key, 0, $this->iv);
            $new = $this->con->prepare("SELECT cc.correo, c.status FROM cliente c INNER JOIN contacto_cliente cc ON c.cedula = cc.cedula WHERE cc.cedula <> ? and cc.correo = ?");
            $new->bindValue(1, $this->id);
            $new->bindValue(2, $this->correo);
            $new->execute();
            $data = $new->fetchAll();
            parent::desconectarDB();
            if (isset($data[0]['correo']) && $data[0]['status'] === 1) {
                $resultado = ['resultado' => 'Error', 'msj' => 'El Correo ya esta Registrado'];
                return $resultado;
            }
            // elseif (isset($data[0]['correo']) && $data[0]['status'] === 0 ) {
            //     $resultado = ['resultado' => 'Error', 'msj' => 'El Correo no Puede Ser Registrado'];
            //     return $resultado;
            // } -------> Preguntar si dejo esta validacion <-------
            $resultado = ['resultado' => 'Correcto'];
            return $resultado;

        } catch (\PDOException $e) {
            return $e;
        }
    }

}

?>