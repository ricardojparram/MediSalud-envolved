<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <?php $VarComp->header(); ?>
    <link rel="stylesheet" href="assets/css/estiloInterno.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap5.min.css">
    

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


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reportes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Generador de reportes</li>
        </ol>
      </nav>

    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reportes</h5>
              <p>Seleccione el reporte que desea generar.</p>
              <select class="form-control" id="tipoReporte">
                <option disabled selected>Tipo de reporte</option>
                <option value="venta" >Ventas</option>
                <option value="compra" >Compras</option>
                <!-- <option value="pagos" >Pagos recibidos</option> -->
              </select>
              <br>
              <div class="row">
                <div class="col-6">
                  <p>Fecha inicial: </p>
                  <input type="date" class="form-control" id="fecha" name="">
                </div>
                <div class="col-6">
                  <p>Fecha Final: </p>
                  <input type="date" class="form-control" id="fecha2" name=""><br>
                </div>
                <div class="text-center">
                  <p style="color: red;" id="error"></p>
                  <button class="btn btn-success" id="generar">Generar reporte</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="section d-none" id="reporte">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">Reporte generado: </h5>
                </div>
                <div class="col-6 mt-3 text-end">
                  <button class="btn btn-success" id="exportar">Exportar reporte</button>
                </div>
              </div>

              <div class="container">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover" width="100%" cellspacing="0" id="reporteLista">
                            <thead>
                              
                            </thead>

                            <tbody>
                              
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>


  </main>

</body>
<?php $VarComp->js();?>

<script src="assets/js/reportes.js"></script>
</html>