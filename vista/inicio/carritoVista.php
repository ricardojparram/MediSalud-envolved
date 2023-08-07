<!DOCTYPE html>
<html lang="en">

<head>
  <title>MediSalud C.A - Carrito de Compras</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?php $VarComp->header(); ?>
  <link rel="stylesheet" href="assets/css/tienda.css">
</head>

<body class="body vh-100 w-100" id="body">

  <header class="">

    <!-- Barra navegadora -->
    <?php $Nav->nav(); ?>

  </header>

  <main class="w-100 d-flex justify-content-center p-5 carritoMain" style="margin-top: 76px"> 

    <div class="page-container">
      <div class="pagetitle">
        <h1>Carrito de compras</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Artículos agregados para comprar</li>
          </ol>
        </nav>
      </div>
      <div class="cardContainer">
        <div class="card">
          <div class="card-body">
            <div class="row pt-4 px-4">
              <div class="col-6 p-0 fs-4">
                <a class="carritoButton regresar" href=""><i class="bi bi-arrow-bar-left fs-3"></i></a>
              </div>

              <div class="col-6 p-0 fs-4 text-end">
                <a class="carritoButton vaciar" href=""><i class="bi bi-cart-x fs-3"></i></a>
              </div>
            </div>
            <div class="row justify-content-center p-4 carrito-container">

            </div>
          </div>
        </div>
        <div class="card cardTotal">
          <div class="card-body p-4">
            <h4>Precio total del carrito</h4>
            <h3 id="precioTotal">200$</h3>
            <button class="btn btn-success"><i class="bi bi-cart-check-fill"></i> Realizar facturación</button>
          </div>
        </div>
      </div>

    </div>

  </main>

  <footer class="h-25 w-100">
    <h1>FOOTER</h1>
  </footer>

  <?php $VarComp->js() ?>
  <script src="assets/js/carrito.js"></script>
</body>

</html>