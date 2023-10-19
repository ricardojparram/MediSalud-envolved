<?php

    namespace component;

    class tienda{

      public function Nav(){

        $adminDashboard = "";
        if(isset($_SESSION['nivel'])){
          $adminDashboard = ($_SESSION['nivel'] != "4") 
            ? '<li class="nav-item px-2"><a class="nav-link fw-medium" href="?url=home">Admin</a></li>' : '';
        }
        $loginIcons = (!isset($_SESSION['cedula']))
          ? '<div class="m-0">
                <a class="text-success me-2" href="?url=login">
                  <em class="ocultarlg">Iniciar sesión</em><i class="bi bi-person-fill fs-4"></i>
                </a>
            </div>
            <div class="m-0">
              <a class="text-success me-2" href="?url=registro">
                <em class="ocultarlg">Registrarse </em><i class="bi bi-person-lines-fill fs-4"></i>
              </a>
            </div>'
          : '<div class="m-0">
                <a class="text-success me-2" href="?url=cerrar"><i class="bi bi-box-arrow-right fs-4"></i></a>
            </div>';

        $nav = '
        <nav class="navbar navbar-expand-lg navbar-light fixed-top d-block" id="navbar">
          <div class="container">
            <a class="navbar-brand d-inline-flex" id="tituloNav" href="?url=inicio">
              <img class="d-inline-block" src="assets/img/Logo_Medi.png" alt="logo" width="50px" height="50px" />
              <span class="text-1000 fs-2 fw-bold mx-2 m-auto">Medisalud</span>
            </a>

            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mt-4 mt-lg-0" id="navbarSupportedContent">

              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page" href="?url=inicio">Inicio</a></li>
                <li class="nav-item px-2"><a class="nav-link fw-medium" href="#">Nosotros</a></li>
                <li class="nav-item px-2"><a class="nav-link fw-medium" href="#">Catálogo</a></li>
                <li class="nav-item px-2"><a class="nav-link fw-medium" href="#">Contactos</a></li>
                <li class="nav-item px-2"><a class="nav-link fw-medium" href="?url=miscompras">Mis compras</a></li>
                '.$adminDashboard.'
              </ul>

              <div class="mx-2 mx-lg-0 sec">
                <div class="m-0 ">
                  <a class="text-success icon-car me-4" href="#">
                    <em class="ocultarlg">Carrito </em>
                    <span class="bi bi-cart4 fs-4"></span>
                    <span id="carrito_badge" class="badge badge-light icon-badge">0</span>
                  </a>
                </div>
                '.$loginIcons.'
              </div>

            </div>
          </div>
        </nav>';
        echo $nav;
      }

      public function Car(){
        $car = '
            <!-- Boton para Carrito Desplegable -->
            <button id="carRight" class="btn fs-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
              <i class="bi bi-cart4"></i>
            </button>
          
            <!--Mini menu para Carrito-->
            <section class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
              <header class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </header>
              <main class="offcanvas-body">
                <div class="row justify-content-center p-4 carrito-container"></div>
              </main>
            </section>
          <!-- End Car Dropdown -->';
        echo $car;
      }

  }

?>