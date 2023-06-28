<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <?php $VarComp->header(); ?>
    <link rel="stylesheet" href="assets/css/estiloInterno.css">
    <link rel="stylesheet" href="assets/css/chosen.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/select2-bootstrap-5-theme.min.css">
    <link rel="stylesheet" href="assets/css/select2-bootstrap-5-theme.rtl.min.css">
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


    <!-- Main -->

    <main id="main" class="main">
     
       <div class="pagetitle">
        <h1>Ventas</h1>
         <nav>
           <ol class="breadcrumb">
            <li class="breadcrumb-item">Ventas</li>
           </ol>
         </nav>
       </div>

           <!-- Card Table-->

           <div class="card">
            <div class="card-body">
              <div class="row">
              <h5 class="card-title col-6 ml-3">Ventas de Productos</h5>

              <div class="text-end col-6 mt-3" >
               <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Agregar">Agregar</button>
              </div>

              </div>
              <!-- Table Inicio-->
              
              <div class="table-responsive">
                <table class="table table-bordered" id="tableMostrar" width="100%" cellspacing="0">
                  <thead>

                    <tr>
                      <th scope="col">Cedula</th>
                      <th scope="col">Productos</th>
                      <th scope="col">Fecha y Hora</th>
                      <th scope="col">Metodo de Pago</th>
                      <th scope="col">Total divisa</th>
                      <th scope="col">Total Bs</th>
                      <th scope="col">Opciones</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th scope="col">Cedula</th>
                      <th scope="col">Productos</th>
                      <th scope="col">Fecha y Hora</th>
                      <th scope="col">Metodo de Pago</th>
                      <th scope="col">Total divisa</th>
                      <th scope="col">Total Bs</th>
                      <th scope="col">Opciones</th>
                    </tr>
                  </tfoot>
                  <tbody id = "tbody">
                    
                  </tbody>
                </table>
              </div>
            

            </div>
          </div>
           
      </div>
    </div>

 </main>
