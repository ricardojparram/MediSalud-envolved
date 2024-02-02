<?php

use PHPUnit\Framework\TestCase;
use modelo\clase as clase;

class claseTest extends TestCase{
    private $obj;

    public function setUp(): void {
        $this->obj = new clase();
        $_SESSION['cedula'] = '123123123';
    }

    public function test_mostrarClase(){
        $res = $this->obj->mostrarClase(false);
        if(!isset($res[0])){
            $this->fail('No existe tipo de producto en la base de datos.');
        }else{
            $this->assertArrayHasKey('0',$res);
        }

    }

    public function test_getAgregarClase(){
        $res = $this->obj->getAgregarClase('OKis');
        if (isset($res["error"])){
            $this->fail($res['error']);
        }else{
            $this->assertEquals('Registrado correctamente.',$res['resultado']);
        }
    }

    public function test_editarClase(){
        $res = $this->obj->getEditarClase('Pañales', 35);
		if (isset($res["error"])) {
			$this->fail($res['error']);
		}else{
			$this->assertEquals('Editado correctamente.', $res['resultado']);
		}
    }

    public function test_getEliminarClase(){
        $res = $this->obj->getEliminar("1");
            if(!isset($res["resultado"]))
                $this->fail('Error al eliminar clase');

            $this->assertEquals('Eliminado', $res['resultado']);
    }
}


?>