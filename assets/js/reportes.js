$(document).ready(function(){

	fechaHoy($('#fecha'), $('#fecha2'));

	let tabla, tipo, fechaInicio, fechaFinal;

	let click = 0;
	setInterval(()=>{ click = 0 }, 3000);

	$('#generar').click(function(){
		if(click >= 1) throw new Error('Spam de clicks');

		generarReporte();

		click++;
	});

	$('#exportar').click(function(){
		if(click >= 1) throw new Error('Spam de clicks');

		exportarReporte();

		click++;
	})


	function generarReporte(){

		tipo = $('#tipoReporte').val();
		fechaInicio = $('#fecha').val();
		fechaFinal = $('#fecha2').val();

		if($('#reporteLista tbody tr').length >= 1){
			tabla.destroy();
		}

		if(tipo == "" || tipo == null){
			$('#error').text('Seleccione un tipo de reporte.');
			throw new Error('Seleccione un tipo de reporte.');
		}else{$('#error').text('')}

		let thead, columns;

		switch(tipo){
			case 'venta' : 
			thead = `<tr>
						<th scope="col">Factura N°</th>
						<th scope="col">Cédula</th>
						<th scope="col">Cliente</th>
						<th scope="col">Fecha</th>
						<th scope="col">Total divisa</th>
						<th scope="col">Total Bs</th>
					 </tr>`;
			$('#reporteLista thead').html(thead);
			columns = [{data : 'num_fact'},
					   {data : 'cedula'},
					   {data: 'nombre'},
					   {data : 'fecha'},
					   {data : 'total_divisa'},
					   {data : 'monto'}];
			break;

			case 'compra' : 	
			thead = `<tr>
						<th scope="col">Orden de Compra</th>
						<th scope="col">Proveedor</th>
						<th scope="col">Fecha</th>
						<th scope="col">Cantidad de Productos</th>
						<th scope="col">Total divisa</th>
						<th scope="col">Total Bs</th>
					 </tr>`;
			$('#reporteLista thead').html(thead);	
			columns = [{data : 'orden_compra'},
					   {data : 'razon_social'},
					   {data : 'fecha'},
					   {data : 'cantidad'},
					   {data : 'total_divisa'},
					   {data : 'monto_total'}];
			break;	
			default: $('#error').text('Tipo de reporte inválido.');	 
		}

		$.post('', {mostrar: 'reporte', tipo, fechaInicio, fechaFinal},
			function(data){
				let reporte = JSON.parse(data);
				tabla = $('#reporteLista').DataTable({
							responsive: true,
							data : reporte,
							columns : columns
						});
				$('#reporte').removeClass('d-none');
		});
	}

	function exportarReporte(){
		$.post('',{exportar: 'reporte', tipo, fechaInicio, fechaFinal},function(e){
			data = JSON.parse(e);
			console.log(data);
			if(data.Error == "Reporte vacío."){
				Toast.fire({ icon: 'error', title: 'No se puede exportar un reporte vacío.' });
				throw new Error('Reporte vacío.');
			}
			if(data.respuesta == "Archivo guardado"){
				Toast.fire({ icon: 'success', title: 'Exportado correctamente.' });
				descargarArchivo(data.ruta);
			}else{
				Toast.fire({ icon: 'error', title: 'No se pudo exportar el reporte.' });
			}
		})
	}

	function descargarArchivo(ruta){
		let link=document.createElement('a');
		link.href = ruta;
		link.download = ruta.substr(ruta.lastIndexOf('/') + 1);
		link.click();
	}

})
