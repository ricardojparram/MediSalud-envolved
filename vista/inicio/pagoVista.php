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

    .form-switch {
        padding-left: 3.5em;
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
                                            <input type="text" class="form-control" id="nomClien"  name="nomClien">
                                        </div>
                                        <p class="m-0" id="errorNomApe" style="color:#ff0000;text-align: center;"></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-6 col-form-label"><strong>Cedula</strong></label>
                                        <div class="input-group">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="La cédula debe tener 6 o más carácteres, solo números(0-9)." aria-describedby="popover809249"><i class="bi bi-person-fill"></i></button>
                                            <input type="text" class="form-control"  id="cedClien" >
                                        </div>
                                        <p class="m-0" id="errorCed" style="color:#ff0000;text-align: center;"></p>
                                    </div>
                                </div>
                                <div class="row form-group col-md-12">
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-6 col-form-label"><strong>Telefono</strong></label>
                                        <div class="input-group ">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca su numerico telefonico."><i class="bi bi-telephone"></i></button>
                                            <input type="text" class="form-control" placeholder="Telefono" id="teleClien">
                                        </div>
                                        <p class="m-0" id="errorTele" style="color:#ff0000;text-align: center;"></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-6 col-form-label"><strong>Correo Electronico</strong></label>
                                        <div class="input-group">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca un correo electrónico válido. Ej: usuario@mail.es"><i class="ri-at-line"></i></button>
                                            <input type="text" class="form-control" placeholder="ejemplo@email.com" id="emailClien">
                                        </div>
                                        <p class="m-0" id="errorEmail" style="color:#ff0000;text-align: center;"></p>
                                    </div>
                                </div>
                                <div class="row form-group col-md-12">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Direccion Fiscal</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Ingrese su direccion para la factura"><i class="bi bi-map"></i></button>
                                        <input type="text" class="form-control" id="direcClien" placeholder="Direccion">
                                    </div>
                                    <p class="m-0" id="errorDirec" style="color:#ff0000;text-align: center;"></p>
                                </div>
                                <p class="nota col-11 mx-auto small mt-2">*Si encuentras algún dato personal incorrecto, corrígelo en la sección de perfil antes de seguir con el registro</p>
                                <p class="m-0" id="error1" style="color:#ff0000;text-align: center;"></p>
                                <div class="f1-buttons mt-3">
                                    <button type="button" class="btn btn-success btn-next" id="1">Siguiente</button>
                                </div>
                        </fieldset>
                        <!-- fin del paso 1 -->

                        <!---paso 2 -->
                        <fieldset>
                            <br>
                            <div class="col-12 text-end">
                                <label for="inputText" class="col-form-label"><strong>Direcciones Frecuentes</strong></label>
                                <button type="button" class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable"><i class="bi bi-search"></i></button>
                                
                                <!-- Modal Direcciones Recientes -->
                                <div class="modal fade" id="modalDialogScrollable" tabindex="-1" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Modal Dialog Scrollable</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
                                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                                        This content should appear at the bottom after you scroll.
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- Fin Modal -->

                            </div>
                            <div class="row form-group mb-1 col-md-12">
                                <div class="col-12">
                                    
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Estado</strong></label>
                                    <div class="input-group ">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca el nombre del cliente."><i class="bi bi-person-fill"></i></button>
                                        <input type="text" class="form-control" placeholder="Nombre" id="nomClien" name="nomClien">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Municipio</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el apellido del cliente."><i class="bi bi-people"></i></button>
                                        <input type="text" class="form-control" placeholder="Apellido" id="apeClien" name="apeClien">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 col-md-12">
                                <label for="inputText" class="col-6 col-form-label"><strong>Direccion</strong></label>
                                <div class="input-group">
                                    <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="El apellido debe tener 3 o más letras(a-z, A-Z)"><i class="bi bi-pin-map"></i></button>
                                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="row mb-1 form-group col-md-12">
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Numero de Casa</strong></label>
                                    <div class="input-group ">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca el nombre del cliente."><i class="bi bi-person-fill"></i></button>
                                        <input type="text" class="form-control" placeholder="Nombre" id="nomClien" name="nomClien">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-6 col-form-label"><strong>Codigo Postal</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el apellido del cliente."><i class="bi bi-people"></i></button>
                                        <input type="text" class="form-control" placeholder="Apellido" id="apeClien" name="apeClien">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 form-group col-md-12">
                                <div class="form-check form-switch my-3 col-lg-6">
                                    <input class="form-check-input" type="checkbox" id="checkAlias">
                                    <label class="form-check-label" >Guardar Direccion</label>
                                </div>
                                <div class="col-lg-6 my-auto" id="aliasInp">
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Coloque un alias para guardar la direccion."><i class="bi bi-people"></i></button>
                                        <input type="text" class="form-control" placeholder="Alias" >
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group col-md-12">
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-8 col-form-label "><strong>Empresa de Envio</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Selecicone un tipo de pago"><i class="bi bi-truck"></i></button>
                                        <select class="form-select" id="">
                                            <option selected="" disabled="">Nombre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-8 col-form-label "><strong>Sede de Envio</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Selecicone un tipo de pago"><i class="bi bi-sort-up"></i></button>
                                        <select class="form-select" id="">
                                            <option selected="" disabled="">Ubicacion</option>
                                        </select>
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

        <!-- Precio y Cambio -->
        <div class="card">
            <div class="f1" id="precios">

                <div class="row">
                    <h5 class="col-6"><strong>Cantidad a Pagar:</strong></h5>
                    <h5 class="col-6 text-right" id="valorBs"></h5>
                </div>
                <div class="row">
                    <h5 class="col-6"><strong>Al Cambio:</strong></h5>
                    <h5 class="col-6 text-right" id="valorUsd"></h5>
                </div>
            </div>
        </div>

        <!-- Metodo de Pago -->
        <div class="card">
            
            <form action="" method="post" class="f1" id="fade">
                <div class=" col-8 mx-auto text-center">
                    <h4 class="m-0">Elija un Metodo a Pagar</h4>
                </div>
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
                            <input type="text" class="form-control" disabled id="cedBanc">
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
                <p class="nota col-11 mx-auto small mt-2">*Al seleccionar un metodo de pago se podra comprobar a que cuenta se hizo el deposito</p>
            </form>
        </div>

    </div>


  </main>

  

  <?php $VarComp->js();?>   
  <script src="assets/js/pagoTab.js"></script>



</body>

</html>