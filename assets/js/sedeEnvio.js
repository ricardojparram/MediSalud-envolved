$(document).ready(function(){

    let mostrar
	let permisos, editarPermiso, eliminarPermiso, registrarPermiso;
	$.ajax({method: 'POST', url: "", dataType: 'json', data: {getPermisos:'a'},
		success(data){ permisos = data; }
	}).then(function(){
		rellenar(true);
    	registrarPermiso = (permisos.registrar != 1) ? 'disabled' : ''; 
    	$('#agregarModalButton').attr(registrarPermiso, '');
	});

    function rellenar(bitacora = false){ 
        $.ajax({
            type: "post",
            url: "",
            dataType: "json",
            data: {mostrar: "", bitacora},
            success(data){
                let tabla;
                data.forEach(row => {
                    editarPermiso = (permisos.editar != 1) ? 'disabled' : '';
                	eliminarPermiso = (permisos.eliminar != 1) ? 'disabled' : '';
                    tabla += `
                        <tr>
                            <td>${row.nombre}</td>
                            <td>${row.ubicacion}</td>
                            <td class="d-flex justify-content-center">
                            	<button type="button" ${editarPermiso} class="btn btn-success editar mx-2" id="${row.id_sede}" data-bs-toggle="modal" data-bs-target="#Editar"><i class="bi bi-pencil"></i></button>
                            	<button type="button" ${eliminarPermiso} class="btn btn-danger borrar mx-2" id="${row.id_sede}" data-bs-toggle="modal" data-bs-target="#Borrar"><i class="bi bi-trash3"></i></button>
                            </td>
                        </tr>`;
                });
                $('#tbody').html(tabla);
                mostrar = $('#tableMostrar').DataTable({
                    resposive: true
                });
            }
        })

    }

    let click = 0;
	setInterval(()=>{ click = 0; }, 2000);


    $("#registrar").click((e)=>{

    	if(permisos.registrar != 1){
    		Toast.fire({ icon: 'error', title: 'No tienes permisos para esta acción.' });
    		throw new Error('Permiso denegado.');
    	}

    	e.preventDefault()

    	if(click >= 1) throw new Error('Spam de clicks');

    	let vselect, vdireccion;
    	vselect = validarSelect($('#empresa_envio'), $('#error1'), 'Empresa de envío,');
    	vdireccion = validarDireccion($('#ubicacion'),$('#error2'), 'Sede de envío,');

    	if(!vselect || !vdireccion){
    		throw new Error('Error.');
    	}

    	$.post('', {validar:'', empresa : $('#empresa_envio').val()},
    		function(response){
    			data = JSON.parse(response);
    			if(data.resultado != true){
    				Toast.fire({ icon: 'error', title: data.msg }); 
    				throw new Error(data.msg);	
    			}
    			$.ajax({
    				type: "post",
    				dataType: "json",
    				url: '',
    				data: {
    					ubicacion : $("#ubicacion").val(),
    					empresa : $("#empresa_envio").val(),
    					registrar : ''
    				},
    				success(data){
    					if(data.resultado){
    						mostrar.destroy(); 
    						rellenar(); 
    						$('#agregarform').trigger('reset'); 
    						$('.cerrar').click(); 
    						Toast.fire({ icon: 'success', title: data.msg }) 
    					}else{
    						Toast.fire({ icon: 'error', title: data.msg }); 
    					}
    				}

    			})
    		})

    	click++;
    })

    let id;
    $(document).on('click', '.editar', function() {
    	id = this.id; 
    	$.ajax({
    		method: "post",
    		url: "",
    		dataType: "json",
		        data: {select: "", id},
		        success(data){
		        	if(data.status){
		        		$('#empresa_envioEdit').val(data.id_empresa);
		        		$('#ubicacionEdit').val(data.ubicacion);
		        	}else{
		        		Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' }); 
		        	}
		        }

		    })

    });

    $('#editar').click((e)=>{
    	if(permisos.editar != 1){
    		Toast.fire({ icon: 'error', title: 'No tienes permisos para esta acción.' });
    		throw new Error('Permiso denegado.');
    	}

    	e.preventDefault()

    	if(click >= 1) throw new Error('Spam de clicks');

    	let vselect, vdireccion;
    	vselect = validarSelect($('#empresa_envioEdit'), $('#error3'), 'Empresa de envío,');
    	vdireccion = validarDireccion($('#ubicacionEdit'),$('#error4'), 'Sede de envío,');

    	if(!vselect || !vdireccion){
    		throw new Error('Error.');
    	}

    	$.post('', {validar:'', empresa : $('#empresa_envioEdit').val()},
    		function(response){
    			data = JSON.parse(response);
    			if(data.resultado != true){
    				Toast.fire({ icon: 'error', title: data.msg }); 
    				throw new Error(data.msg);	
    			}
    			$.ajax({
    				type: "post",
    				dataType: "json",
    				url: '',
    				data: {
    					id,
    					ubicacion : $("#ubicacionEdit").val(),
    					empresa : $("#empresa_envioEdit").val(),
    					editar : ''
    				},
    				success(data){
    					if(data.resultado){
    						mostrar.destroy(); 
    						rellenar(); 
    						$('#editarform').trigger('reset'); 
    						$('.cerrar').click(); 
    						Toast.fire({ icon: 'success', title: data.msg }) 
    					}else{
    						Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.'}); 
    					}
    				}

    			})
    		})
    	click++;
    })

    $(document).on('click', '.borrar', function() {
    	id = this.id; 
    });

    $('#borrar').click(()=>{
    	if(permisos.eliminar != 1){
    		Toast.fire({ icon: 'error', title: 'No tienes permisos para esta acción.' });
    		throw new Error('Permiso denegado.');
    	}

    	if(click >= 1) throw new Error('spaaam');

    	$.ajax({
    		type : 'post',
    		dataType: 'json',
    		url : '',
    		data : {eliminar : '', id},
    		success(data){
    			if(data.resultado){
	    			mostrar.destroy();
	    			$('.cerrar').click();
	    			rellenar();
	    			Toast.fire({ icon: 'success', title: data.msg })
    			}else{
    				mostrar.destroy();
	    			rellenar();
	    			$('.cerrar').click();
    				Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
    			}
    		}
    	})
    	click++;
    })

})
