$(document).ready(function(){

	let tabla;
	//Consulta de Permisos
    let permisos, editarPermiso, eliminarPermiso, registrarPermiso;
    $.ajax({method: 'POST', url: "", dataType: 'json', data: {getPermisos:'a'},
        success(data){ permisos = data; }
    }).then(function(){
      refrescar(true);
    	registrarPermiso = (typeof permisos.Registrar === 'undefined') ? 'disabled' : ''; 
		editarPermiso = (typeof permisos.Editar === 'undefined') ? 'disabled' : '';
        eliminarPermiso = (typeof permisos.Eliminar === 'undefined') ? 'disabled' : '';
    	$('#agregarModalButton').attr(registrarPermiso, '');
    });

	//Rellenar Tabla
	function refrescar(bitacora = false){ 
		$.ajax({
			method: "post",
			url: "",
			dataType: "json",
			data: {mostrar: "user" , bitacora},
			success(data){
				data.forEach(row => {
					tabla+=`
						<tr>
							<td>${row.cedula}</td>
							<td>${row.nombre}</td>
							<td>${row.apellido}</td>
							<td>${row.correo}</td>
							<td>${row.rol} </td>
							<td class="d-flex justify-content-center">
							<button type="button" ${editarPermiso} class="btn btn-success editar mx-2" id="${row.cedula}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil"></i></button>
							<button type="button" ${eliminarPermiso} class="btn btn-danger eliminar mx-2" id="${row.cedula}" data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash3"></i></button>
								</td>
						</tr>`;  
				});
				$('#tbody').html(tabla);
				tabla = $("#tabla").DataTable({
					responsive: true,
				});
			}
		})
	}



	
	$("#name").keyup(()=> {  validarNombre($("#name"),$("#errorNom") ,"Error de Nombre,") });
	$("#apellido").keyup(()=> {  validarNombre($("#apellido"),$("#errorApe") ,"Error de Apellido,") });
	$("#password").keyup(()=> {  validarContraseña($("#password"),$("#errorContra") ,"Error de Contraseña,") });
	$("#select").change(()=> {validarSelect($("#select"),$("#errorNivel") ,"Error de Nivel,")})
	$("#cedula").keyup(()=> {  let valid = validarCedula($("#cedula"),$("#errorCed") ,"Error de cédula,") 
	if(valid){ validarC($("#cedula"),$("#errorCed") ,"Error de cédula,");} });
	$("#email").keyup(()=> {  let valid = validarCorreo($("#email"),$("#errorEmail") , "Error de correo,")
	if(valid){ validarE($("#email"),$("#errorEmail") , "Error de correo,");} });


	$("#enviar").click((e)=>{

		if(typeof permisos.Registrar === 'undefined'){
			Toast.fire({ icon: 'error', title: 'No tienes permisos para esta acción.' });
			throw new Error('Permiso denegado.');
		}

		let tipo, contra, correo, lastName, nombre, dni, vcorreo
		tipo = validarSelect($("#select"),$("#errorNivel") ,"Error de Nivel,") ;
		contra = validarContraseña($("#password"),$("#errorContra") ,"Error de Contraseña,");
		correo = validarCorreo($("#email"),$("#errorEmail") ,"Error de Correo,") ;
		lastName = validarNombre($("#apellido"),$("#errorApe") ,"Error de Apellido,") ;
		nombre = validarNombre($("#name"),$("#errorNom") ,"Error de Nombre,") ;
		dni = validarCedula($("#cedula"),$("#errorCed") ,"Error de Cedula,") ;
		if (dni) {validarC($("#cedula"),$("#errorCed") ,"Error de cédula,").then(()=>{
			if (correo) {validarE($("#email"),$("#errorEmail") , "Error de correo,").then(()=>{
			
				if (tipo && contra && lastName && nombre) {
					$.ajax({
						type:'POST',
						url: '',
						dataType: "json",
						data:{
							cedula: $("#cedula").val(),
							name: $("#name").val(),
							apellido: $("#apellido").val(),
							email: $("#email").val(),
							password: $("#password").val(),
							tipoUsuario: $("#select").val(),
						},
						success(result){
							console.log(result);
							if (result.resultado === 'Registrado correctamente.') {
								tabla.destroy();
								$("#cerrarRegis").click();
								Toast.fire({ icon: 'success', title: 'Cliente Registrado' })
								refrescar();
							}else{
								tabla.destroy();
								$("#error").text(result.resultado+", "+result.error);
								refrescar();
							}
						}
					})
				}
			})}
		})}	
	})


	var cedulaDel;
	$(document).on('click', '.eliminar', function() {
		cedulaDel = this.id;
		
	});

	$("#delete").click(() =>{

		if(typeof permisos.Eliminar === 'undefined'){
			Toast.fire({ icon: 'error', title: 'No tienes permisos para esta acción.' });
			throw new Error('Permiso denegado.');
		}

		validarC(cedulaDel,$("#errorNo") ,"Error de cédula,").then(() => {
			$("#errorDel").html("Error de Cedula, Cedula no Registrada")
		  }).catch(()=>{
			$.ajax({
				type: "POST",
				url: '',
				dataType: 'json',
				data: {eliminar: 'eliminar',
				cedulaDel},
				success(data){
					console.log(data);
					if (data.resultado === "Eliminado") {
						tabla.destroy();
						$("#cerrarModalDel").click();
						Toast.fire({ icon: 'error', title: 'Usuario Eliminado' })
						refrescar();
					}else{
						console.log("No se elimino")
					}
				}
			})
		})
	})
	

	let id
	$(document).on('click', '.editar', function(){
		id = this.id;
	
		$.ajax({
			method: "post",
			url: '',
			dataType: "json",
			data: {select: "user", id},
			success(data){

				$("#cedulaEdit").val(data[0].cedula);
				$("#nameEdit").val(data[0].nombre);
				$("#apellidoEdit").val(data[0].apellido);
				$("#emailEdit").val(data[0].correo);
				$("#selectEdit").val(data[0].nivel);
			}
		})
	})

		$("#cedulaEdit").keyup(()=> {  validarCedula($("#cedulaEdit"),$("#errorCedEdit") ,"Error de Cedula,") });
		$("#nameEdit").keyup(()=> {  validarNombre($("#nameEdit"),$("#errorNomEdit") ,"Error de Nombre,") });
		$("#apellidoEdit").keyup(()=> {  validarNombre($("#apellidoEdit"),$("#errorApeEdit") ,"Error de Apellido,") });
		$("#emailEdit").keyup(()=> {  validarCorreo($("#emailEdit"),$("#errorEmailEdit") ,"Error de Correo,") });
		$("#passwordEdit").keyup(()=> {  validarContraseña($("#passwordEdit"),$("#errorContraEdit") ,"Error de Contraseña,") });
		$("#selectEdit").keyup(()=> {   validarSelect($("#selectEdit"),$("#errorNivelEdit") ,"Error de Nivel,") });

		$("#enviarEdit").click((e)=>{

			if(typeof permisos.Editar === 'undefined'){
				Toast.fire({ icon: 'error', title: 'No tienes permisos para esta acción.' });
				throw new Error('Permiso denegado.');
			}
			
			let tipo = validarSelect($("#selectEdit"),$("#errorNivelEdit") ,"Error de Nivel,") ;
			let contra = validarContraseña($("#passwordEdit"),$("#errorContraEdit") ,"Error de Contraseña,");
			let correo = validarCorreo($("#emailEdit"),$("#errorEmailEdit") ,"Error de Correo,") ;
			let lastName = validarNombre($("#apellidoEdit"),$("#errorApeEdit") ,"Error de Apellido,") ;
			let nombre = validarNombre($("#nameEdit"),$("#errorNomEdit") ,"Error de Nombre,") ;
			let dni = validarCedula($("#cedulaEdit"),$("#errorCedEdit") ,"Error de Cedula,") ;
			if (dni) { validarC($("#cedulaEdit"),$("#errorNo") ,"Error de cédula,").then(() => {
				$("#error2").html("Error de Cedula, Cedula no Registrada")
			  }).catch(()=>{
				if (tipo && contra && correo && lastName && nombre) {
					$.ajax({
						type:'POST',
						url: '',
						dataType: 'json',
						data:{
							cedulaEdit: $("#cedulaEdit").val(),
							nameEdit: $("#nameEdit").val(),
							apellidoEdit: $("#apellidoEdit").val(),
							emailEdit: $("#emailEdit").val(),
							passwordEdit: $("#passwordEdit").val(),
							tipoUsuarioEdit: $("#selectEdit").val(),
							id
							},
							success(edit){
								if (edit.resultado === "Editado") {
									tabla.destroy();
									$("#cerrarRegisEdit").click();
									Toast.fire({ icon: 'success', title: 'Cliente Actualizado' })
									refrescar();
								}else{
									tabla.destroy();
									$("#error2").text(user.resultado+", "+user.error)
									refrescar();
								}
							}
						})
					}
				})	
			}	
		})

		$(document).on('click', '#cerrarRegisEdit', function() {
			$('#editModal p').text(" ");
			$("#editModal input, select").attr("style","border-color: none;")
			$("#editModal input, select").attr("style","backgraund-image: none;");
		})
	
		$(document).on('click', '#cerrarRegis', function() {
			$('#basicModal p').text(" ");
			$("#basicModal input, select").attr("style","border-color: none;")
			$("#basicModal input, select").attr("style","backgraund-image: none;");
		})

		$(document).on('click', '#cerrarModalDel', function() {
			$("#delModal p").text(" ");
		})
	

	function validarC(input, div, mensaje){
		return new Promise((resolve , reject)=>{console.log(input.val());
			$.getJSON('',{cedula: input.val(),validar: 'lola'},
			
				function(data){
					if(data.resultado === "Error de cedula"){
						div.text(mensaje+" "+data.error);
						input.attr("style","border-color: red;")
						input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
						return reject(false);
					}else{
    					div.text("");
    					return resolve(true);
    				}
				}
			)
		})
	}

	function validarE(input, div, mensaje){
		return new Promise((resolve , reject)=>{
			$.getJSON('',{email: input.val(),validar: 'lalo'},
				function(data){
					if(data.resultado === "Error de email"){
						div.text(mensaje+" "+data.error);
						input.attr("style","border-color: red;")
						input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
						return reject(false);
					}else{
						div.text("");
						return resolve(true);
					}
				}
			)
		})
	}
}) 