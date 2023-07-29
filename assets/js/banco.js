$(document).ready(function(){

	rellenar(true);
	let mostrar;
	function rellenar(){
		$.ajax({
			type: "POST",
			url: "",
			dataType: "json",
			data: {mostrar: "Bank"},
			success(data){
				let tabla;
				data.forEach(row =>{
					tabla += `
					<tr>
					<td>${row.nombre}</td>
					<td>${row.cedulaRif}</td>
					<td>${row.des_tipo_pago}</td>
					<td class="d-flex justify-content-center">
					<button type="button" id="${row.id_banco}" class="btn btn-success editar mx-2" data-bs-toggle="modal" data-bs-target="#editar"><i class="bi bi-pencil"></i></button>
					<button type="button" id="${row.id_banco}" class="btn btn-danger eliminar mx-2" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="bi bi bi-trash3"></i></button>
					</td>
					</tr>
					`;
				})
				$('#tabla #tbody').html(tabla);
				mostrar = $('#tabla').DataTable({
					responsive: true
				})


			}
		})
	}
    
    selecTipoPago();

    function selecTipoPago(){

    	$.post(``,{ selecTipoPago: 'selecTipoPago'}, function(data){
    		let lista = JSON.parse(data);
    		console.log(lista);
    		let option = "";
    		lista.forEach((row) =>{
    			option += `<option value="${row.cod_tipo_pago}">${row.des_tipo_pago}</option>`;
    		}) 
            console.log(option);
    		$('.tipoP').each(function(){
    			if(this.children.length == 1){
    				$(this).append(option);
    			}
    		})

    	})

    }

    OcultarDiv();
    function OcultarDiv(){
    	$('.tipoP').change(function() {
    		let selectedOption = $(this).find('option:selected').text();
    		if (selectedOption == "Pago movil" || selectedOption == "Pago Movil" || selectedOption == "pago movil" || selectedOption ==
             "pago Movil" || selectedOption == "pagomovil") {
    			$('.cuentaBancaria').css("display", "none");
    			$('.CodigoBanco').css("display", "block");
    			$('.telefono').css("display", "block");
    		} else {
    			$('.cuentaBancaria').css("display", "block");
    			$('.CodigoBanco').css("display", "none");
    			$('.telefono').css("display", "none");
    		}
    	});
    }  

      $('#tipoP').change(function(){
        validarSelect($("#tipoP"),$("#error1"),"Error elige un tipo");
      })
      $('#nombre').keyup(() =>{ validarNombre($('#nombre'), $('#error2') , "Nombre invalido"); });
      $('#cedulaRif').keyup(() =>{ let valid = validarCedula($('#cedulaRif') , $('#error3') , "Error de Rif") } );
      $('#cuentaBank').keyup(() =>{ validarCodBank($('#cuentaBank'), $('#error4') , "Error de codigo banco") });
      $('#codBank').keyup(() =>{ validarCodBank($('#codBank'), $('#error5') , "Error de codigo banco") });
      $('#telefono').keyup(() =>{ validarTelefonoOp($('#telefono'), $('#error6') , "Error de telefono") });

     let click = 0;
     setInterval(() => { click = 0 ;}, 2000);

    $('#registrar').click((e) =>{
        e.preventDefault();

        if(click >=  1) throw new Error('Spam de clicks');

        let tipoP , Nombre , cedulaRif , cuentaBank , codBank , telefono;
        
        validarSelect($('#tipoP'), $('#error1') , "Tipo invalido");
        validarNombre($('#nombre'), $('#error2') , "Nombre invalido");
        validarCedula($('#cedulaRif'), $('#error3') , 'Error de Rif');
        validarBanco($('#cuentaBank'), $('#error4') , 'Error de Rif')
        validarCodBank($('#codBank'), $('#error5') , "Error de codigo banco");
        validarTelefonoOp($('#telefono'), $('#error6') , "Error de telefono");

    })


})