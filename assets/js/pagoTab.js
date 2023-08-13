
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
	var next_step = true;
	let tipo
	let select
	let memas

	DatosP();

	function DatosP() {
		$.ajax({
			type: "post",
            url: "",
            dataType: "json",
            data:{datos: 'xd'},
            success(data) {
				memas = data;
				

				$("#nomClien").val(data[0].nombre);
				$("#apeClien").val(data[0].apellido);
				$("#cedClien").val(data[0].cedula);
				$("#emailClien").val(data[0].correo);
			}
		});
	}
	
	function imprimirMemas() {
  		console.log(memas[0].nombre); // Imprime los datos cuando se hayan asignado a memas
	}



	$("#tipoP").change(() => {
		
		tipo = $("#tipoP").val();
		select = "";
		tipoPago();	
	});

	$("#fade").fadeIn(400);
	$(".trans, .movil").fadeOut(0);
	let cedula
	let resultado
	$("#bancTipo").change(() => {
		cedula = $("#bancTipo").val();
		resultado = data.find(item => item.cedulaRif === cedula);
		console.log(resultado.cedulaRif);
		switch (tipo) {
			case '4':
				$(".trans").fadeOut(0);
				$(".movil").fadeIn(300);
				$("#cedBancM").val(resultado.cedulaRif);
				$("#teleMovil").val(resultado.telefono);
				$("#codBanc").val(resultado.CodBanco);
				break;
			case '5':
				$(".movil").fadeOut(0);
				$(".trans").fadeIn(300);
				$("#cedBanc").val(resultado.cedulaRif);
				$("#numCuen").val(resultado.NumCuenta);
				break;
		
			default: console.log("nada");
				break;
		}	
	});

	function tipoPago() {
		$.ajax({
			type: "post",
            url: "",
            dataType: "json",
			data:{mostrarT: 'xd', tipo},
            success(list) {
				
				data = list
				data.forEach(row => {
					select+=`
					<option value="${row.cedulaRif}">${row.nombre}</option>`;
				})
				$('#bancTipo').html('<option selected disabled>Nombre</option>' + select);
			}
		});
	}

	
	
	
    
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
    
    $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });


	// $("#1").click((e)=>{

	// 	let correo = validarCorreo($("#emailClien"),$("#error1") ,"Error de Correo,") ;
	// 	let cedula = validarCedula($("#cedClien"),$("#error1") ,"Error de Cedula,") ;
	// 	let telefono = validarTelefono($("#teleClien"),$("#error1") ,"Error De Telefono,") ;
	// 	let apellido = validarNombre($("#apeClien"),$("#error1") ,"Error de Apellido,") ;
	// 	let nombre = validarNombre($("#nomClien"),$("#error1") ,"Error de Nombre,") ;

	// 	if (nombre && apellido && telefono && cedula && correo) {
	// 		next_step = true;
	// 	}else{
	// 		next_step = false;
	// 	}
		
	// });

	fechaHoy($('#fecha'));
	let distancia
	let numero
	// $('#canDep').on('keyup', function() {
	// 	console.log("hola")
	// 	numero = $('#canDep').val();

	// 	console.log(numero)
    //     console.log($('#canDep').length)
	// 	if (distancia === 2) {
	// 		let nuevo = numero.slice(0, distancia-2)+","+numero.slice(distancia)

	// 	}
		
	// });

	$("#3").click((e)=>{
		let cantidad = validarVC($("#canDep"),$("#error3"), "Error en la cantidad,");
		let fecha = validarFecha($("#fecha"),$("#error3"), "Error en la fecha,");
		// let referencia = validarVC($("#canDep"),$("#error3"), "Error en la cantidad");
		let nomban = validarString($("#nomBanc"),$("#error3"), "Error de nombre de banco,");
		
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
    
    // submit
    $('.f1').on('submit', function(e) {
    	
    	// fields validation
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function() {
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation
    	
    });
    
    
});
