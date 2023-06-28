$(document).ready(function(){

	refrescar();
	let tabla;
	function refrescar(){ 
		$.ajax({
			method: "post",
			url: "",
			dataType: "json",
			data: {mostrar: "user" },
			success(data){
				console.log(data)
				tabla = $("#tabla").DataTable({
					responsive: true,
					data: data
				});
			}
		})
	}


	$("#cedula").keyup(()=> {  let valid = validarCedula($("#cedula"),$("#error") ,"Error de cédula,") 
		if(valid == true){
			validarC();
		}
	});
	$("#name").keyup(()=> {  validarNombre($("#name"),$("#error") ,"Error de Nombre,") });
	$("#apellido").keyup(()=> {  validarNombre($("#apellido"),$("#error") ,"Error de Apellido,") });
	$("#email").keyup(()=> {  let valid = validarCorreo($("#email"),$("#error") , "Error de correo,")
		if(valid == true){
			validarE();
		}
	});
	$("#password").keyup(()=> {  validarContraseña($("#password"),$("#error") ,"Error de Contraseña,") });

	$("#enviar").click((e)=>{
		e.preventDefault();
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
				e.preventDefault();

				let tipo, contra, correo, lastName, nombre, dni;
				tipo = validarNumero($("#select"),$("#error") ,"Error de Nivel,") ;
				contra = validarContraseña($("#password"),$("#error") ,"Error de Contraseña,");
				validarCorreo($("#email"),$("#error") ,"Error de Correo,") ;
				lastName = validarNombre($("#apellido"),$("#error") ,"Error de Apellido,") ;
				nombre = validarNombre($("#name"),$("#error") ,"Error de Nombre,") ;
				validarCedula($("#cedula"),$("#error") ,"Error de Cedula,") ;


				if(result.resultado === "Error de cedula"){
					$("#error").text(result.error);
					$("#cedula").attr("style","border-color: red;");
					$("#cedula").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
				}else{
					dni = true;
				}
				if(result.resultado === "Error de email"){
					$("#error").text(result.error);
					$("#email").attr("style","border-color: red;");
					$("#email").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
				}else{
					correo = true;
				}

				if (result.resultado === 'Registrado correctamente.') {
					tabla.destroy();
					$("#cerrarRegis").click();
					Toast.fire({ icon: 'success', title: 'Cliente Registrado' })
					refrescar();
				}else{
					e.preventDefault();
				}
			}
		})
	})


	let cedulaDel;
	$(document).on('click', '.eliminar', function() {
		cedulaDel = this.id;
	});
		$("#delete").click(() =>{
			$.ajax({
				type: "POST",
				url: '',
				dataType: 'json',
				data: {eliminar: 'eliminar',
				cedulaDel
			},
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

		$("#cedulaEdit").keyup(()=> {  validarCedula($("#cedulaEdit"),$("#error2") ,"Error de Cedula,") });
		$("#nameEdit").keyup(()=> {  validarNombre($("#nameEdit"),$("#error2") ,"Error de Nombre,") });
		$("#apellidoEdit").keyup(()=> {  validarNombre($("#apellidoEdit"),$("#error2") ,"Error de Apellido,") });
		$("#emailEdit").keyup(()=> {  validarCorreo($("#emailEdit"),$("#error2") ,"Error de Correo,") });
		$("#passwordEdit").keyup(()=> {  validarContraseña($("#passwordEdit"),$("#error2") ,"Error de Contraseña,") });

		$("#enviarEdit").click((e)=>{
			e.preventDefault();
			let tipo = validarNumero($("#selectEdit"),$("#error2") ,"Error de Nivel,") ;
			let contra = validarContraseña($("#passwordEdit"),$("#error2") ,"Error de Contraseña,");
			let correo = validarCorreo($("#emailEdit"),$("#error2") ,"Error de Correo,") ;
			let lastName = validarNombre($("#apellidoEdit"),$("#error2") ,"Error de Apellido,") ;
			let nombre = validarNombre($("#nameEdit"),$("#error2") ,"Error de Nombre,") ;
			let dni = validarCedula($("#cedulaEdit"),$("#error2") ,"Error de Cedula,") ;

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
					console.log(edit);
					e.preventDefault();
					if (edit.resultado === "Editado") {
						tabla.destroy();
						$("#cerrarRegisEdit").click();
						Toast.fire({ icon: 'success', title: 'Cliente Actualizado' })
						refrescar();
					}
					else{
						e.preventDefault();
					}
				}
			})
		})
	})

	function validarC(){
		$.getJSON('',{cedula: $("#cedula").val(),validar: 'lalo'},
			function(data){
				if(data.resultado === "Error de cedula"){
					$("#error").text(data.error);
					$("#cedula").attr("style","border-color: red;")
					$("#cedula").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
				}
			}
		)
	}

	function validarE(){
		$.getJSON('',{email: $("#email").val(),validar: 'lalo'},
			function(data){
				if(data.resultado === "Error de email"){
					$("#error").text(data.error);
					$("#email").attr("style","border-color: red;")
					$("#email").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
				}
			}
		)
	}
}) 