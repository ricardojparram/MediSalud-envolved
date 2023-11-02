<!DOCTYPE html>
<html lang="en">

<head>
  <title>MediSalud C.A</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?php $VarComp->header(); ?>
  <link rel="stylesheet" href="assets/css/tienda.css">
</head>

<body>

  <header class="w-100 h-100">
    
  <!-- Barra navegadora -->
    <?php $tiendaComp->nav(); ?>


  </header>
  <section class="presentacion d-flex justify-content-center align-items-center">
    <div class="container container-md row text-white">
      <div class="col-12 col-md-6 row align-items-center">
        <div>
          <h1 class="fw-bold">Farmacia MediSalud C.A</h1>
          <p class="fs-6" style="text-align: justify;">Nuestra farmacia en línea ofrece una amplia variedad de medicamentos y productos de salud para satisfacer todas sus necesidades. Ofrecemos envíos a todo el país para que pueda recibir sus productos directamente en la comodidad de su hogar.</p>
          <span class="row gap-4 align-items-center justify-content-center">
            <button class="btn btn-light col-6">Más informacion</button>
            <button class="btn btn-success col-5"><b>¡Compra ya!</b></button>
          </span>
          
        </div>
      </div>
      <div class="col-12 col-md-6 row align-items-center justify-content-center pt-5">
        <img class="img-fluid " src="assets/img/presentacion-imagen.svg" alt="Imagen vectorizada de farmacia">
      </div>
      
    </div>
  </section>

  <main class="w-100"> 


    <!-- ======= Services Section ======= -->
            
        <section class="row gap-4 servicios mt-5">
          <header>
            <h2 class="text-center fs-2 fw-bold titulos">Servicios</h2>
            <p class="text-center fs-5">Ofrecemos una amplia gama de productos, incluyendo las siguientes presentaciones.</p>
          </header>

          <div class="row">

            <div class="col-xl-4 text-center">
              <img src="assets/img/servicios-img.svg" class="img-fluid p-4" alt="">
            </div>

            <div class="col-xl-8 d-flex content">
              <div class="row align-self-center gy-4">

                <div class="col-md-6 icon-box" data-aos="fade-up">
                  <i class="ri-capsule-fill"></i>
                  <div>
                    <h4>Tabletas y Cápsulas</h4>
                    <p>Son formas sólidas de administración de medicamentos que contienen una dosis precisa de ingredientes activos</p>
                  </div>
                </div>

                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="ri-medicine-bottle-fill"></i>
                  <div>
                    <h4>Jarabes</h4>
                    <p>Son formas líquidas de administración de medicamentos que contienen una solución de ingredientes activos en una base de agua y azúcar</p>
                  </div>
                </div>

                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="ri-syringe-fill"></i>
                  <div>
                    <h4>Inyecciones</h4>
                    <p>Son formas de administración de medicamentos que se aplican directamente en el cuerpo a través de una aguja y una jeringa</p>
                  </div>
                </div>

                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="ri-hand-sanitizer-fill"></i>
                  <div>
                    <h4>Loción</h4>
                    <p>Es una forma líquida de administración de medicamentos que se aplica tópicamente en la piel para tratar afecciones dermatológicas</p>
                  </div>
                </div>

              </div>
            </div>

          </div>

        </section>
    <!-- ====== Service section end -->        

        <section id="productos" class="productos my-4">
          <div class="container my-2">
            <h3 class="text-center p-3 mt-3 fw-bold">Productos</h3>
            <div class="row mx-auto justify-content-center align-items-center" id="catalogo">

            </div>
            <div class="row">
              <div class="col-12 d-flex justify-content-center mb-4"> 
                <a class="btn btn-lg btn-dark" href="#!"><strong>Ver más...</strong></a>
              </div>
            </div>

          </div>
        </section> -->



    </main>

  <?php $footer->footer(); ?>

  <?php $tiendaComp->car(); ?>

  <?php $VarComp->js() ?>
  <script src="assets/js/inicio.js"></script>
  <script src="assets/js/carrito.js"></script>

</body>

</html>

<!-- Modal eliminar producto del carrito -->
<div class="modal fade" id="delModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">¿Estás seguro?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Desea eliminar el producto <b id="delProductTitle"></b> del carrito?</h5>
      </div>
      <div class="modal-footer" id="divEli">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarModalDel">Cancelar</button>
        <button type="button" class="btn btn-danger" id="delProductFromCar">Confirmar</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="AñadirCarritoModal" style="transition: all 0.4s ease-in-out 0s;" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-8">
        <div class="position-absolute top-0 end-0 me-3 mt-3">
          <button type="button" class="btn-close cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row">
          <div class="col-lg-6 row justify-content-center align-items-center">
            <!-- img slide -->
              <img class=".img-fluid" src="assets/img/productos/producto_imagen.png" alt="producto_imagen">
          </div>
          <div class="col-lg-6">
            <div class="ps-lg-8 mt-6 mt-lg-0">
              <a href="#!" class="mb-4 d-block tipo_medicamento">Antiinflamatorio</a>
              <h2 class="mb-1 h1 nombre_medicamento">Diclofenac potásico</h2>
              <h6 class="descripcion_medicamento"></h6>
              <div class="mb-4">
                <small class="text-warning">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small><a href="#" class="ms-2"></a>
              </div>
              <div class="fs-4 precios">
                <span class="fw-bold text-dark ">Bs. <span class="precio_bs">120.00</span></span>
                <span class="text-muted precio_dolar" >$4.00</span>
              </div>
              <hr class="my-6">
              <div class="opciones row">
                <div class="input-group cantidad_producto col-6" style="max-width: 180px;">
                  <button class="btn btn-light menos"><i class="bi bi-dash-lg"></i></button>
                  <input type="number" id="cantidad_añadir_producto" min="1" max="50" value="1" class="form-control form-input">
                  <button class=" btn btn-light mas"><i class="bi bi-plus-lg"></i></button>
                </div>
                <div class="invalid-tooltip-prod col-6" style="">Cantidad no disponible.</div>
              </div>
              <div class="mt-3 row justify-content-start g-2 align-items-center">

                <div class="col-lg-4 col-md-5 col-6 d-grid">
                  <button type="button" id="añadir_al_carrito" class="btn btn-success">
                    Agregar al carrito <i class="bi bi-cart-plus-fill"></i>
                  </button>
                </div>
              </div>
              <hr class="my-6">
              <div>
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td>Código de producto:</td>
                      <td class="codigo_producto"></td>
                    </tr>
                    <tr>
                      <td>Tipo:</td>
                      <td class="tipo_producto"></td>
                    </tr>
                    <tr>
                      <td>Contraindicaciones:</td>
                      <td class="contraindicaciones">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>