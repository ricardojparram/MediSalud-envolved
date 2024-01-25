$(document).ready(function(){

		let mostrar;
	    let permiso , editarPermiso , eliminarPermiso, registrarPermiso;

	     $.ajax({method: 'POST', url: "", dataType: 'json', data: {getPermisos : "permiso"},
	        success(data){ permiso = data; }

	      }).then(function(){
	        rellenar(true);
	        registrarPermiso = (permiso.registrar != 1)? 'disable' : '';
	        $('.agregarModal').attr(registrarPermiso, '');
	    })

			function rellenar(bitacora = false){
			$.ajax({
				type: "post",
				url: "",
				dataType: "json",
				data: {mostrar: "labs" , bitacora},
				success(data){
			      let tabla;
			      data.forEach(row =>{
			          editarPermiso = (permiso.editar != 1)?  'disable' : '';
			          eliminarPermiso = (permiso.eliminar != 1)? 'disable' : '';

			        tabla += `
			        <tr>
			        <td>${row.des_clase}</td>
			        <td class="d-flex justify-content-center">
			        <button type="button" ${editarPermiso} id="${row.cod_clase}" class="btn btn-success editar mx-2" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil"></i></button>
			        <button type="button" ${eliminarPermiso} id="${row.cod_clase}" class="btn btn-danger borrar mx-2" data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi bi-trash3"></i></button>
			        </td>
			        </tr>
			        `;
			      })
			       $('#tbody').html(tabla);
			        mostrar = $('#tabla').DataTable({
			          resposive : true
			        })
				}
			})
		}


	$("#clase").keyup(()=> {  validarNombre($("#clase"),$("#error"), "Error de clase,") });
	let vclase
	$("#enviar").click((e)=>{
		e.preventDefault();
		vclase = validarNombre($("#clase"),$("#error") , "Error de clase,");
		if (vclase){
		$.ajax({
			type: "post",
			url: '',
			dataType: 'json',
			data: {
				clase: $("#clase").val()
			},
			success(data){
				if (vclase) {
					mostrar.destroy(); 
					rellenar();  
				  	$('#close').click(); 
				    Toast.fire({ icon: 'success', title: 'Clase registrada' }) 
				}
			}
		})
	}
	})

	$("#cerrarRegist").click(()=>{
 	$("#basicModal input").attr("style","borde-color:none; backgraund-image: none;");
 	$("#error").text("");
 })

	let id
	$(document).on('click', '.borrar', function() {
    	id = this.id;
    });
    	$('#borrar').click((e)=>{
        e.preventDefault();

    		$.ajax({
    			type : 'post',
    			url : '',
    			dataType: 'json',
    			data : {borrar : 'asd', id},
    			success(data){
    				mostrar.destroy();
    				$('#cerrar').click();
    				rellenar();
    				Toast.fire({ icon: 'error', title: 'Clase eliminada' })
    			}
    		})
    	})


    /* --- EDITAR --- */
	let idedit;
    // SELECCIONA ITEM
    $(document).on('click', '.editar', function() {
        idedit = this.id; // se obtiene el id del botón, previamente le puse de id el codigo en rellenar()
        
       	// RELLENA LOS INPUTS
       		$.ajax({
       			method: "post",
       			url: "",
       			dataType: "json",
		        data: {item: "lol", idedit}, // id : id
		        success(data){
		        	$("#claseEdit").val(data[0].des_clase);
		        }

		    })

	});

	$("#claseEdit").keyup(()=> {  validarNombre($("#claseEdit"),$("#error2"), "Error de clase,") });
	let eclase
	$("#enviarEdit").click((e)=>{
     e.preventDefault();
		eclase = validarNombre($("#claseEdit"),$("#error2") , "Error de clase,");
		if(eclase){
		$.ajax({
			type: "post",
			url: '',
			dataType: 'json',
			data: {
				claseEdit: $("#claseEdit").val(),idedit
			},
			success(data){
				if (eclase) {
					mostrar.destroy(); 
					rellenar();  
				  	$('#closeEdit').click(); 
				    Toast.fire({ icon: 'success', title: 'Clase actualizada' }) 
				}
			}
		})
	}
	})
    



})