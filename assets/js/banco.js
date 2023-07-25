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
    		if (selectedOption == "Pago movil" || "Pago Movil" || "pago movil" || "pago Movil" || "pagomovil") {
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


})