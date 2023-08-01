<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pago</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?php  $VarComp->header();?>
    <link rel="stylesheet" href="assets/css/tienda.css">

</head>
<style>
    .main{
        margin-top: 38px;
    }
</style>



<body class="bg-gradient-primary" id="body">

<header class="">
    
  <!-- Barra navegadora -->
    <?php $Nav->nav(); ?>

</header>
  <main class="main">
    <div class="">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
              <h3 class="text-center font-weight-light my-4">Detalles de la Factura</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <div class="row form-group col-md-12">
                            <div class="form-group col-lg-6">
                                <label class="col-form-label"> <strong>Nombre</strong> </label>
                                <input disabled class="form-control" id="nombre" type="text" placeholder="Nombre">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-form-label"> <strong>Apellido</strong> </label>
                                <input disabled class="form-control" id="apellido" type="text" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="row form-group col-md-12">
                            <div class="form-group col-lg-6">
                                <label class="col-form-label"> <strong>Correo</strong> </label>
                                <input disabled class="form-control" id="email" type="text" placeholder="Correo Electronico">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-form-label"> <strong>Telefono</strong> </label>
                                <input disabled class="form-control" id="telfono" type="text" placeholder="Telefono">
                            </div>
                        </div>
                        <div class="row form-group col-md-12">
                            <div class="form-group col-lg-6">
                                <label class="col-form-label"> <strong>Estado</strong> </label>
                                <input disabled class="form-control" id="nombre" type="text" placeholder="nombre">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-form-label"> <strong>Apellido</strong> </label>
                                <input disabled class="form-control" id="apellido" type="text" placeholder="apellido">
                            </div>
                        </div>
                    </div>
                </form>
  </main>

  

  <?php $VarComp->js();?>   



</body>

</html>