</body>
  
      <!-- Modal AGREGAR -->

    <div class="modal fade" id="Agregar" >
     <div class="modal-dialog modal-dialog-scrollable modal-lg ">
       <div class="modal-content">
         <div class="modal-header alert alert-success">
          <h4 class="modal-title"> <strong>Registrar Nuevo Venta</strong> </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body ">

          <form id = "agregarform">

            <div class="form-group col-md-12">  
              <div class="container-fluid">
                <div class="row">

                  <div class="form-group col-lg-6">                          
                    <label for="inputText" class="col-sm-3 col-form-label"><strong>Cliente</strong></label>
                    <div class="input-group">
                      <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Seleccione una cédula registrada en el sistema."><i class="bi bi-person-fill"></i></button>
                      <select class="form-control select2" placeholder="Cédula" id="cedula">
                        <option value="0" selected disabled>Clientes</option>
                        <?php if(isset($mostrarC)){
                          foreach($mostrarC as $data){
                            ?> 
                            <option value="<?php echo $data->cedula;?>" class="opcion"><?php echo $data->nombre;?> <?php echo $data->apellido;?> <?php echo $data->cedula;?></option>
                            <?php
                          }
                        }else{"";}?>
                      </select> 
                    </div>
                    <p class="error" style="color:#ff0000;text-align: center;" id="error1"></p>
                  </div>

                  <div class="form-group col-lg-6">                          
                    <label for="inputText" class="col-sm-3 col-form-label"><strong>Pago</strong></label>
                    <div class="input-group">
                      <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Seleccione un metodo de pago al sistema."><i class="bi bi-cash-coin"></i></button>
                      <select class="form-select select"  placeholder="Metodo de pago" name="metodo" id="metodo">
                        <option selected disabled>Metodo a pagar</option>
                        <?php if(isset($mostrerM)){
                          foreach($mostrerM as $data){
                            ?> 
                            <option value="<?php echo $data->cod_tipo_pago;?>" class="opcion"><?php echo $data->des_tipo_pago;?></option>
                            <?php
                          }
                        }else{"";}?>
                      </select> 
                    </div>
                    <p class="error" style="color:#ff0000;text-align: center;" id="error2"></p>
                  </div>
                </div>
              </div>
            </div> 
            
            <div class="form-group col-md-12">  
              <div class="container-fluid">
                <div class="row">

                   <div class="form-group col-md-4">                          
                    <label class="col-form-label"> <strong>Moneda</strong> </label>
                    <div class="input-group">
                      <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Evaluara el Total al valor de la moneda Seleccionada"><i class="bi bi-currency-exchange"></i></button> 
                      <select class="form-select select2M" id="moneda">
                        <option selected disabled>Moneda</option>
                      </select>
                    </div>
                    <p class="error" style="color:#ff0000;text-align: center;" id="error5"></p>
                  </div>

                  <div class="form-group col-md-4">  
                    <label class="col-form-label" for="config_iva"><strong>IVA</strong></label>
                    <div class="input-group">
                      <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca un IVA para la venta">%</button> 
                      <input class="form-control iva" type="text" id="config_iva" value="16"/>
                    </div>
                    <p class="error" style="color:#ff0000;text-align: center;" id="error4"></p>
                  </div>


                  <div class="form-group col-md-4">                          
                    <label class="col-form-label"> <strong>Monto</strong> </label>
                    <div class="input-group">
                      <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Monto total de la venta"><i class="bi bi-cash"></i></button> 
                      <input type="number" class="form-control" disabled="disabled" id="monto" >
                    </div>
                    <p class="error" style="color:#ff0000;text-align: center;" id="error3"></p>
                  </div>

                </div>
              </div>
            </div>

            <div class="form-group col-md-12">  
              <div class="container-fluid">
                <div class="row">
                  <div class="table-responsive table-body form-group col-12">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Producto</th>
                          <th>Cantidad</th>
                          <th>Precio</th>
                          <th>IVA</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody id="ASD">
                        <tr>
                          <td width="1%"><a class="removeRow a-asd" href="#"><i class="bi bi-trash-fill"></i></a></td>
                          <td width='30%'> 
                            <select class="select-productos select-asd" name="productos">
                              <option></option>
                            </select>
                          </td>
                          <td width='10%' class="amount"><input class="select-asd stock" type="number" value=""/></td>
                          <td width='10%' class="rate"><input class="select-asd" type="number" disabled value="" /></td>
                          <td width='10%'class="tax"></td>
                          <td width='10%' class="sum"></td>
                        </tr>
                      </tbody>
                    </table>
                    <a class="newRow a-asd" href="#"><i class="bi bi-plus-circle-fill"></i> Nueva fila</a> <br>
                    <div class="text-end">
                      <p class="text-end" id="montos"></p>
                      <p class="text-end" id="montos2"></p>
                      <p class="text-end"id="cambio"></p>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>

          <p class="error" style="color:#ff0000;text-align: center;" id="error"></p>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary cerrar" id="cerrar" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success " id="registrar">Registrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal delete-->

<div class="modal fade" id="Borrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">¿Estás seguro?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Los datos serán anulados del sistema.</h5>
      </div>
      <div class="modal-footer">
        <button id="close" type="button" class="btn btn-secondary cerrar" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="delete">Anular</button>
      </div>
    </div>
  </div>
</div>


<!-- MODAL DE PRODUCTOS -->
<div class="modal fade" id="detalleVenta" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable modal-md">
    <div class="modal-content">
      <div class="modal-header alert alert-success">
        <h5 class="modal-title"><strong id="ventaNombre"></strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
          <thead>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
          </thead>
          <tbody id="bodyDetalle">
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cerrar" data-bs-dismiss="modal" id="cerrarDetalles">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- FINAL MODAL DE PRODUCTOS -->

 
<?php $VarComp->js(); ?>
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/select2.full.min.js"></script>
<script src="assets/js/ventas.js"></script>
</html>

             