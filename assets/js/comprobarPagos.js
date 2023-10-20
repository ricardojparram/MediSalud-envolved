$(document).ready(function(){

	let mostrar
	// let permisos, editarPermiso, eliminarPermiso;
	// $.ajax({method: 'POST', url: "", dataType: 'json', data: {getPermisos:''},
	// 	success(data){ permisos = data; }
	// }).then(() => rellenar(true));
	rellenar(true);

	const estados = {
		"1" : `<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#comprobacion">Aprobado</button>`,
		"2" : `<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#comprobacion">En espera</button>`,
		"3" : `<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#comprobacion">Negado</button>`
 	}

	function rellenar(bitacora = false){ 
        $.ajax({ type: "post", url: "", dataType: "json", data: {mostrar: "", bitacora},
            success(data){
            	console.log(data);
                let tabla;
                // editarPermiso = (typeof permisos.Editar === 'undefined') ? 'disabled' : '';
                // eliminarPermiso = (typeof permisos.Eliminar === 'undefined') ? 'disabled' : '';
                data.forEach(row => {
                    tabla += `
                        <tr>
	                        <td scope="row">${row.num_fact}</td>
	                        <td >${row.cedula}</td>
	                        <td >${row.nombre_cliente}</td>
	                        <td class="d-flex justify-content-center">${estados[2]}</td>
                        </tr>`;
                });
                $('#tablaPagos tbody').html(tabla);
                mostrar = $('#tablaPagos').DataTable({
                    resposive: true
                });
            },
            error(e){
                Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
                throw new Error('Error al mostrar listado: '+e);
            }
        })

    }

})