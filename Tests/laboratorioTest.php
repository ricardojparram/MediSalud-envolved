<?php  

use PHPUnit\Framework\TestCase;
use modelo\laboratorio;

/**
 * @group laboratorio
 * @group relacionadosProductos 
*/
class laboratorioTest extends TestCase{

    private $obj;
    public function setUp():void{
        $this->obj = new laboratorio();
        $_SESSION['cedula'] = '123123123';
    }   

	/** 
     * @test 
     * @group consultar
     * @group crud
    */
    public function mostrarLaboratorio(): void{
        $res = $this->obj->mostrarLaboratoriosAjax(false);
        if(!isset($res[0]))
            $this->fail('No existen laboratorios en la base de datos.');
        else
            $this->assertArrayHasKey('0', $res);
    }

    /** 
     * @test
     * @dataProvider datosValidacionLaboratorio
     * @group validaciones
    */
    public function validacionesRegistrarLaboratorio($rif, $direccion, $razon, $telefono, $contacto): void{
        $res = $this->obj->getDatosLab($rif, $direccion, $razon, $telefono, $contacto);        
        if(!isset($res['resultado']))
            $this->assertArrayHasKey('resultado',  $res);

        $this->assertEquals('error', $res['resultado']);
    }

    public function datosValidacionLaboratorio(): array {
        /* Descripcion  de los datasets:
            1: rif, 2: direccion, 3: razon_social(nombre), 4: telefono, 5: contacto, 6: cod_lab(para test de edit)
        */
        return  [
            'Rif inválido' => [
                'holamundo', 'Av.Test calle Test', 'Laboratorio Test', '04128883333', ''
            ],
            'Dirección inválida' => [
                '123123123', '1111111111111','Laboratorio Test', '04128883333', '1231233333'
            ],
            'Razón social inválida' => [
                '123123123', 'Av.Test calle Test','a', '04128883333', ''
            ],
            'Teléfono inválido' => [
                '123123123', 'Av.Test calle Test','Laboratorio Test', 'asfasfsafsafsa', ''
            ],
            'Rif ya registrado' => [
                '1234567', 'Av.Test calle Test','Laboratorio Test', '04128883333', ""
            ],
            'Intento inyección SQL' => [
                '111111111', 'Av.Test calle Test','Laboratorio Test', '04128883333', 
                "' UNION SELECT @@version --"
            ],
            'Id inválida' => [
               '123123123', 'Av.Test calle Test','Laboratorio Test', '04128883333', '', '12312312312'
            ],
        ];
    }

    /**
     * @test
     * @group registro
     * @group crud
    */
    public function registrarLaboratorio(){
        $res = $this->obj->getDatosLab('123123123', 'Av.Test Calle Test', 'LaboratorioTest', '04128883333', '');
        if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);
        
        if($res['resultado'] === "error")
            if($res['msg'] === "Rif ya registrado")
                $this->fail("Datos del LaboratorioTest ya registrados");
            else
                $this->fail($res['msg']);
        else
            $this->assertEquals('ok', $res['resultado']);
    }

    /** 
     * @test 
     * @dataProvider datosValidacionLaboratorio
     * @group validaciones
    */
    public function validacionesEditarLaboratorio($rif, $direccion, $razon, $telefono, $contacto, $id = ""){
        $res = $this->obj->getEditar($rif, $direccion, $razon, $telefono, $contacto, $id);
        if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);

        $this->assertEquals('error', $res['resultado']);
    }


    /**
     * @test
     * @group editar
     * @group crud
    */
    public function editarLaboratorio(){
        $res = $this->obj->getEditar('1234567', 'Av. Venezuela', 'MedicalCare', '0251939333', '', "8fcfd29ec4");
         if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('ok', $res['resultado']);
    }

    /**
     * @test
     * @group validaciones 
    */
    public function validacionesEliminarLaboratorio(){
        $res = $this->obj->getEliminar("xxxxxxxxx");
         if(!isset($res["resultado"]))
            $this->assertArrayHasKey('resultado',  $res);
        
        $this->assertEquals('error', $res['resultado']);
    }

    
}

?>
