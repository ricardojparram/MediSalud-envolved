<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roles</title>
  <?php $VarComp->header(); ?>
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
    <h1>Roles</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestionar módulos y permisos</li>
      </ol>
    </nav>

  </div>

  <div class="card">
    <div class="card-body">

      <div class="row">
        <div class="col-6">
          <h5 class="card-title">Roles listados</h5>
        </div>



        <!-- Table with stripped rows -->

        <div class="table-responsive">
          <table class="table table-bordered " id="tabla" width="100%" cellspacing="0">
            <thead>

              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Usuarios totales</th>
                <th scope="col" style="width: 20%;">Opciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Usuarios totales</th>
                <th scope="col" style="width: 20%;">Opciones</th>
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- End Table with stripped rows -->

      <!-- Modal Modulos -->
      <div class="modal fade" id="modulos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header alert alert-success">
              <h5 class="modal-title"><strong>Gestionar Módulos</strong></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
              <form id="modulosForm"  class="row mx-4 mb-3">
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success " id="enviarModulos">Actualizar</button>
              </div>
          </div>
        </div>
      </div>

      <!-- Modal Permisos -->
      <div class="modal fade" id="permisos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header alert alert-success">
              <h5 class="modal-title"><strong>Gestionar Permisos</strong></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-4">
              <form id="modulosForm"  class="row mb-3">
                <div class="form-check form-switch col-6">
                  <div>
                    <p>Modulo</p>
                    <div class="row">
                      <div class="col-6 d-flex flex-row">
                        <input class="form-check-input" type="checkbox" role="switch" id="">
                        <label class="form-check-label" for="">permiso</label>
                      </div>
                      <div class="col-6">
                        <input class="form-check-input" type="checkbox" role="switch" id="">
                        <label class="form-check-label" for="">permiso</label>
                      </div>
                      <div class="col-6">
                        <input class="form-check-input" type="checkbox" role="switch" id="">
                        <label class="form-check-label" for="">permiso</label>
                      </div>
                      <div class="col-6">
                        <input class="form-check-input" type="checkbox" role="switch" id="">
                        <label class="form-check-label" for="">permiso</label>
                      </div>

                    </div>
                  </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success " id="enviarModulos">Actualizar</button>
              </div>
          </div>
        </div>
      </div>

  </main>

</body>

<?php $VarComp->js(); ?>
<script type="text/javascript" src="assets/js/roles.js"></script>

</html>