<?php

use PHPUnit\Framework\Testcase;
use modelo\tipo as tipo;


class tipoTest extends Testcase{
    private $obj;

    public function setUp(): void {
        $this->obj = new tipo();
        $_SESSION['cedula'] = '123123123';
    }

public function test_getAgregarTipo (){
    $res = $this->obj->getAgregarTipo('OKis');
    if (isset($res["error"])){
        $this->fail($res['error']);
    }else{
        $this->assertEquals('Registrado con exito',$res['resultado']);
    }
}

    public function test_getMostrarTipo(){
        $res = $this->obj->getMostrarTipo(false);
        if(!isset($res[0])){
            $this->fail('No existe tipo de producto en la base de datos.');
        }else{
            $this->assertArrayHasKey('0',$res);
        }

    }

    public function test_getEditarTipo(){
        $res = $this->obj->getEditarTipo('Patria','10');
            if(!isset($res["resultado"]))
                $this->assertArrayHasKey('resultado',  $res);
    
            $this->assertEquals('Editado', $res['resultado']);

    }

    public function test_getEliminartipo(){
        $res = $this->obj->getEliminartipo("sfdsdff");
            if(isset($res["resultado"]))
                $this->assertArrayHasKey('resultado',  $res);

            $this->assertEquals('Eliminado', $res['resultado']);
    }
}

?>
