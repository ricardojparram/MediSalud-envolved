<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cuentas de banco</title>
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
 	<main class="main" id="main">
 		<div class="pagetitle">
 			<h1>Bancos</h1>
 			<nav>
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item">Gestionar Cuentas de Banco</li>
 				</ol>
 			</nav>
 		</div>

 		<div class="card">
 			<div class="card-body">

 				<div class="row">
 					<div class="col-6">
 						<h5 class="card-title">Bancos</h5>
 					</div>

 					<div class="col-6 text-end mt-3">
 						<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Agregar">Agregar</button>
 					</div>
 				</div>


 				<!-- COMIENZO DE TABLA -->
 				<div class="table-responsive">
 					<table class="table table-bordered table-hover" id="tabla" width="100%" cellspacing="0">
 						<thead>

 							<tr>
 								<th scope="col">Nombre de Banco</th>
 								<th scope="col">Cedula</th>
 								<th scope="col">Tipo de pago</th>
 								<th scope="col">Opciones</th>
 							</tr>
 						</thead>

 						<tbody id="tbody">
    
 						</tbody>
 					</table>
 				</div>
 				<!-- FINAL DE TABLA -->

 			</div>
 		</div>

 	</main>

	<!-- MODAL AGERGAR -->
	<div class="modal fade " id="Agregar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header alert alert-success">
	        <h4 class="modal-title"> <strong>Registrar Banco</strong> </h4>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>

	      <div class="modal-body ">

	        <form id = "agregarform">

	          <div class="form-group col-md-12">  
	            <div class="container-fluid">
	              <div class="row">

	                <div class="form-group col-12">                          
	                  <label class="col-form-label"> <strong>Tipo de Pago</strong> </label>
	                  <div class="input-group">
	                  	<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Seleccione un Tipo de pago "><i class="bi bi-credit-card"></i></button>
	                  	<select class="form-control tipoP" aria-label="Default select example" id="tipoP">
	                  		<option selected disabled>Seleccione una opción</option>

	                  	</select>
	                  </div>
	                  <p class="error" style="color:#ff0000;text-align: center;" id="error1"></p>
	                </div>

	                <div class="form-group col-12">                          
	                  <label class="col-form-label"> <strong>Nombre de banco</strong> </label>
	                  <div class="input-group">
	                    <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el nombre del Banco"><i class="bi bi-bank"></i></button> 
	                    <input class="form-control" id="nombre" placeholder="Nombre">
	                  </div>
	                  <p class="error" style="color:#ff0000;text-align: center;" id="error2"></p>
	                </div>

	                <div class="form-group col-12">                          
	                	<label class="col-form-label"> <strong>Cedula o Rif</strong> </label>
	                	<div class="input-group">
	                		<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la cedula o rif del banco"><i class="bi bi-person-fill"></i></button> 
	                		<input class="form-control" id="cedulaRif" placeholder="Cedula o Rif">
	                	</div>
	                	<p class="error" style="color:#ff0000;text-align: center;" id="error3"></p>
	                </div>

	              </div>
	            </div>
	          </div>


	          <div class="form-group col-md-12">  
	            <div class="container-fluid">
	              <div class="row">

	              	<div class="form-group col-12 cuentaBancaria">                          
	              		<label class="col-form-label"> <strong>Cuenta Bancaria</strong> </label>
	              		<div class="input-group">
	              			<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el número de cuenta del banco"><i class="ri-bank-card-line"></i></button> 
	              			<input class="form-control" id="cuentaBank" required="" placeholder="Cuenta Bancaria">
	              		</div>
	              		<p class="error" style="color:#ff0000;text-align: center;" id="error4"></p>
	              	</div>

	              	<div class="form-group col-12 CodigoBanco" style="display: none;">                          
	              		<label class="col-form-label"> <strong>Codigo de Banco</strong> </label>
	              		<div class="input-group">
	              			<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el codigo de banco"><i class="bi bi-bank2"></i></button> 
	              			<input class="form-control" id="codBank" placeholder="Codigo de Banco">
	              		</div>
	              		<p class="error" style="color:#ff0000;text-align: center;" id="error5"></p>
	              	</div>


	              	<div class="form-group col-12 telefono" style="display: none;">                          
	              		<label class="col-form-label Telefono"> <strong>Telefono</strong> </label>
	              		<div class="input-group">
	              			<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el telefono de banco afiliado"><i class="bi bi-telephone"></i></button> 
	              			<input class="form-control" id="telefono" placeholder="Telefono">
	              		</div>
	              		<p class="error" style="color:#ff0000;text-align: center;" id="error6"></p>
	              	</div>


	              </div>
	            </div>
	          </div>

	        </div>

	        <p style="color:#ff0000;text-align: center;" id="error"><?php echo (isset($respuesta)) ? $respuesta : " "; ?></p>
	        
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary cerrar" data-bs-dismiss="modal">Cancelar</button>
	          <button type="submit" class="btn btn-success " id="registrar">Registrar</button>
	        </div>
	      </form>
	    </div>
	  </div>
	</div>
	<!-- MODAL AGREGAR FINAL -->
    
    <!-- MODAL EDITAR -->
	<div class="modal fade " id="Editar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header alert alert-success">
	        <h4 class="modal-title"> <strong>Editar Banco</strong> </h4>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>

	      <div class="modal-body ">

	        <form id = "agregarform">

	          <div class="form-group col-md-12">  
	            <div class="container-fluid">
	              <div class="row">

	                <div class="form-group col-12">                          
	                  <label class="col-form-label"> <strong>Tipo de Pago</strong> </label>
	                  <div class="input-group">
	                  	<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Seleccione un Tipo de pago "><i class="bi bi-credit-card"></i></button>
	                  	<select class="form-control tipoP" aria-label="Default select example" id="tipopEdit">
	                  		<option selected disabled>Seleccione una opción</option>

	                  	</select>
	                  </div>
	                  <p class="error" style="color:#ff0000;text-align: center;" id="errorEdit1"></p>
	                </div>

	                <div class="form-group col-12">                          
	                  <label class="col-form-label"> <strong>Nombre de banco</strong> </label>
	                  <div class="input-group">
	                    <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el nombre del Banco"><i class="bi bi-bank"></i></button> 
	                    <input class="form-control" id="nombreEdit" placeholder="Nombre">
	                  </div>
	                  <p class="error" style="color:#ff0000;text-align: center;" id="errorEdit2"></p>
	                </div>


	                <div class="form-group col-12">                          
	                	<label class="col-form-label"> <strong>Cedula o Rif</strong> </label>
	                	<div class="input-group">
	                		<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la cedula o rif del banco"><i class="bi bi-person-fill"></i></button> 
	                		<input class="form-control" id="cedulaRifEdit" placeholder="Cedula o Rif">
	                	</div>
	                	<p class="error" style="color:#ff0000;text-align: center;" id="errorEdit3"></p>
	                </div>


	              </div>
	            </div>
	          </div>

          
	          <div class="form-group col-md-12">  
	            <div class="container-fluid">
	              <div class="row">

	              	<div class="form-group col-12 cuentaBancaria">                          
	              		<label class="col-form-label"> <strong>Cuenta Bancaria</strong> </label>
	              		<div class="input-group">
	              			<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el número de cuenta del banco"><i class="ri-bank-card-line"></i></button> 
	              			<input class="form-control" id="cuentaBankEdit" required="" placeholder="Cuenta Bancaria">
	              		</div>
	              		<p class="error" style="color:#ff0000;text-align: center;" id="errorEdit4"></p>
	              	</div>

	              	<div class="form-group col-12 CodigoBanco" style="display: none;">                          
	              		<label class="col-form-label"> <strong>Codigo de Banco</strong> </label>
	              		<div class="input-group">
	              			<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el codigo de banco"><i class="bi bi-bank2"></i></button> 
	              			<input class="form-control" id="codBankEdit" placeholder="Codigo de Banco">
	              		</div>
	              		<p class="error" style="color:#ff0000;text-align: center;" id="errorEdit5"></p>
	              	</div>


	              	<div class="form-group col-12 telefono" style="display: none;">                          
	              		<label class="col-form-label Telefono"> <strong>Telefono</strong> </label>
	              		<div class="input-group">
	              			<button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el telefono de banco afiliado"><i class="bi bi-telephone"></i></button> 
	              			<input class="form-control" id="telefonoEdit" placeholder="Telefono">
	              		</div>
	              		<p class="error" style="color:#ff0000;text-align: center;" id="errorEdit6"></p>
	              	</div>


	              </div>
	            </div>
	          </div>

	        </div>

	        <p style="color:#ff0000;text-align: center;" id="errorEdit"><?php echo (isset($respuesta)) ? $respuesta : " "; ?></p>
	        
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary cerrar" data-bs-dismiss="modal">Cancelar</button>
	          <button type="submit" class="btn btn-success " id="editar">Registrar</button>
	        </div>
	      </form>
	    </div>
	  </div>
	</div>
	<!-- MODAL EDITAR FINAL -->

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

	<!-- Modal DELETE-->

   
 </body>
 <?php $VarComp->js(); ?>
 <script src="assets/js/banco.js"></script>
</html>

