<?php  

use PHPUnit\Framework\TestCase;
use modelo\reportes;

/**
 * @group reportes
*/
class reportesTest extends TestCase{

    private $obj;
    public function setUp():void{
        $this->obj = new reportes();
        $_SESSION['cedula'] = 'testing';
    }   

	/** 
     * @test 
     * @dataProvider datosCorrectosParaReporte
     * @group consultar
     * @group crud
    */
    public function mostrarReporte($tipo, $fechaInicio, $fechaFinal): void{
        $res = $this->obj->getMostrarReporte($tipo, $fechaInicio, $fechaFinal);
        if(!isset($res[0]))
            $this->fail("No existen datos para generar reporte de {$tipo} en la base de datos.");
        else
            $this->assertArrayHasKey('0', $res);
    }

    public function datosCorrectosParaReporte(): array{
        $fechaActual = new DateTimeImmutable('now');
        $fechaMenos30Dias = $fechaActual->sub(new DateInterval('P30D'));
        /* Descripcion de datasets: 
            1: tipo reporte, 2: fecha inicio, 3: fecha final
        */
        return [
            'Reporte de ventas' => [
                'venta', $fechaMenos30Dias->format('Y-m-d'), $fechaActual->format('Y-m-d')
            ],
            'Reporte de compras' => [
                'compra', $fechaMenos30Dias->format('Y-m-d'), $fechaActual->format('Y-m-d')
            ],
        ];
    }

    /** 
     * @test
     * @dataProvider datosValidacionReportes
     * @group validaciones
    */
    public function validacionesMostrarReporte($tipo, $inicio, $final): void{
        $res = $this->obj->getMostrarReporte($tipo, $inicio, $final);
        if(!isset($res['resultado']))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('error', $res['resultado']);
    }


    /** 
     * @test
     * @dataProvider datosValidacionReportes
     * @group validaciones
    */
    public function validacionesExportarReporte($tipo, $inicio, $final): void{
        $res = $this->obj->getExportar($tipo, $inicio, $final);
        if(!isset($res['resultado']))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('error', $res['resultado']);
    }

    /** 
     * @test
     * @dataProvider datosValidacionReportes
     * @group validaciones
    */
    public function validacionesExportarReporteEstadistico($tipo, $inicio, $final): void{
        $res = $this->obj->getReporteEstadistico($tipo, $inicio, $final);
        if(!isset($res['resultado']))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('error', $res['resultado']);
    }

    public function datosValidacionReportes(): array {
        /* Descripción de los datos del dataset:
            1: tipo de reporte, 2: fecha de incio, 3: fecha final
        */
        return  [
            'Tipo de reporte inválido (tipo de reporte no existe)' => [
                'tiporeporte', '2024-01-01', '2024-01-31'
            ],
            'Fecha inicio inválida' => [
                'venta', '01-01-2024', '2024-01-31'
            ],
            'Fecha final inválida' => [
                'venta', '2024-01-01', '1231231233'
            ],
        ];
    }

    /** 
     * @test
     * @dataProvider datosCorrectosParaReporte
     * @group reportes
    */
    public function exportarReporte($tipo, $inicio, $final): void{
        $res = $this->obj->getExportar($tipo, $inicio, $final);
        if(!isset($res['respuesta']))
            $this->assertArrayHasKey('respuesta',  $res);
        
        $this->assertEquals('Archivo guardado', $res['respuesta']);
    }

    public function exportarReporteEstadistico($tipo, $inicio, $final): void{
        $res = $this->obj->getReporteEstadistico($tipo, $inicio, $final);
        if(!isset($res['respuesta']))
            $this->assertArrayHasKey('respuesta',  $res);
        
        $this->assertEquals('Archivo guardado', $res['respuesta']);
    }

    // /**
    //  * @test
    //  * @group registro
    //  * @group crud
    // */
    // public function registrarSede(){
    //     $res = $this->obj->getRegistrarSede('1', '2', 'Sede envío TEST', 'Av.Test con Calle Test');
    //     if(!isset($res["resultado"]))
    //         $this->assertArrayHasKey('resultado',  $res);
        
    //     if($res['resultado'] != "ok")
    //         $this->fail($res['msg']);
    //     else
    //         $this->assertEquals('ok', $res['resultado']);
    // }

    // /** 
    //  * @test 
    //  * @dataProvider datosValidacionSedeEnvio
    //  * @group validaciones
    // */
    // public function validacionesEditarSedeEnvio($empresa, $estado, $nombre, $ubicacion, $id = ""){
    //     $res = $this->obj->getEditarSede($empresa, $estado, $nombre, $ubicacion, $id);
    //      if(!isset($res["resultado"]))
    //         $this->assertArrayHasKey('resultado',  $res);
        
    //     $this->assertEquals('error', $res['resultado']);
    // }


    // /**
    //  * @test
    //  * @group editar
    //  * @group crud
    // */
    // public function editarSedeEnvio(){
    //     $res = $this->obj->getEditarSede('1', '15', 'Juan Griego', 'CALLE GUEVARA, NRO 12 B, ENTRE CALLES LA MARINA Y MARCANO, DIAGONAL A COMERCIAL JUAN GRIEGO.','01a1d01d26');
    //     if(!isset($res["resultado"]))
    //         $this->assertArrayHasKey('resultado',  $res);
        
    //     $this->assertEquals('error', $res['resultado']);
    // }

    // /**
    //  * @test
    //  * @group validaciones 
    // */
    // public function validacionesEliminarSedeEnvio(){
    //     $res = $this->obj->getEliminarSede("xxxxxxxxx");
    //     if(!isset($res["resultado"]))
    //         $this->assertArrayHasKey('resultado',  $res);
        
    //     $this->assertEquals('error', $res['resultado']);
    // }

    
}

?>
