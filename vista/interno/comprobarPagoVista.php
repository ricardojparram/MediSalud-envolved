<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roles</title>
  <?php $comp->header(); ?>
  <link rel="stylesheet" href="assets/css/estiloInterno.css">
</head>
<body>
  <!-- ======= Header ======= -->

  <?php 

    $header->Header();

  ?>

  <!-- End Header -->


  <!-- ======= Sidebar ======= -->

  <?php 

   $menu->Menu();

 ?>

 <!-- End Sidebar-->



 <main class="main" id="main">
  <div class="pagetitle">
    <h1>Comprobar pagos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Comprobación de pagos de ventas online</li>
      </ol>
    </nav>

  </div>

  <div class="card">
    <div class="card-body">

      <div class="row">
        <div class="col-6">
          <h5 class="card-title">Listado de pagos</h5>
        </div>



        <!-- Table with stripped rows -->

        <div class="table-responsive">
          <table class="table table-bordered " id="tablaPagos" width="100%" cellspacing="0">
            <thead>

              <tr>
                <th scope="col">N° Factura</th>
                <th scope="col">Cédula cliente</th>
                <th scope="col">Nombre cliente</th>
                <th scope="col">Estado</th>
                <!-- <th scope="col">Opciones</th> -->
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th scope="col">N° Factura</th>
                <th scope="col">Cédula cliente</th>
                <th scope="col">Nombre cliente</th>
                <th scope="col">Estado</th>
                <!-- <th scope="col">Opciones</th> -->
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- End Table with stripped rows -->

        <!-- Modal Ḿódulos y permisos -->
        <div class="modal fade" id="comprobacion" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
            <div class="modal-content h-25">
              <div class="modal-header">
                <h5 class="modal-title"><strong>Estado de la comprobación</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="row">
                  <div class="col-4">
                    <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off">
                    <label class="btn btn-outline-success" for="success-outlined">Aprobado</label>
                  </div>
                  <div class="col-4">
                    <input type="radio" class="btn-check" checked name="options-outlined" id="warning-outlined" autocomplete="off">
                    <label class="btn btn-outline-warning" for="warning-outlined">En espera</label>
                  </div>

                  <div class="col-4">
                    <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
                    <label class="btn btn-outline-danger" for="danger-outlined">Negado</label>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id="enviarPermisos">Actualizar</button>
              </div>
            </div>
          </div>

  </main>

</body>

<?php $comp->js(); ?>
<script type="text/javascript" src="assets/js/comprobarPagos.js"></script>

</html>