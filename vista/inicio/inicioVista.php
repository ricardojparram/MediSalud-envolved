<!DOCTYPE html>
<html lang="en">

<head>
  <title>MediSalud C.A</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?php $VarComp->header(); ?>
</head>

<body class="vw-100 vh-100" id="body">

  <?php $nav->navClien(); ?>

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