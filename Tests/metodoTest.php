<?php

use PHPUnit\Framework\Testcase;
use modelo\metodo as metodo;

/*
*@group metodo
*@group configuracion
*/
class metodoTest extends Testcase{
    private $obj;

    public function setUp(): void {
        $this->obj = new metodo();
        $_SESSION['cedula'] = '123123123';
    }

    public function test_getAgregarMetodo(){
            $res = $this->obj->getAgregarMetodo('Shii');
        if (isset($res["error"])){
            $this->fail($res['error']);
        }else{
            $this->assertEquals('registrado correctamente',$res['resultado']);
        }
    
    }

    public function test_getMostrarMetodo(){
        $res = $this->obj->getMostrarMetodo(false);
        if(!isset($res[0])){
            $this->fail('No existe metodo de pago en la base de datos.');
        }else{
            $this->assertArrayHasKey('0',$res);
        }
    }
    public function test_editarOnline(){
        $res = $this->obj->editarOnline(0, 20);
            if(isset($res["error"])){
               $this-> fail($res['error']);
            }else{
          $this->assertEquals('check editado', $res['resultado']); 
        } 
    }

    public function test_getEditarMetodo(){
    $res = $this->obj->getEditarMetodo('adsas', '11');
    if(isset($res["error"])){
        $this-> fail($res ['error']);
        }else{
    $this->assertEquals('Editado', $res['resultado']); 
    } 

}
    public function test_getEliminarMetodo(){
        $res = $this->obj->getEliminarMetodo("asdasda");
        if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('error', $res['resultado']);
    }

 }
?>