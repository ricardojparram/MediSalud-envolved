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
    .botEntre{
        height: 52px;
        border-radius: 24px;
        padding-left: 0px;
        padding-right: 0px;
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
                                        <label for="inputText" class="col-12 col-form-label"><strong>Nombre</strong></label>
                                        <div class="input-group ">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="El nombre debe tener 3 o más letras(a-z, A-Z)"><i class="bi bi-people-fill"></i></button>
                                            <input type="text" class="form-control" disabled id="nomClien">
                                        </div>
                                        <p class="m-0" id="errorNomApe" style="color:#ff0000;text-align: center;"></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-12 col-form-label"><strong>Cedula</strong></label>
                                        <div class="input-group">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="La cédula debe tener 6 o más carácteres, solo números(0-9)." aria-describedby="popover809249"><i class="bi bi-person-fill"></i></button>
                                            <input type="text" class="form-control" disabled id="cedClien">
                                        </div>
                                        <p class="m-0" id="errorCed" style="color:#ff0000;text-align: center;"></p>
                                    </div>
                                </div>
                                <div class="row form-group col-md-12">
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-12 col-form-label"><strong>Telefono</strong></label>
                                        <div class="input-group ">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca su numerico telefonico."><i class="bi bi-telephone"></i></button>
                                            <input type="text" class="form-control" placeholder="Telefono" id="teleClien">
                                        </div>
                                        <p class="m-0" id="errorTele" style="color:#ff0000;text-align: center;"></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText" class="col-12 col-form-label"><strong>Correo Electronico</strong></label>
                                        <div class="input-group">
                                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca un correo electrónico válido. Ej: usuario@mail.es"><i class="ri-at-line"></i></button>
                                            <input type="text" class="form-control" placeholder="ejemplo@email.com" id="emailClien">
                                        </div>
                                        <p class="m-0" id="errorEmail" style="color:#ff0000;text-align: center;"></p>
                                    </div>
                                </div>
                                <div class="row form-group col-md-12">
                                    <label for="inputText" class="col-12 col-form-label"><strong>Direccion Fiscal</strong></label>
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
                            <div class="mb-4">
                                <div class="col-lg-12 col-md-12 mx-auto row justify-content-center"> 
                                    <button type="button" class="col-lg-3 col-6 mx-3 mb-3 botEntre align-middle btn btn-success" id="repartidor">Delivery</button>
                                    <button type="button" class="col-lg-3 col-6 mx-3 mb-3 botEntre align-middle btn btn-success" id="nacional">Envio Nacional</button>
                                    <button type="button" class="col-lg-3 col-6 mx-3 mb-3 botEntre align-middle btn btn-success" id="persona">Retirar en Persona</button>
                                </div>
                                <p id="errorBot" style="color:#ff0000;text-align: center;"></p>
                            </div>
                            <div class="row form-group mb-1 col-md-12">
                                <div class="glass" id="delivery">
                                    <div class="row form-group col-md-12">
                                        <div class="col-lg-6">
                                            <label for="inputText" class="col-12 col-form-label"><strong>Calle</strong></label>
                                            <div class="input-group ">
                                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca el Numero de Calle."><i class="bi bi-bank"></i></button>
                                                <input type="text" class="form-control" placeholder="Calle ##" id="calle">
                                            </div>
                                            <p class="m-0" id="errorCalle" style="color:#ff0000;text-align: center;"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="inputText" class="col-12 col-form-label"><strong>Avenida</strong></label>
                                            <div class="input-group">
                                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el Numero o Nombre de la Avenida."><i class="bi bi-card-checklist"></i></button>
                                                <input type="text" class="form-control" placeholder="Avenida ##" id="numAv">
                                            </div>
                                            <p class="m-0" id="errorNumAv" style="color:#ff0000;text-align: center;"></p>
                                        </div>
                                    </div>
                                    <div class="row form-group col-md-12">
                                        <div class="col-lg-6">
                                            <label for="inputText" class="col-12 col-form-label"><strong>Numero de Casa</strong></label>
                                            <div class="input-group ">
                                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca el Numero de la Casa o Departamento."><i class="bi bi-bank"></i></button>
                                                <input type="text" class="form-control" placeholder="Numero de Casa" id="numCasa">
                                            </div>
                                            <p class="m-0" id="errorNumCasa" style="color:#ff0000;text-align: center;"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="inputText" class="col-12 col-form-label"><strong>Referencia</strong></label>
                                            <div class="input-group">
                                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca una Referencia o Instrucciones Especificas para Llegar al Lugar."><i class="bi bi-card-checklist"></i></button>
                                                <input type="text" class="form-control" placeholder="A lado de los Bomberos" id="ref">
                                            </div>
                                            <p class="m-0" id="errorRef" style="color:#ff0000;text-align: center;"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="glass" id="envio">
                                    <div class="row form-group col-md-12">
                                        <div class="col-lg-6">
                                            <label for="inputText" class="col-12 col-form-label "><strong>Empresa de Envio</strong></label>
                                            <div class="input-group">
                                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Selecicone la empresa para enviarle su pedido."><i class="bi bi-truck"></i></button>
                                                <select class="form-select" id="empresa">
                                                    <option selected="" disabled="">Nombre</option>
                                                </select>
                                            </div>
                                            <p class="m-0" id="errorEmpresa" style="color:#ff0000;text-align: center;"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="inputText" class="col-12 col-form-label "><strong>Sede de Envio</strong></label>
                                            <div class="input-group">
                                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Selecicone la sede de la empresa."><i class="bi bi-box-seam"></i></button>
                                                <select class="form-select" id="sede">
                                                    <option selected="" disabled="">Ubicacion</option>
                                                </select>
                                            </div>
                                            <p class="m-0" id="errorSede" style="color:#ff0000;text-align: center;"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="glass" id="retirar">
                                    <p>
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, eaque! Vitae quae ab corrupti accusantium a in repellat eveniet tempora obcaecati, nemo quo earum aspernatur assumenda quod eligendi? Nisi, pariatur.
                                    </p>
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
                                    <label for="inputText" class="col-12 col-form-label"><strong>Nombre del Banco</strong></label>
                                    <div class="input-group ">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover"data-bs-placement="top" data-bs-content="Introduzca el nombre del banco desque que hizo el deposito."><i class="bi bi-bank"></i></button>
                                        <input type="text" class="form-control" placeholder="Nombre" id="nomBanc">
                                    </div>
                                    <p class="m-0" id="errorNomBanc" style="color:#ff0000;text-align: center;"></p>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-12 col-form-label"><strong>Numero de Referencia</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el numero de referencia del deposito."><i class="bi bi-card-checklist"></i></button>
                                        <input type="text" class="form-control" placeholder="123456789123" id="numRef">
                                    </div>
                                    <p class="m-0" id="errorNumRef" style="color:#ff0000;text-align: center;"></p>
                                </div>
                            </div>
                            <div class="row form-group col-md-12">
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-12 col-form-label"><strong>Fecha</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la fecha de la realizacion del deposito"><i class="bi bi-calendar"></i></button> 
                                        <input type="date" id="fecha" class="form-control">
                                    </div>
                                    <p class="m-0" id="errorFecha" style="color:#ff0000;text-align: center;"></p>
                                </div>
                                <div class="col-lg-6">
                                    <label for="inputText" class="col-12 col-form-label"><strong>Cantidad de Deposito</strong></label>
                                    <div class="input-group">
                                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la cantidad del deposito."><i class="bi bi-cash-stack"></i></button>
                                        <input type="text" class="form-control" placeholder="123,12" id="canDep" step="0.01" min="0" max="10">
                                    </div>
                                    <p class="m-0" id="errorCanDep" style="color:#ff0000;text-align: center;"></p>
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
                    <h5 class="col-6"><strong>Subtotal: </strong></h5>
                    <h5 class="col-6 text-end" id="valorBs"></h5>
                </div>
                <hr class="mt-1">
                <div class="row">
                    <h5 class="col-6"><strong>I.V.A: </strong></h5>
                    <h5 class="col-6 text-end" id="impuesto"></h5>
                </div>
                <hr class="mt-1">
                <div class="row">
                    <h5 class="col-6"><strong>Total: </strong></h5>
                    <h5 class="col-6 text-end" id="total"></h5>
                </div>
                <hr class="mt-1">
                <div class="row">
                    <h5 class="col-6"><strong>Al Cambio: </strong></h5>
                    <h5 class="col-6 text-end" id="valorUsd"></h5>
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
                    <label for="inputText" class="col-12 col-form-label mx-auto text-center"><strong>Tipo de Pago</strong></label>
                    <div class="input-group">
                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Selecicone un tipo de pago"><i class="bi bi-credit-card"></i></button>
                        <select  class="form-select" id="tipoP">
                            <option selected disabled>Tipo</option>
                            <option value="4">Pago Movil</option>
                            <option value="5">Transferencia</option>
                        </select>
                    </div>
                    <p class="m-0" id="errorTipoP" style="color:#ff0000;text-align: center;"></p>
                </div>
                <div class="row form-group col-md-12">
                    <div class="col-xl-6 col-md-12">
                        <label for="inputText" class="col-12 col-form-label "><strong>Nombre de Banco</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Selecicone un banco"><i class="bi bi-bank"></i></button>
                            <select  class="form-select" id="bancTipo">
                                <option selected disabled>Nombre</option>
                            </select>
                        </div>
                        <p class="m-0" id="errorBancTipo" style="color:#ff0000;text-align: center;"></p>
                    </div>
                    <div class="col-xl-6 col-md-12 trans">
                        <label for="inputText" class="col-12 col-form-label"><strong>Cedula/Rif</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Numero de Documento de la Cuenta."><i class="bi bi-card-text"></i></button>
                            <input type="text" class="form-control" disabled id="cedBanc">
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12 movil">
                        <label for="inputText" class="col-12 col-form-label"><strong>Cedula/Rif</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Numero de Documento de la Cuenta."><i class="bi bi-card-text"></i></button>
                            <input type="text" class="form-control" disabled  id="cedBancM">
                        </div>
                    </div>
                </div>
                <div class="row form-group col-md-12 movil">
                    <div class="col-xl-6 col-md-12">
                        <label for="inputText" class="col-12 col-form-label"><strong>Telefono</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Numero de Telefono Para Pago Movil"><i class="bi bi-telephone"></i></button> 
                            <input type="text" id="teleMovil" disabled class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <label for="inputText" class="col-12 col-form-label"><strong>Codigo del Banco</strong></label>
                        <div class="input-group">
                            <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Codigo para del Banco"><i class="ri-hashtag"></i></button> 
                            <input type="text" id="codBanc" disabled class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row form-group col-md-12 trans">
                    <label for="inputText" class="col-12 col-form-label"><strong>Numero de Cuenta</strong></label>
                    <div class="input-group">
                        <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Numero de Banco para Depositar"><i class="ri-hashtag"></i></button> 
                        <input type="text" id="numCuen" disabled class="form-control">
                    </div>
                </div>
                <p class="nota col-11 mx-auto small mt-2">*Al momento de realizar el registro de los datos, el banco seleccionado en esta sección facilitará la verificación del depósito realizado.</p>
            </form>
        </div>

    </div>


  </main>

    <!-- Modal Direcciones Recientes -->
    <div class="modal fade" id="modalDialogScrollable" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Direcciones Frecuentes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body listDirec">
                <div class="col-12 p-2 cuadro d-flex mb-2" id="1">
                    <div class="col-2 text-center">
                        <button class="iconDirec btn btn-success m-1">
                            <i class="bi bi-signpost-split"></i>
                        </button>
                    </div>
                    <div class="col-10">
                        <h5><strong>Direccion Fija</strong></h5>
                        <p class="m-0 text-truncate">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsam consequuntur natus perspiciatis beatae consectetur dignissimos! Aperiam architecto labore alias commodi ipsa non expedita ipsam cumque. Et deleniti perferendis minus iure?</p>
                    </div>
                </div>
                <div class="col-12 p-2 cuadro d-flex mb-2" id="2">
                    <div class="col-2 text-center">
                        <button class="iconDirec btn btn-success m-1">
                            <i class="bi bi-signpost-split"></i>
                        </button>
                    </div>
                    <div class="col-10">
                        <h5><strong>Direccion Fija</strong></h5>
                        <p class="m-0 text-truncate">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis porro, totam accusamus adipisci deserunt itaque sit magnam blanditiis est quam. Alias illum nisi veniam tempora suscipit quasi eius temporibus laudantium?</p>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <!-- Fin Modal -->

  

  <?php $VarComp->js();?>   
  <script src="assets/js/pagoTab.js"></script>



</body>

</html>