$(document).ready(function(){

	fechaHoy($('#fecha'), $('#fecha2'));

	let tabla, tipo, fechaInicio, fechaFinal, thead, columns, reporte;

	const tipoAcciones = {
		venta : () => {
			thead = `<tr>
						<th scope="col">Factura N°</th>
						<th scope="col">Cédula</th>
						<th scope="col">Cliente</th>
						<th scope="col">Fecha</th>
						<th scope="col">Total divisa</th>
						<th scope="col">Total Bs</th>
					 </tr>`;
			columns = [{data : 'num_fact'}, {data : 'cedula'},
					   {data: 'nombre'}, {data : 'fecha'},
					   {data : 'total_divisa'},{data : 'monto_total'}];
			$('#reporteLista thead').html(thead);
			$('#error').text('')
		},
		compra : () => {
			thead = `<tr>
						<th scope="col">Orden de Compra</th>
						<th scope="col">Proveedor</th>
						<th scope="col">Fecha</th>
						<th scope="col">Cantidad de Productos</th>
						<th scope="col">Total divisa</th>
						<th scope="col">Total Bs</th>
					 </tr>`;
			columns = [{data : 'orden_compra'}, {data : 'razon_social'},
					   {data : 'fecha'}, {data : 'cantidad'},
					   {data : 'total_divisa'}, {data : 'monto_total'}];	
			$('#reporteLista thead').html(thead);	
			$('#error').text('')
		},
		'error' : () => {
			$('#error').text('Seleccione un tipo de reporte.');
			throw new Error('Seleccione un tipo de reporte.');
		}
	}

	let click = 0;
	setInterval(()=>{ click = 0 }, 1000);

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

	$('#exportarEstadistico').click(function(){
		if(click >= 1) throw new Error('Spam de clicks');

		exportarReporteEstadistico();

		click++;
	})

	function generarReporte(){ 

		tipo = $('#tipoReporte').val();
		fechaInicio = $('#fecha').val();
		fechaFinal = $('#fecha2').val();

		if($('#reporteLista tbody tr').length >= 1) tabla.destroy();

		if(!tipoAcciones.hasOwnProperty(tipo)) tipoAcciones.error();
		tipoAcciones[tipo]();

		$.ajax({type: 'post', url:'', dataType: 'json', 
			data :{mostrar: 'reporte', tipo, fechaInicio, fechaFinal},
			success(res){
				reporte = res;
				tabla = $('#reporteLista').DataTable({
							responsive: true,
							data : reporte,
							columns : columns
						});
				$('#reporte').removeClass('d-none');
			},
			error(e){
                Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
                throw new Error('Error al generar reporte: '+e);
            }
        });
	}

	function exportarReporte(){
		if(reporte.length < 1){
			Toast.fire({ icon: 'error', title: 'No se puede exportar un reporte vacío.' });
			throw new Error('Reporte vacío.');
		}

		$.ajax({method:'POST', url:'', dataType : 'json', 
			data:{exportar: 'reporte', tipo, fechaInicio, fechaFinal},
			success(data){
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
			},
			error(e){
                Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
                throw new Error('Error al exportar el reporte: '+e);
            }
		})
	}

	function exportarReporteEstadistico(){
		if(reporte.length < 1){
			Toast.fire({ icon: 'error', title: 'No se puede exportar un reporte vacío.' });
			throw new Error('Reporte vacío.');
		}

		$.ajax({method:'POST', url:'', dataType : 'json', 
			data:{estadistico: 'reporte', tipo, fechaInicio, fechaFinal},
			success(data){
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
			},
			error(e){
                Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
                throw new Error('Error al exportar el reporte: '+e);
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
