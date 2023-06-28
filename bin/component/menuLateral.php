<?php 

  namespace component;

  class menuLateral{

    public function Menu(){

    $home = ($_GET['url'] == 'home')? "": "collapsed";
    $clientes = ($_GET['url'] == 'clientes')? "": "collapsed";
    $ventas = ($_GET['url'] == 'ventas')? "" : "collapsed";
    $compras = ($_GET['url'] == 'compras')? ""  : "collapsed" ;
    $configuracionesA = ($_GET['url'] == 'metodo' || $_GET['url'] == 'moneda')? "" : "collapsed";
    $configuracionesB = ($_GET['url'] == 'metodo' || $_GET['url'] == 'moneda')? "show" : "collapse" ;
    $moneda = ($_GET['url'] == 'moneda')? "active"  : "" ;
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

    $menu = '';
    if(!isset($_SESSION['nivel'])){
      die('<script> window.location = "?url=login" </script>');
    }

    if($_SESSION['nivel'] == 1){
        $menu = '
        <aside id="sidebar" class="sidebar">
          <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
                <a class="nav-link '.$home.'" href="?url=home">
                  <i class="bi bi-house-door"></i>
                  <span>Inicio</span>
                </a>
          </li>
              
          <!-- End Dashboard Nav -->

          <li class="nav-item">
            <a class="nav-link '.$clientes.'" href="?url=clientes">
                <i class="bi bi-people"></i>
                <span>Clientes</span>
            </a>
          </li>

          <li class="nav-item">
              <a class="nav-link '.$ventas.'" href="?url=ventas">
                <i class="bi bi-currency-dollar"></i>
                <span>Ventas</span>
              </a>
          </li>
          
          <li class="nav-item">
          <a class="nav-link '.$compras.'" href="?url=compras">
              <i class="bi bi-cart-check"></i>
              <span>Compras</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link '.$configuracionesA.'" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
              <i class="bi bi-gear"></i><span>Configuraciones</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content '.$configuracionesB.'" data-bs-parent="#sidebar-nav" style="">
            
              <li>
                <a href="?url=metodo" class="'.$metodo.'" >
                  <i class="bi bi-circle "></i><span>Metodo de pago</span>
                </a>
              </li>
              <li>
                <a href="?url=moneda" class="'.$moneda.'">
                  <i class="bi bi-circle "></i><span>Moneda</span>
                </a>
              </li>  
            </ul>
          </li>

            <!-- End Components Nav -->

          <li class="nav-item">
            <a class="nav-link '.$productosA.'" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-grid"></i><span>Productos</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content '.$productosB.'" data-bs-parent="#sidebar-nav">
              <li>
                <a href="?url=producto" class="'.$producto.'">
                  <i class="bi bi-circle"></i><span>Producto</span>
                </a>
              </li>
              <li>
                <a href="?url=laboratorio" class="'.$laboratorio.'">
                  <i class="bi bi-circle"></i><span>Laboratorio</span>
                </a>
              </li>
              <li>
                <a href="?url=proveedor" class="'.$proveedor.'">
                  <i class="bi bi-circle"></i><span>Proveedor</span>
                </a>
              </li>
              <li>
                <a href="#" class="'.$categoria.'">
                  <i class="bi bi-circle"></i><span>Categoría</span>
                </a>
                <ul>
                  <li>
                     <a href="?url=clase" class="'.$clase.'">
                    <i class="bi bi-circle"></i><span>Clase</span>
                    </a>
                  </li>
                  <li>
                     <a href="?url=tipo" class="'.$tipo.'">
                    <i class="bi bi-circle"></i><span>Tipo</span>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li>
                <a href="?url=presentacion" class="'.$presentacion.'">
                  <i class="bi bi-circle"></i><span>Presentación</span>
                </a>
              </li>
            </ul>
          </li><!-- End Forms Nav -->
          <li class="nav-item ">
            <a class="nav-link '.$reportes.'" href="?url=reportes">
              <i class="bi bi-card-checklist"></i><span>Reportes</span>
            </a>
          </li>

          <!-- End Tables Nav -->
          

          <li class="nav-item">
            <a class="nav-link '.$usuario.'" href="?url=usuario">
              <i class="bi bi-person"></i>
              <span>Usuarios</span>
            </a>
          </li>
          <!-- End Profile Page Nav -->

        </ul>
        </aside>

      ';
    }else if($_SESSION['nivel'] == 2){
          $menu = '
      
        <aside id="sidebar" class="sidebar">
          <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
                <a class="nav-link '.$home.'" href="?url=home">
                  <i class="bi bi-house-door"></i>
                  <span>Inicio</span>
                </a>
          </li>
              
          <!-- End Dashboard Nav -->

          <li class="nav-item">
            <a class="nav-link '.$clientes.'" href="?url=clientes">
                <i class="bi bi-people"></i>
                <span>Clientes</span>
            </a>
          </li>

          <li class="nav-item">
              <a class="nav-link '.$ventas.'" href="?url=ventas">
                <i class="bi bi-currency-dollar"></i>
                <span>Ventas</span>
              </a>
          </li>
          
          <li class="nav-item">
          <a class="nav-link '.$compras.'" href="?url=compras">
              <i class="bi bi-cart-check"></i>
              <span>Compras</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link '.$configuracionesA.'" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
              <i class="bi bi-gear"></i><span>Configuraciones</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content '.$configuracionesB.'" data-bs-parent="#sidebar-nav" style="">
            
              <li>
                <a href="?url=metodo" class="'.$metodo.'" >
                  <i class="bi bi-circle "></i><span>Metodo de pago</span>
                </a>
              </li>
              <li>
                <a href="?url=moneda" class="'.$moneda.'">
                  <i class="bi bi-circle "></i><span>Moneda</span>
                </a>
              </li>  
            </ul>
          </li>

            <!-- End Components Nav -->

          <li class="nav-item">
            <a class="nav-link '.$productosA.'" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-grid"></i><span>Productos</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content '.$productosB.'" data-bs-parent="#sidebar-nav">
              <li>
                <a href="?url=producto" class="'.$producto.'">
                  <i class="bi bi-circle"></i><span>Producto</span>
                </a>
              </li>
              <li>
                <a href="?url=laboratorio" class="'.$laboratorio.'">
                  <i class="bi bi-circle"></i><span>Laboratorio</span>
                </a>
              </li>
              <li>
                <a href="?url=proveedor" class="'.$proveedor.'">
                  <i class="bi bi-circle"></i><span>Proveedor</span>
                </a>
              </li>
              <li>
                <a href="#" class="'.$categoria.'">
                  <i class="bi bi-circle"></i><span>Categoría</span>
                </a>
                <ul>
                  <li>
                     <a href="?url=clase" class="'.$clase.'">
                    <i class="bi bi-circle"></i><span>Clase</span>
                    </a>
                  </li>
                  <li>
                     <a href="?url=tipo" class="'.$tipo.'">
                    <i class="bi bi-circle"></i><span>Tipo</span>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li>
                <a href="?url=presentacion" class="'.$presentacion.'">
                  <i class="bi bi-circle"></i><span>Presentación</span>
                </a>
              </li>
            </ul>
          </li><!-- End Forms Nav -->
          <li class="nav-item ">
            <a class="nav-link '.$reportes.'" href="?url=reportes">
              <i class="bi bi-card-checklist"></i><span>Reportes</span>
            </a>
          </li>

          <!-- End Tables Nav -->
          

        </ul>
        </aside>

    ';
    }else if($_SESSION['nivel'] == 3){
        $menu = '
  
        <aside id="sidebar" class="sidebar">
          <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
                <a class="nav-link '.$home.'" href="?url=home">
                  <i class="bi bi-house-door"></i>
                  <span>Inicio</span>
                </a>
          </li>
              
          <!-- End Dashboard Nav -->

          <li class="nav-item">
            <a class="nav-link '.$clientes.'" href="?url=clientes">
                <i class="bi bi-people"></i>
                <span>Clientes</span>
            </a>
          </li>

          <li class="nav-item">
              <a class="nav-link '.$ventas.'" href="?url=ventas">
                <i class="bi bi-currency-dollar"></i>
                <span>Ventas</span>
              </a>
          </li>
          
          <li class="nav-item">
          <a class="nav-link '.$compras.'" href="?url=compras">
              <i class="bi bi-cart-check"></i>
              <span>Compras</span>
            </a>
          </li>


          <!-- End Tables Nav -->

        </ul>
        </aside>

    ';
    }

    echo $menu;


    }
  }

  
?>
