<!DOCTYPE html>
<html lang="en">

<head>
  <title>Inciar sesión</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?php  $VarComp->header();?>
    <link href="assets/css/login.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary" id="body">

  <div class="container w-75">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-md-4 col-lg-5 d-none d-lg-block bg "></div>
              <div class="col-lg-7">
                 <div class="p-5">

                    <div class="text-end">
                       <img src="assets/img/Logo_Medi.png" width="50px" alt="">
                    </div>

                        <div class="text-center">
                          <h1 class="B fw-bold text-center py-2 ">Bienvenidos</h1>
                        </div>

                        <form class="user">
                                
                          <div class="form-group">

                            <div class="mb-4">
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca su cédula registrada en el sistema."><i class="bi bi-person-fill"></i></button>
                              <input type="text" placeholder="Cedula" class="form-control" id="cedula" >
                              </div>

                          </div>

                            <div class="mb-4">
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la contraseña registrada con su cédula."><i class="bi bi-key-fill"></i></button> 
                              <input type="password" placeholder="Contraseña" class="form-control" id="pass" >
                              </div>
 
                             
                          </div>
                            <p style="color:#ff0000;text-align: center;" id="error"></p>

                            <div class="d-grid">
                              <button type="submit" id="boton" class="btn btn-primary">Iniciar Sesión</button>
                            </div><br>
                              
                            <hr>

                            <div class="my-3 text-center asd">
                              <span>No tiene cuenta? <a href="?url=registro">Registrarse</a></span><br>
                              <span>Olvidaste tu contraseña? <a href="?url=recuperar">Recuperar contraseña</a></span>
                            </div>
               </div>
           </div>
        </div>
      </div>
    </div>

  </div>

 </div>

  <?php $VarComp->js();?>   

  <script src="assets/js/login.js"></script>

 


</body>

</html>