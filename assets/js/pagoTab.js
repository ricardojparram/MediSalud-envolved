
function scroll_to_class(element_class, removed_height) {
	var scroll_to = $(element_class).offset().top - removed_height;
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 0);
	}
}

function bar_progress(progress_line_object, direction) {
	var number_of_steps = progress_line_object.data('number-of-steps');
	var now_value = progress_line_object.data('now-value');
	var new_value = 0;
	if(direction == 'right') {
		new_value = now_value + ( 100 / number_of_steps );
	}
	else if(direction == 'left') {
		new_value = now_value - ( 100 / number_of_steps );
	}
	progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

$(document).ready(function() {
	var data 
	var next_step = false;
	let tipo
	let select
	let memas
	let cambio


	DatosP();
	precio();
	empresaEnvio();
	selectTipoPago();
	banco();


	// Datos Personales
	function DatosP() {
		$.ajax({
			type: "post",
            url: "",
            dataType: "json",
            data:{datos: 'xd'},
            success(data) {
				memas = data;
				
				$("#nomClien").val(data[0].nombre+' '+data[0].apellido);
				$("#cedClien").val(data[0].cedula);
				$("#emailClien").val(data[0].correo);
				$("#teleClien").val(data[0].celular);
				$("#direcClien").val(data[0].direccion);
			}
		});
	}
	
	function imprimirMemas() {
  		console.log(memas[0].nombre); // Imprime los datos cuando se hayan asignado a memas
	}


	
	
	

	// Precio y Cambio
	function precio(){
		let impuesto
		let total
		$.ajax({
			type: "post",
            url: "",
            dataType: "json",
			data:{mostrarP: "hola"},
			success(pre){
				let precioUsd
				cambio = pre[0].id_cambio
				if (pre[0].cuenta > 0) {
					console.log(pre);
					$("#valorBs").html(parseFloat(pre[0].total).toFixed(2)+" Bs");
					impuesto = pre[0].total * 0.16;
					$("#impuesto").html(parseFloat(impuesto).toFixed(2)+" Bs");
					total = pre[0].total + impuesto;
					$("#total").html(parseFloat(total).toFixed(2)+" Bs");
					$("#valorUsd").html(parseFloat(total / pre[0].cambio).toFixed(2)+" $");
					

				} else {
					console.log("nada")
					let div=`
						<div class="col-8 mx-auto text-center">
                    		<h3>Su Carrito Esta Vacio</h3>
                		</div>`;
					$("#precios").html(div);
				}
			}
		})
	}

	// Mostrar Empresa y Sede de Envio

	function empresaEnvio(){
		let selEm
		$.ajax({
			type: "post",
            url: "",
            dataType: "json",
			data:{mostrarE: "empre"},
			success(empre){
				var empresas = empre
				empresas.forEach(row => {
					selEm+=`
					<option value="${row.id_empresa}">${row.nombre}</option>
					`;
				})
				$('#empresa').html('<option selected disabled>Nombre</option>' + selEm);
			}
		});
		

	};
	
	let nomEmpre
		$("#empresa").change(()=> {
			let selEnvi
			nomEmpre = $("#empresa").val();
			
			$.ajax({
				type: "post",
				url: "",
				dataType: "json",
				data:{mostrarS: "empre", nomEmpre},
				success(sed){
					console.log(sed);
					var sede = sed
					sede.forEach(row => {
						selEnvi+=`
						<option value="${row.id_sede}">${row.ubicacion}</option>
						`;
					})
					$('#sede').html('<option selected disabled>Ubicacion</option>' + selEnvi);
				}
			});
		})
	
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form
    */
    $('.f1 fieldset:first').fadeIn('slow');
    

	// Validicaiones Primer Step

	$("#direcClien").keyup(()=> {  validarDireccion($("#direcClien"),$("#errorDirec") ,"Error de Direccion,") });
	$("#emailClien").keyup(()=> {  validarCorreo($("#emailClien"),$("#errorEmail") ,"Error de Correo,") });
	$("#teleClien").keyup(()=> {  validarTelefono($("#teleClien"),$("#errorTele") ,"Error de Telefono,") });


	$("#1").click((e)=>{

		let direccion = validarDireccion($("#direcClien"),$("#errorDirec"), "Error de Direccion,") ;
		let correo = validarCorreo($("#emailClien"),$("#errorEmail"), "Error de Correo,") ;
		let telefono = validarTelefono($("#teleClien"),$("#errorTele"), "Error de Telefono,") ;
		let cedula = validarCedula($("#cedClien"),$("#errorCed"), "Error de Cedula,") ;
	 	let nombre = validarNombre($("#nomClien"),$("#errorNomApe"), "Error de Nombre,") ;

	 	if (nombre && direccion && telefono && cedula && correo) {
	 		next_step = true;
	 	}else{
	 		next_step = false;
	 	}	
	});
	let idGlass
	$(".glass").fadeOut(0);

	$(".botEntre").on('click', function() {
		$("#errorBot").text("");
		idGlass = this.id;
		next_step = false;
		
		switch (idGlass) {
			case "repartidor":
				console.log("deli");
				$(".glass").fadeOut(0);
				$("#delivery").fadeIn(300);
				break;
			case "nacional":
				console.log("perso");
				$(".glass").fadeOut(0);
				$("#envio").fadeIn(300);
				break;
			case "persona":
				console.log("perso");
				$(".glass").fadeOut(0);
				$("#retirar").fadeIn(300);
				break;
		
			default:
				break;
		}
	})

	// Validicaiones Segundo Step


	$("#calle").keyup(()=> {  validarDireccion($("#calle"),$("#errorCalle"), "Error de Calle,") });
	$("#numAv").keyup(()=> {  validarDireccion($("#numAv"),$("#errorNumAv"), "Error de Avenida,") });
	$("#numCasa").keyup(()=> {  validarDireccion($("#numCasa"),$("#errorNumCasa"), "Error de Casa,") });
	$("#ref").keyup(()=> {  validarDireccion($("#ref"),$("#errorRef"), "Error de Referencia,") });
	$("#empresa").change(()=> {  validarSelect($("#empresa"),$("#errorEmpresa"), "Error de Empresa,") });
	$("#sede").change(()=> {  validarSelect($("#sede"),$("#errorSede"), "Error de Sede,") });

	$("#2").click((e)=>{
		let empresa, sede, calle, avenida, numCasa, referencia
		if(typeof idGlass == 'undefined'){
			$("#errorBot").text("Elija una Opcion de Entrega");
		}else{
			$("#errorBot").text("");
		}

		switch (idGlass) {
			case "repartidor":
				calle = validarDireccion($("#calle"),$("#errorCalle"), "Error de Calle,");
				avenida = validarDireccion($("#numAv"),$("#errorNumAv"), "Error de Avenida,");
				numCasa = validarDireccion($("#numCasa"),$("#errorNumCasa"), "Error de Casa,");
				referencia = validarDireccion($("#ref"),$("#errorRef"), "Error de Referencia,");
				
				if (calle && avenida && numCasa && referencia) {
	 				next_step = true;
	 			}else{
	 				next_step = false;
	 			}	
				break;
			case "nacional":
				empresa = validarSelect($("#empresa"),$("#errorEmpresa"), "Error de Empresa,");
				sede = validarSelect($("#sede"),$("#errorSede"), "Error de Sede,");
				if (empresa && sede) {
					next_step = true;
				}else{
					next_step = false;
				}	
				break;
			case "persona":

				next_step = true;
				break;
				
			default:
				next_step = false;
				break;
		}

	});
//////////////////////////////////////////////////////////////////////////////////////////////////////

	fechaHoy($('#fecha'));

	  // fila de tipo pago
	  let newRowTipo = ` <tr>
						  <td width="1%"><a class="removeRowPagoTipo a-asd" ><i class="bi bi-trash-fill"></i></a></td>
						  <td width='30%'> 
							<select class="select-tipo select-asd" name="TipoPago">
							  <option></option>
							</select>
						  </td>
						  <td width='15%' class=""><input class="select-asd precio-tipo" type="number" placeholder="0,00"></td>
						</tr>`;
	  
	// Caracteriticas de la fila Tipo Pago
	function filaTipoN(){
		$('#FILL').append(newRowTipo);
		selectTipoPago();
		validarRepetido();
	}
	// Agregar fila para insertar tipo de pago
	$('.newRowPago').on('click',function(e){
		filaTipoN();
	});

		// ELiminar fila Tipo de Pago
	$('body').on('click','.removeRowPagoTipo', function(e){
		$(this).closest('tr').remove();
	});

	let datosTrans, datosMovil

	 //  rellena los select de las filas de tipos
	 function selectTipoPago(){
		$.ajax({
		  url: '',
		  method: 'POST',
		  dataType: 'json',
		  data: {
			selectTipo: "tipo de pago"
		  },
		  success(data){
			let option = ""
			data.forEach((row)=>{
			  option += `<option value="${row.id_tipo_pago}">${row.des_tipo_pago}</option>`
			})
			$('.select-tipo').each(function(){
			   if(this.children.length == 1){
				 $(this).append(option);
				 $(this).chosen({
				  width: '25vw',
				  placeholder_text_single: "Selecciona un tipo de pago",
				  search_contains: true,
				  allow_single_deselect: true,
				  });
			   }
			})
  
		  }
		})
		let move
		$(".select-tipo").on('change', function(){
			move = $(this).val()
			tipoPago(move);
		})
	  }

	  $(".trans, .movil").fadeOut(0);
	  
	  function tipoPago(tipo){
		if (tipo == 4 || tipo == 5){
			let campos
			let resultado
			let muvi 
			$("#fade").fadeIn(400);
			
			$("#fade input").val('');
			$.ajax({
				url: '',
				method: 'POST',
				dataType: 'json',
				data:{
					mostrarT: 'xd', tipo
				},
				success(data){
					console.log(data)
					  data 
					let option = ""
					switch (tipo) {
						case '4':
							option = ""
							data.forEach((row)=>{
								option += `<option value="${row.id_datos_cobro}">${row.nombre}</option>`
							})
							$("#bancTipoM").html("<option selected disabled>Nombre</option>"+option)
							$(".movil").fadeIn(300);
							// $(".trans").fadeOut(0);
							$("#bancTipoM").on('change', function(){
								
								muvi = $("#bancTipoM").val()
								resultado = data.find(item => item.id_datos_cobro == muvi);
								$("#cedBancM").val(resultado.rif_cedula)
								$("#teleMovil").val(resultado.telefono)
								$("#codBanc").val(resultado.codigo)
								datosMovil = resultado.id_datos_cobro
							})
							
							break;
						case '5':
							option = ""
							data.forEach((row)=>{
								option += `<option value="${row.id_datos_cobro}">${row.nombre}</option>`
							})
							$("#bancTipoT").html("<option selected disabled>Nombre</option>"+option)
							$(".trans").fadeIn(300);
							// $(".movil").fadeOut(0);

							$("#bancTipoT").on('change', function(){
								muvi = $("#bancTipoT").val()
								resultado = data.find(item => item.id_datos_cobro == muvi);
								$("#cedBancT").val(resultado.rif_cedula)
								$("#numCuen").val(resultado.num_cuenta)
								datosTrans = resultado.id_datos_cobro
							})
						break;
					
						default:
							break;

					}
				}
			})
		}
	  }

	  function banco() {
		let opu
		$.ajax({
			url: '',
			method: 'POST',
			dataType: 'json',
			data:{
				mostrarB: "xd"
			},success(data){
				data.forEach(row => {
					opu += `<option value="${row.id_banco}">${row.nombre}</option>`;
				})
				$("#bancTipoRT, #bancTipoRM").html("<option selected disabled>Nombre</option>"+opu)
				
			}
		})
	  }

	// Validicaiones Tercer Step

	// function validarRepetido(){
	// 	$(".select-tipo").change(function(){
	// 		let tipo

	// 		$(".select-tipo").each(function () {
	// 			tipo = $(this).val()
	// 			let count = 0;
	// 			console.log('tipo = '+tipo)

	// 			$(".select-tipo").each(function() {
	// 				if(tipo != ''){
	// 					console.log('segundo = '+$(this).val())

	// 					if(tipo == $(this).val()){
	// 						console.log(tipo == $(this).val())
	// 					  count++
	// 					  console.log(count)

	// 					  if(count >=2){
	// 						$(this).closest('tr').attr('style', 'border-color: red;')
	// 						$(this).attr('valid', 'false');
	// 						$('#error3').text('No pueden haber tipos de pago repetidos');

	// 					  }else{
	// 						$(this).attr('valid', 'true');
	// 					  }
	// 					}
	// 				  }
	// 			})
	// 		})
	// 	})
	// }
	
	function validarRepetido(){
		let selects
		$(".select-tipo").change(function(){
			var valores = [];
			let repetidos = false
			selects = $(this)
			
			$('.select-tipo').each(function() {
				// $(this).attr('valid', 'true');
  				var valor = $(this).val(); // Obtén el valor de cada elemento select
  				valores.push(valor); // Agrega el valor al array
				if($(this).val() == 4 && $(this).val() == 4){
					tipoPago($(this).val())
				}
			});
			console.log(valores); // Muestra los valores en la consola

			for (var i = 0; i < valores.length; i++) {
  				var contador = 0;
  
				for (var j = 0; j < valores.length; j++) {
					if (valores[i] === valores[j]) {
					contador++;
					ola();
					}
					
				}
				
			}
			

			console.log(contador);
			function ola() {
				
				if (contador >= 2) {
					selects.closest('tr').attr('style', 'border-color: red;')
					selects.attr('valid', 'false');
					$('#error3').text('No pueden haber tipos de pagos repetidos');
				} else {
					selects.attr('valid', 'true');
					selects.closest('tr').attr('style', 'border-color: none;')
				}
			}
				
				$('.select-tipo').each(function(){
					if($(this).is('[valid="true"]')){
						$(this).closest('tr').attr('style', 'border-color: none;');
					}
				if(!$('.select-tipo').is('[valid="false"]')){
					$('#error3').text('');
				}
				
			})
		})
	}

	// function validarRepetido() {
		
			

	// 			// Escuchar el evento change en cada selector
	// 		$(".select-tipo").on("change", function() {
				
	// 			var valorSeleccionado = $(this).val();
				
	// 			// Verificar que el valor no se repita en otros selectores
	// 			$(".select-tipo").each(function() {
	// 				if ($(this).val() === valorSeleccionado) {
	// 					console.log("El número seleccionado ya está duplicado en otro selector.");

	// 					$(this).closest('tr').attr('style', 'border-color: red;')

    //               		$(this).attr('valid', 'false');
    //               		$('#error3').text('No pueden haber productos repetidos');
	// 					return false; // Detener el bucle each si se encuentra una repetición
	// 				}else{
	// 					$(this).attr('valid', 'true');
	// 					$(this).closest('tr').attr('style', 'border-color: none;')
	// 				}
	// 			});

	// 			$('.select-tipo').each(function(){
	// 				if($(this).is('[valid="true"]')){
	// 				  $(this).closest('tr').attr('style', 'border-color: none;');
	// 				}
					
	// 			  })
	// 			  if(!$('.select-tipo').is('[valid="false"]')){
	// 			   $('#error3').text('');
	// 			 }
				
	// 		});

			
	// }

	$("#tipoP").change(()=> {  validarSelect($("#tipoP"),$("#errorTipoP"), "Error de Tipo,") });
	$("#bancTipo").change(()=> {  validarSelect($("#bancTipo"),$("#errorBancTipo"), "Error de Banco,") });
	let direcE
	

	$("#3").click((e)=>{

		let push = []


		if(idGlass == "repartidor"){
			direcE = $("#calle").val()+" "+$("#numAv").val()+" "+$("#numCasa").val()+" "+$("#ref").val()
		}else{
			direcE = ""
		}



		let tipVal
		$('.select-tipo').each(function(i) {
			tipVal = $(this).closest('tr')
			switch (tipVal.find("select").val()) {
				case "4":
			
					push[i] = {tipo: tipVal.find("select").val(), monto: tipVal.find(".precio-tipo").val(), bancoReceptor: datosMovil, referencia: $("#referenciaMovil").val(), bancoEmisor: $("#bancTipoRM").val(), cambio: cambio};
				break;
				case "5":
	
					push[i] = {tipo: tipVal.find("select").val(), monto: tipVal.find(".precio-tipo").val(), bancoReceptor: datosTrans, referencia: $("#referenciaTrans").val(), bancoEmisor: $("#bancTipoRT").val(), cambio: cambio};
				break;
			
				default:

					push[i] = {tipo: tipVal.find("select").val(), monto: tipVal.find(".precio-tipo").val(), bancoReceptor: null, referencia: null, bancoEmisor: null, cambio: cambio};
					break;
			}
	
			
			
		})
			console.log(push)
		

		$.ajax({
			url: '',
				method: 'POST',
				dataType: 'json',
				data:{
					cedula: memas[0].cedula,
					nombre: memas[0].nombre,
					apellido: memas[0].apellido,
					direccion: $("#direcClien").val(),
					telefono: $("#teleClien").val(),
					correo: $("#emailClien").val(),

					sede: $("#sede").val(),

					direccion: direcE,
					detalles: push
		
		
				},
				success(final){
					console.log(final)
				}
		})


	})







    
    // next step
    $('.f1 .btn-next').on('click', function() {
    	var parent_fieldset = $(this).parents('fieldset');
    	
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    	
    	// fields validation

    	// parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function() {
    	// if( $(this).val() == "" ) {
    	// 	$(this).attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
    	// 	next_step = false;
    	// }
    	// else {
    	// 	$(this).removeClass('input-error');
    	// }
    	// });

    	// fields validation
    	
    	if( next_step ) {
    		parent_fieldset.fadeOut(400, function() {
    			// change icons
    			current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    			// show next step
	    		$(this).next().fadeIn();
	    		// scroll window to beginning of the form
    			scroll_to_class( $('.f1'), 20 );
	    	});
    	}
    	
    });
    
    // previous step
    $('.f1 .btn-previous').on('click', function() {
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    	
    	$(this).parents('fieldset').fadeOut(400, function() {
    		// change icons
    		current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    		// progress bar
    		bar_progress(progress_line, 'left');
    		// show previous step
    		$(this).prev().fadeIn();
    		// scroll window to beginning of the form
			scroll_to_class( $('.f1'), 20 );
    	});
    });
    
    
    
});
