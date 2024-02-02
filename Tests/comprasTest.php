<?php

use PHPUnit\Framework\TestCase;
use modelo\compras as compras;

/*
*@group compras
*/
class comprasTest extends TestCase{
    private $obj;

    public function setUp(): void {
        $this->obj = new compras();
        $_SESSION['cedula'] = '123123123';
    }

    public function test_mostrarCompras(){
        $res = $this->obj->mostrarCompras(false);
        if(!isset($res[0]))
            $this->fail('No existen compras en la base de datos.');
        else
            $this->assertArrayHasKey('0', $res);
    }

    public function test_getOrden(){
		$res = $this->obj->getOrden('20');
		if(isset($res["error"])){
			$this->fail($res['error']);
		}elseif($res['resultado'] == 'Error de orden'){
			$this->fail($res['resultado']);
		}else{
			$this->assertEquals('Orden válida', $res['resultado']);
		}
	}


    public function test_getCompras(){
        $res = $this->obj->getCompras(2,5,'2024-02-01',2,10);
 
          if (isset($res["error"])) {
              $this->fail($res['error']);
          }else{
             $this->assertEquals('Orden registrada.', $res['resultado']);
         }
 
         $res2 = $this->obj->getProducto(8,10.00,10, $res['id']);
         if (isset($res2["error"])) {
             $this->fail($res2['error']);
         }else{
            $this->assertEquals('Stock actualizado', $res2['resultado']);
        }
 

      }

      public function test_getDetalleCompra(){
		$res = $this->obj->getDetalleCompra('20');
		if(isset($res["error"])){
			$this->fail($res['error']);
		}else{
			$this->assertArrayHasKey('0', $res);
		}
	}

    public function test_getEliminarCompra(){
        $res = $this->obj->getEliminarCompra("asdasda");
        if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('Id inválida.', $res['resultado']);
    }



}

?>