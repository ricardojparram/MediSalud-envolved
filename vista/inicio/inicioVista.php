<!DOCTYPE html>
<html lang="en">

<head>
  <title>MediSalud C.A</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?php $VarComp->header(); ?>
</head>

<body class="vw-100 vh-100" id="body">

  <header class="w-100 h-100">
     <nav class="navbar navbar-expand-lg navbar-light fixed-top d-block" id="navbar">
        <div class="container">
          <a class="navbar-brand d-inline-flex" href="index.html">
            <img class="d-inline-block" src="assets/img/Logo_Medi.png" alt="logo" width="50px" height="50px" />
            <span class="text-1000 fs-0 fw-bold m-2">Medisalud</span>
          </a>

          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page" href="#categoryWomen">Inicio</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#header">Nosotros</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#collection">Catálogo</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#outlet">Comprar</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#outlet">Contactos</a></li>
            </ul>
                <div class="mx-2 mx-lg-0">
                  <a class="text-success" href="#"><em>Iniciar sesión  </em><i class="bi bi-person-fill"></i></a>
                  <a class="text-success ps-2" href="#"><em>Registrarse  </em><i class="bi bi-person-lines-fill"></i></a>
                </div>
          </div>
        </div>
      </nav>

      <div class=" d-flex justify-content-center align-items-center h-100 w-100">
          <div id="carouselExampleCaptions" class="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active bg-black" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class="bg-black"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" class="bg-black"></button>
            </div>
            <div class="carousel-inner ">
              <div class="carousel-item active">
                <img src="assets/img/MultiFila.png" class="d-block vw-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark">
                  <h5>First slide label</h5>
                  <p>Some representative placeholder content for the first slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="assets/img/Grafico.png" class="d-block vw-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content for the second slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="assets/img/TablaCrud.png" class="d-block vw-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark">
                  <h5>Third slide label</h5>
                  <p>Some representative placeholder content for the third slide.</p>
                </div>
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

    </header>

    <section class="w-100 row">
      <div class="col-md-3 d-flex justify-content-center">
        <i class="bi bi-person-fill bi-2x"></i>
      </div>
      <div class="col-md-3 d-flex justify-content-center">
        <i class="bi bi-person-fill bi-2x"></i>
      </div>
      <div class="col-md-3 d-flex justify-content-center">
        <i class="bi bi-person-fill bi-2x"></i>
      </div>
      <div class="col-md-3 d-flex justify-content-center">
        <i class="bi bi-person-fill bi-2x"></i>
      </div>
    </section>

  <main class="w-100 h-100">
    <h1>MAIN CONTENT</h1>
  </main>

  <footer class="h-25 w-100">
    <h1>FOOTER</h1>
  </footer>

  <?php $VarComp->js() ?>
  <script>
    
    const myCarouselElement = document.querySelector('#carouselExampleCaptions')

    const carousel = new bootstrap.Carousel(myCarouselElement, {
      interval: 2000,
      // touch: false
    })

  </script>
</body>

</html>