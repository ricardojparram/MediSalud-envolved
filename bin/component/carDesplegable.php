<?php

    namespace component;

    class carDesplegable{

        public function Car(){
            $car = '

            <!-- Boton para Carrito Desplegable -->
            <button id="carRight" class="btn fs-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-cart4"></i></button>
          
            <!--Mini menu para Carrito-->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de Compras</h5>
              <button type="button" class="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <div class="row justify-content-center p-4 carrito-container">

              </div>
            </div>
          </div>
          <!-- End Car Dropdown -->';
          echo $car;
        }

    }

?>