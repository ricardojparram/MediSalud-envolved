<?php 

  namespace component;

  class menuLateral{

    private $permisos;

    public function __construct($permisos){
      $this->permisos = $permisos;
    }

    public function Menu(){

    $home = ($_GET['url'] == 'home')? "": "collapsed";
    $clientes = ($_GET['url'] == 'clientes')? "": "collapsed";
    $ventas = ($_GET['url'] == 'ventas')? "" : "collapsed";
    $compras = ($_GET['url'] == 'compras')? ""  : "collapsed" ;
    $configuracionesA = ($_GET['url'] == 'metodo' || $_GET['url'] == 'moneda' || $_GET['url'] == 'banco' || $_GET['url'] == 'empresaEnvio')? "" : "collapsed";
    $configuracionesB = ($_GET['url'] == 'metodo' || $_GET['url'] == 'moneda' || $_GET['url'] == 'banco' || $_GET['url'] == 'empresaEnvio')? "show" : "collapse" ;
    $moneda = ($_GET['url'] == 'moneda')? "active"  : "" ;
    $banco = ($_GET['url'] == 'banco')? "active" : "" ;
    $empresaEnvio = ($_GET['url'] == 'empresaEnvio')? "active"  : "" ;
    $metodo = ($_GET['url'] == 'metodo')? "active"  : "" ;
    $productosA = ($_GET['url'] == 'producto' || $_GET['url'] == 'laboratorio' || $_GET['url'] == 'proveedor' || $_GET['url'] == 'presentacion' || $_GET['url'] == 'clase' || $_GET['url'] == 'tipo')?  ""  : "collapsed" ;
    $productosB = ($_GET['url'] == 'producto' || $_GET['url'] == 'laboratorio' || $_GET['url'] == 'proveedor' || $_GET['url'] == 'presentacion' || $_GET['url'] == 'clase' || $_GET['url'] == 'tipo')? "show" : "collapse" ;
    $categoria = ($_GET['url'] == 'clase' || $_GET['url'] == 'url')? "active" : "" ;
    $producto = ($_GET['url'] == 'producto')? "active" : "" ;
    $laboratorio = ($_GET['url'] == 'laboratorio')? "active" :"" ;
    $proveedor = ($_GET['url'] == 'proveedor')? "active" : "" ;
    $presentacion = ($_GET['url'] == 'presentacion')? "active" : "" ;
    $clase = ($_GET['url'] == 'clase')? "active" : "" ;
    $tipo = ($_GET['url'] == 'tipo')? "active" : "" ;
    $reportes = ($_GET['url'] == 'reportes')? "": "collapsed";
    $usuario = ($_GET['url'] == 'usuario')? "": "collapsed";
    $bitacora = ($_GET['url'] == 'bitacora')? "": "collapsed";
    $roles = ($_GET['url'] == 'roles')? "": "collapsed";

    if(!isset($_SESSION['nivel'])){
      die('<script> window.location = "?url=login" </script>');
    }

    $clientesLi = ($this->permisos['Clientes']["Consultar"]) ? 
    '<li class="nav-item">
        <a class="nav-link '.$clientes.'" href="?url=clientes">
            <i class="bi bi-people"></i>
            <span>Clientes</span>
        </a>
      </li>' : '';
    $ventasLi = ($this->permisos['Ventas']["Consultar"] ) ?
                '<li class="nav-item">
                    <a class="nav-link '.$ventas.'" href="?url=ventas">
                        <i class="bi bi-currency-dollar"></i>
                        <span>Ventas</span>
                    </a>
                </li>' : '';
    $comprasLi = ($this->permisos['Compras']["Consultar"]) ?
    '<li class="nav-item">
        <a class="nav-link '.$compras.'" href="?url=compras">
            <i class="bi bi-cart-check"></i>
            <span>Compras</span>
        </a>
    </li>' : '';

    $metodoLi = ($this->permisos['Metodo pago']["Consultar"]) ?
    '<li>
        <a href="?url=metodo" class="'.$metodo.'" >
          <i class="bi bi-circle "></i><span>Metodo de pago</span>
        </a>
    </li>' : '';
    $monedaLi = ($this->permisos['Moneda']["Consultar"]) ?
    '<li>
        <a href="?url=moneda" class="'.$moneda.'">
          <i class="bi bi-circle "></i><span>Moneda</span>
        </a>
    </li> ' : '';

    $bancoLi = ($this->permisos['Bancos']["Consultar"]) ?
    '<li>
        <a href="?url=banco" class="'.$banco.'">
          <i class="bi bi-circle "></i><span>Bancos</span>
        </a>
    </li>' : '';

    $empresaEnvioLi = ($this->permisos['Empresa de Envio']["Consultar"]) ?
    '<li>
        <a href="?url=empresaEnvio" class="'.$empresaEnvio.'">
          <i class="bi bi-circle "></i><span>Empresa envio</span>
        </a>
    </li>' : '';

    $configuracionesLi = ($this->permisos['Metodo pago']["Consultar"] || $this->permisos['Moneda']["Consultar"] || $this->permisos['Bancos']["Consultar"] || $this->permisos['Empresa de Envio']) ?
    '<li class="nav-item">
        <a class="nav-link '.$configuracionesA.'" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class="bi bi-gear"></i><span>Configuraciones</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content '.$configuracionesB.'" data-bs-parent="#sidebar-nav" style="">

            '.$metodoLi.'

            '.$monedaLi.'

            '.$bancoLi.'

            '.$empresaEnvioLi.'

        </ul>
    </li>' : '';
    $productosLi = ($this->permisos['Producto']["Consultar"]) ?
    '<li>
        <a href="?url=producto" class="'.$producto.'">
          <i class="bi bi-circle"></i><span>Producto</span>
        </a>
    </li>' : '';
    $laboratorioLi = ($this->permisos['Laboratorio']["Consultar"]) ?
    '<li>
        <a href="?url=laboratorio" class="'.$laboratorio.'">
          <i class="bi bi-circle"></i><span>Laboratorio</span>
        </a>
    </li>' : '';
    $proveedorLi = ($this->permisos['Proveedor']["Consultar"]) ?
    '<li>
        <a href="?url=proveedor" class="'.$proveedor.'">
          <i class="bi bi-circle"></i><span>Proveedor</span>
        </a>
    </li>' : '';

    $claseLi = ($this->permisos['Clase']["Consultar"]) ?
    '<li>
      <a href="?url=clase" class="'.$clase.'">
        <i class="bi bi-circle"></i><span>Clase</span>
      </a>
    </li>' : '';
    $tipoLi = ($this->permisos['Tipo']["Consultar"]) ?
    '<li>
      <a href="?url=tipo" class="'.$tipo.'">
        <i class="bi bi-circle"></i><span>Tipo</span>
      </a>
    </li>' : '';
    $categoriaLi = ($this->permisos['Clase']["Consultar"] || $this->permisos['Tipo']) ?
    '<li>
        <a href="#" class="'.$categoria.'">
          <i class="bi bi-circle"></i><span>Categoría</span>
        </a>
        <ul>
          '.$claseLi.'

          '.$tipoLi.'
        </ul>
    </li>' : '';

    $presentacionLi = ($this->permisos['Presentacion']["Consultar"]) ?
    '<li>
        <a href="?url=presentacion" class="'.$presentacion.'">
          <i class="bi bi-circle"></i><span>Presentación</span>
        </a>
    </li>' : '';

    $productosNavLi = ($this->permisos['Producto']["Consultar"] || $this->permisos['Laboratorio']["Consultar"] || $this->permisos['Proveedor']["Consultar"] || $this->permisos['Clase']["Consultar"] || $this->permisos['Tipo']["Consultar"] || $this->permisos['Presentacion']["Consultar"]) ?
    '<li class="nav-item">
          <a class="nav-link '.$productosA.'" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
              <i class="bi bi-grid"></i><span>Productos</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav" class="nav-content '.$productosB.'" data-bs-parent="#sidebar-nav">
              
              '.$productosLi.'

              '.$laboratorioLi.'
              
              '.$proveedorLi.'

              '.$categoriaLi.'

              '.$presentacionLi.'

          </ul>
    </li>' : '';

    $reportesLi = ($this->permisos['Reportes']["Consultar"]) ?
    '<li class="nav-item ">
        <a class="nav-link '.$reportes.'" href="?url=reportes">
          <i class="bi bi-card-checklist"></i><span>Reportes</span>
        </a>
    </li>' : '';

    $usuarioLi = ($this->permisos['Usuarios']["Consultar"]) ?
    '<li class="nav-item">
        <a class="nav-link '.$usuario.'" href="?url=usuario">
          <i class="bi bi-person"></i><span>Usuarios</span>
        </a>
    </li>' : '';

    $bitacoraLi = ($this->permisos['Bitacora']["Consultar"]) ?
    '<li class="nav-item ">
        <a class="nav-link '.$bitacora.'" href="?url=bitacora">
          <i class="bi bi-journal-text"></i><span>Bitacora</span>
        </a>
    </li>' : '';

    $rolesLi = ($this->permisos['Roles']["Consultar"]) ?
    '<li class="nav-item ">
        <a class="nav-link '.$roles.'" href="?url=roles">
          <i class="bi bi-person-lock"></i><span>Roles</span>
        </a>
    </li>' : '';

    $menu = '
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link '.$home.'" href="?url=home">
                <i class="bi bi-house-door"></i>
                <span>Inicio</span>
              </a>
          </li>
              
          '.$clientesLi.'

          '.$ventasLi.'
          
          '.$comprasLi.'

          <!-- Configuraciones desplegable -->

          '.$configuracionesLi.'

          <!-- Final de Configuraciones desplegable -->

          <!-- Productos desplegable -->

          '.$productosNavLi.'

          <!-- Final de Productos desplegable -->

          '.$reportesLi.'

          '.$usuarioLi.'

          '.$bitacoraLi.'

          '.$rolesLi.'

        </ul>
    </aside>

    ';

    echo $menu;


    }

  }

  
?>
