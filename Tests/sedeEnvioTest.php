<?php  

use PHPUnit\Framework\TestCase;
use modelo\sedeEnvio;

/**
 * @group sedeEnvio
 * @group configuraciones
*/
class sedeEnvioTest extends TestCase{

    private $obj;
    public function setUp():void{
        $this->obj = new sedeEnvio();
        $_SESSION['cedula'] = 'testing';
    }   

	/** 
     * @test 
     * @group consultar
     * @group crud
    */
    public function mostrarSedes(): void{
        $res = $this->obj->mostrarSedes(false);
        if(!isset($res[0]))
            $this->fail('No existen sedes de envío en la base de datos.');
        else
            $this->assertArrayHasKey('0', $res);
    }

    /** 
     * @test
     * @dataProvider datosValidacionSedeEnvio
     * @group validaciones
    */
    public function validacionesRegistrarSede($empresa, $estado, $nombre, $ubicacion): void{
        $res = $this->obj->getRegistrarSede($empresa, $estado, $nombre, $ubicacion);
        if(!isset($res['resultado']))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('error', $res['resultado']);
    }

    public function datosValidacionSedeEnvio(): array {
        /* Descripción de los datos del dataset:
            1: id_empresa, 2: id_estado, 3: nombre, 4: ubicación, 5: id_sede(para test de editar)
        */
        return  [
            'Id empresa inválido' => [
                'saf', '2', 'Sede envío TEST', 'Av.Test con Calle Test'
            ],
            'Id estado inválido' => [
                '1', '$("!$', 'Sede envío TEST', 'Av.Test con Calle Test'
            ],
            'Nombre inválido' => [
                '1', '2', 'a', 'Av.Test con Calle Test'
            ],
            'Ubicación inválida' => [
                '1', '2', 'a', '!")$(!")$(!"#'
            ],
            'Intento inyección SQL' => [
                '1', '2', 'Sede envío TEST', "' UNION SELECT @@version --"
            ],
            'Id inválida' => [
                '1', '2', 'Sede envío TEST', 'Av.Test con Calle Test', 'xxxxxxxxxx'
            ],
        ];
    }

    /**
     * @test
     * @group registro
     * @group crud
    */
    public function registrarSede(){
        $res = $this->obj->getRegistrarSede('1', '2', 'Sede envío TEST', 'Av.Test con Calle Test');
        if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);
        
        if($res['resultado'] != "ok")
            $this->fail($res['msg']);
        else
            $this->assertEquals('ok', $res['resultado']);
    }

    /** 
     * @test 
     * @dataProvider datosValidacionSedeEnvio
     * @group validaciones
    */
    public function validacionesEditarSedeEnvio($empresa, $estado, $nombre, $ubicacion, $id = ""){
        $res = $this->obj->getEditarSede($empresa, $estado, $nombre, $ubicacion, $id);
         if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('error', $res['resultado']);
    }


    /**
     * @test
     * @group editar
     * @group crud
    */
    public function editarSedeEnvio(){
        $res = $this->obj->getEditarSede('1', '15', 'Juan Griego', 'CALLE GUEVARA, NRO 12 B, ENTRE CALLES LA MARINA Y MARCANO, DIAGONAL A COMERCIAL JUAN GRIEGO.','01a1d01d26');
        if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('error', $res['resultado']);
    }

    /**
     * @test
     * @group validaciones 
    */
    public function validacionesEliminarSedeEnvio(){
        $res = $this->obj->getEliminarSede("xxxxxxxxx");
        if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('error', $res['resultado']);
    }

    
}

?>
