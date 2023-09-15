<!DOCTYPE html>
<html lang="en">

<head>
  <title>MediSalud C.A</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?php $VarComp->header(); ?>
  <link rel="stylesheet" href="assets/css/tienda.css">
</head>

<body class="body" id="body">

  <header class="w-100 h-100">
    
  <!-- Barra navegadora -->
    <?php $Nav->nav(); ?>

  </header>

   <main class="w-100"> 
   <div id="carrusel" class=" d-flex justify-content-center align-items-center mb-3">
          <div id="carouselExampleCaptions" class="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active bg-black" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class="bg-black"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" class="bg-black"></button>
            </div>
            <div class="carousel-inner ">
              <div class="carousel-item active">
                <img src="assets/img/tera.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="assets/img/rixigal.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="assets/img/inmukids.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>


        <!-- ======= Services Section ======= -->
        <section id="services" class="services my-5">
          <div class="container">

            <div class="section-title">
              <h2 class="text-center">Servicios</h2>
              <p class="fs-4 text-center">Nuestra farmacia ofrece una amplia gama de productos que incluyen , entre otros, la venta de medicamentos en las siguientes presentaciones: </p>
            </div>

            <div class="row">
              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div id="services_1" class="icon-box">
                  <div class="icon text-center mb-4 mt-4 ">
                    <i class="ri-capsule-fill"></i>
                  </div>
                  <h4 class="title text-center"><a>Tabletas y Cápsulas</a></h4>
                  <p class="description text-justify fs-7">Son formas sólidas de administración de medicamentos que contienen una dosis precisa de ingredientes activos</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div id="services_2" class="icon-box" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon text-center mb-4 mt-4">
                    <i class="ri-medicine-bottle-fill"></i>
                  </div>
                  <h4 class="title text-center"><a>Jarabes</a></h4>
                  <p class="description text-justify fs-7">Son formas líquidas de administración de medicamentos que contienen una solución de ingredientes activos en una base de agua y azúcar</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div id="services_3" class="icon-box" data-aos="fade-up" data-aos-delay="200">
                  <div class="icon text-center mb-4 mt-4">
                    <i class="ri-syringe-fill"></i>
                  </div>
                  <h4 class="title text-center"><a>Inyecciones</a></h4>
                  <p class="description text-justify fs-7">Son formas de administración de medicamentos que se aplican directamente en el cuerpo a través de una aguja y una jeringa</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div id="services_4" class="icon-box" data-aos="fade-up" data-aos-delay="300">
                  <div class="icon text-center mb-4 mt-4">
                    <i class="ri-hand-sanitizer-fill"></i>
                  </div>
                  <h4 class="title text-center"><a>Loción</a></h4>
                  <p class="description text-justify fs-7">Es una forma líquida de administración de medicamentos que se aplica tópicamente en la piel para tratar afecciones dermatológicas</p>
                </div>
              </div>

            </div>

          </div>
        </section><!-- End Services Section -->

        <section id="productos" class="productos my-4">
         <div class="container my-2">
           <h3 class="text-center p-3 mt-3 fw-bold">Productos</h3>
           <div class="row mx-auto" id="catalogo">



           </div>
           <div class="row">
            <div class="col-12 d-flex justify-content-center mb-4"> 
              <a class="btn btn-lg btn-dark" href="#!">Ver Todo</a>
            </div>
          </div>

        </div>
      </section>



    </main>

  <?php $footer->footer();  ?>

  <?php $Car->car(); ?>

  <?php $VarComp->js() ?>
  <script src="assets/js/inicio.js"></script>
  <script src="assets/js/carrito.js"></script>
  <script>
    
    const myCarouselElement = document.querySelector('#carouselExampleCaptions')

    const carousel = new bootstrap.Carousel(myCarouselElement, {
      interval: 1000,
       touch: false
    })

  </script>
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

<div class="modal fade" id="AñadirCarrito" tabindex="-1" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Añadir a carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center m-3">
          <img class="card-img-top mx-auto" style="width: 80%;" src="https://images.squarespace-cdn.com/content/v1/58126462bebafbc423916e25/1490212943759-5AVQSBMUSU12111CKAYM/image-asset.png">
        </div>
        <div class="card-title mostrarP">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Añadir al carrito</button>
      </div>
    </div>
  </div>
</div>