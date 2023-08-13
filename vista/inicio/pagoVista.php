<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pago</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?php  $VarComp->header();?>
    <link rel="stylesheet" href="assets/css/tienda.css">
    <!-- <link rel="stylesheet" href="assets/css/form-elements.css"> -->
    <link rel="stylesheet" href="assets/css/estiloPago.css">

</head>
<style>
    .main{
        margin-top: 76px;
    }

    #fade{
        display: none;
    } 
</style>



<body class="bg-gradient-primary" id="body">

<header class="">
    
  <!-- Barra navegadora -->
    <?php $Nav->nav(); ?>

</header>
  <main class="main mx-auto pt-5 col-10 row">
    <div class="col-sm-12 col-md-10 col-lg-7 mx-md-auto mx-lg-0">
        <div class="card">
                <div class="">
                    <form action="" method="post" class="f1">
                        <h3>Registrar</h3>
                        <div class="f1-steps">
                            <div class="f1-progress">
                                <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                            </div>
                            <div class="f1-step active">
                                <div class="f1-step-icon"><i class="ri-user-fill"></i></div>
                                <p>Datos Personales</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon"><i class="ri-map-pin-2-line"></i></div>
                                <p>Direccion de Entrega</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon"><i class="bi bi-credit-card"></i></div>
                                <p>Referencia de Pago</p>
                            </div>
                        </div>


                        <!--paso 1 -->
                        <fieldset>
                                <br>
                    			<div class="row form-group col-md-12">
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-6 col-form-label"><strong>Nombre</strong></label>
                                        <div class="input-group ">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="El nombre debe tener 3 o más letras(a-z, A-Z)"><i class="bi bi-people-fill"></i></button>
                                            <input type="text" class="form-control" id="nomClien" disabled name="nomClien">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-6 col-form-label"><strong>Apellido</strong></label>
                                        <div class="input-group">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca su apellido."><i class="bi bi-people"></i></button>
                                            <input type="text" class="form-control" disabled id="apeClien" name="apeClien">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group col-md-12">
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-6 col-form-label"><strong>Telefono</strong></label>
                                        <div class="input-group ">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca su numerico telefonico."><i class="bi bi-telephone"></i></button>
                                            <input type="text" class="form-control" placeholder="Telefono" id="teleClien" name="teleClien">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-6 col-form-label"><strong>Cedula</strong></label>
                                        <div class="input-group">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="La cédula debe tener 6 o más carácteres, solo números(0-9)." aria-describedby="popover809249"><i class="bi bi-person-fill"></i></button>
                                            <input type="text" class="form-control" disabled id="cedClien" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group col-md-12">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Correo Electronico</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="El apellido debe tener 3 o más letras(a-z, A-Z)"><i class="bi bi-people"></i></button>
                                        <input type="text" class="form-control" id="emailClien" placeholder="ejemplo@email.com">
                                    </div>
                                </div>
                                <p class="nota col-11 mx-auto small mt-2">*Si encuentras algún dato personal incorrecto, corrígelo en la sección de perfil antes de seguir con el registro</p>
                                <p class="mt-2" id="error1" style="color:#ff0000;text-align: center;"></p>
                                <div class="f1-buttons mt-3">
                                    <button type="button" class="btn btn-success btn-next" id="1">Siguiente</button>
                                </div>
                        </fieldset>
                            <!-- fin del paso 1 -->

                        <!---paso 2 -->
                        <fieldset>
                            <br>
                            <div class="row form-group col-md-12">
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Nombre</strong></label>
                                    <div class="input-group ">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca el nombre del cliente."><i class="bi bi-person-fill"></i></button>
                                        <input type="text" class="form-control" placeholder="Nombre" id="nomClien" name="nomClien">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Nombre</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el apellido del cliente."><i class="bi bi-people"></i></button>
                                        <input type="text" class="form-control" placeholder="Apellido" id="apeClien" name="apeClien">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 col-md-12">
                                <label for="inputText" class="col-6 col-form-label"><strong>Apellido</strong></label>
                                <div class="input-group">
                                    <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="El apellido debe tener 3 o más letras(a-z, A-Z)"><i class="bi bi-people"></i></button>
                                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="row form-group col-md-12">
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Nombre</strong></label>
                                    <div class="input-group ">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca el nombre del cliente."><i class="bi bi-person-fill"></i></button>
                                        <input type="text" class="form-control" placeholder="Nombre" id="nomClien" name="nomClien">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Apellido</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el apellido del cliente."><i class="bi bi-people"></i></button>
                                        <input type="text" class="form-control" placeholder="Apellido" id="apeClien" name="apeClien">
                                    </div>
                                </div>
                            </div>
                            <p class="mt-2" id="error2" style="color:#ff0000;text-align: center;"></p>
                            <div class="f1-buttons mt-3">
                                <button type="button" class="btn btn-secondary btn-previous">Atrás</button>
                                <button type="button" class="btn btn-success btn-next" id="2">Siguiente</button>
                            </div>
                        </fieldset>
                            <!--fin del paso 2 -->

                        <!---paso 3 -->
                        <fieldset>
                            <br>
                            <div class="row form-group col-md-12">
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Nombre del Banco</strong></label>
                                    <div class="input-group ">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca el nombre del banco desque que hizo el deposito."><i class="bi bi-person-fill"></i></button>
                                        <input type="text" class="form-control" placeholder="Nombre" id="nomBanc">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-8 col-form-label"><strong>Numero de Referencia</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el numero de referencia del deposito."><i class="bi bi-people"></i></button>
                                        <input type="text" class="form-control" placeholder="123456789123" id="numRef">
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group col-md-12">
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Fecha</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la fecha de la realizacion del deposito"><i class="bi bi-calendar"></i></button> 
                                        <input type="date" id="fecha" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-8 col-form-label"><strong>Cantidad de Deposito</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la cantidad del deposito."><i class="bi bi-people"></i></button>
                                        <input type="text" class="form-control" placeholder="123,12" id="canDep" step="0.01" min="0" max="10">
                                    </div>
                                </div>
                            </div>
                            <p class="mt-2" id="error3" style="color:#ff0000;text-align: center;"></p>
                            <div class="f1-buttons mt-3">
                                <button type="button" class="btn btn-secondary btn-previous">Atrás</button>
                                <button type="button" class="btn btn-success enviar" id="3">Registar Datos</button>
                            </div>
                        </fieldset>
                        <!--fin del paso 3 -->

                    </form>
                </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-10 col-lg-5 mx-md-auto mx-lg-0">
        <div class="card">
            <div class="f1">
                <div class="row">
                    <h5 class="col-6"><strong>Cantidad a Pagar:</strong></h5>
                    <h5 class="col-6 text-right">302,45 Bs.</h5>
                </div>
                <div class="row">
                    <h5 class="col-6"><strong>Al Cambio:</strong></h5>
                    <h5 class="col-6 text-right">10,00 $</h5>
                </div>
            </div>
        </div>

        <div class="card">
            <form action="" method="post" class="f1" id="fade">
                <div class="row mb-1 col-sm-12 col-md-8 mx-auto">
                    <label for="inputText" class="col-8 col-form-label mx-auto text-center"><strong>Tipo de Pago</strong></label>
                    <div class="input-group">
                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Selecicone un tipo de pago"><i class="bi bi-sort-up"></i></button>
                        <select  class="form-select" id="tipoP">
                            <option selected disabled>Tipo</option>
                            <option value="4">Pago Movil</option>
                            <option value="5">Transferencia</option>
                        </select>
                    </div>

                </div>
                <div class="row form-group col-md-12">
                    <div class="col-lg-6">
                        <label for="inputText" class="col-8 col-form-label "><strong>Nombre de Banco</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Selecicone un tipo de pago"><i class="bi bi-sort-up"></i></button>
                            <select  class="form-select" id="bancTipo">
                                <option selected disabled>Nombre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 trans">
                        <label for="inputText" class="col-8 col-form-label"><strong>Cedula/Rif</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el numero de referencia del deposito."><i class="bi bi-people"></i></button>
                            <input type="text" class="form-control" disabled  id="cedBanc">
                        </div>
                    </div>
                    <div class="col-lg-6 movil">
                        <label for="inputText" class="col-8 col-form-label"><strong>Cedula/Rif</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el numero de referencia del deposito."><i class="bi bi-people"></i></button>
                            <input type="text" class="form-control" disabled  id="cedBancM">
                        </div>
                    </div>
                </div>
                <div class="row form-group col-md-12 movil">
                    <div class="col-lg-6">
                        <label for="inputText" class="col-8 col-form-label"><strong>Telefono</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la fecha de la realizacion del deposito"><i class="bi bi-calendar"></i></button> 
                            <input type="text" id="teleMovil" disabled class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="inputText" class="col-8 col-form-label"><strong>Codigo del Banco</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la fecha de la realizacion del deposito"><i class="bi bi-calendar"></i></button> 
                            <input type="text" id="codBanc" disabled class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row form-group col-md-12 trans">
                    <label for="inputText" class="col-8 col-form-label"><strong>Numero de Cuenta</strong></label>
                    <div class="input-group">
                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la fecha de la realizacion del deposito"><i class="bi bi-calendar"></i></button> 
                        <input type="text" id="numCuen" disabled class="form-control">
                    </div>
                </div>
            </form>
        </div>

    </div>


  </main>

  

  <?php $VarComp->js();?>   
  <script src="assets/js/pagoTab.js"></script>



</body>

</html>