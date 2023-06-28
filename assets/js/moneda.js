$(document).ready(function(){
	let tabla2
	mostrar() 

	function mostrar(){
		$.ajax({
			type: "POST",
			url: "",
			dataType: 'json',
			data: {datos: 'Moneda'},
			success(data){
				tabla2 = $('#tabla2').DataTable({
					responsive: true,
					data: data
				});
			}
		})
	}



	let moneda, name;
	$('#moneda').keyup(()=>{ validarNombre($('#moneda'),$('#ms'),"Error de moneda") });
	$('#registrar').click((e)=>{

		e.preventDefault();

		moneda = validarNombre($('#moneda'),$('#ms'),"Error de moneda");

		if(moneda){
			name = $('#moneda').val();

			$.ajax({
				type: 'POST',
				url: '',
				dataType: 'JSON',
				data: {moneda: 'registrar', name},
				success(data){
					tabla2.destroy();
					$('#cerrarR').click();
					mostrar();
					Toast.fire({ icon: 'success', title: 'Moneda registrado'});
				}
			})

		}

	})
	
	let id;

	$(document).on('click','.update', function(){
		id = this.id;

		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'JSON',
			data: {edit: 'Money',id},
			success(data){
				$('#editMon').val(data[0].nombre);
			}
		})
	})

	$('#editMon').keyup(()=>{ validarNombre($('#editMon'),$('#ms2'),"Error de moneda") });

	$('#editar').click((e)=>{
		e.preventDefault();
		let editN = validarNombre($('#editMon'),$('#ms2'),"Error de moneda");

		if(editN){
			nameEdit = $('#editMon').val();

			$.ajax({
				type: 'POST',
				url:'',
				dataType: 'JSON',
				data:{nameEdit,id},
				success(data){
					console.log(data)
					tabla2.destroy();
					$('#cerrarA').click();
					mostrar();
					Toast.fire({ icon: 'success', title: 'Moneda actualizada'});
				}
			})
		}
	})

	$(document).on('click', '.delete', function(){
		id = this.id;
	})

	$('#eliminar').click((e)=>{
		$.ajax({
			type:"POST",
			url:'',
			dataType:'json',
			data:{
				delete:'eliminar',
				id
			},
			success(data){
				console.log(data)
				tabla2.destroy();
				$('#cerrar').click();
				mostrar();
				Toast.fire({ icon: 'success', title: 'Moneda eliminada'});
			}
		})
	})


	let tabla
	rellenar();

	function rellenar(){
		$.ajax({
			type: "POST",
			url: '',
			dataType: 'json',
			data:{mostrar: 'xd'},
			success(angeles){
				tabla = $("#tabla").DataTable({
					responsive: true,
					data: angeles
				});
			}
		})
	}
	
	selectMoneda();

	function selectMoneda(){
		$.ajax({
			type: "POST",
			url: '',
			dataType: 'json',
			data:{select: 'mostrar'},
			success(data){
				let option = "";
				data.forEach((row)=>{
					option += `<option value="${row.id_moneda}">${row.nombre}</option>`;
				})
				$('.selectM').each(function(){
					$(this).append(option);
				})
			}
		})
	}

	let select, vcambio; 

	$("#selectMoneda").change(function(){
		select = validarSelect($("#selectMoneda"),$("#error") ,"Error de Tipo de Moneda,")
	})
	$("#cambio").keyup(()=> {  validarNumero($("#cambio"),$("#error") ,"Error de Valor de Moneda,") });


	$("#enviar").click((e)=>{

		select = validarSelect($("#selectMoneda"),$("#error") ,"Error de Tipo de Moneda,");
		vcambio = validarNumero($("#cambio"),$("#error") ,"Error de Valor de Moneda,");

		if (select && vcambio) {
			$.ajax({

				type:"POST",
				url:"",
				dataType:"json",
				data:{

					cambio: $("#cambio").val(),
					tipo: $("#selectMoneda").val()

				},
				success(data){
					tabla.destroy();
					$("#close").click();
					Toast.fire({ icon: 'success', title: 'Tipo de cambio registrado'})
					rellenar();

				}
			})
		}

	})

	
	$(document).on('click', '.borrar', function(){
		id = this.id;
	})
	$("#delete").click(() =>{
		$.ajax({
			type:"POST",
			url:'',
			dataType:'json',
			data:{
				borrar:'cualquier cosita',
				id
			},
			success(yeli){
				tabla.destroy();
				$("#closeDel").click();
				Toast.fire({icon: 'error', title:'Tipo de moneda eliminado'})
				rellenar();

			}
		})




	})

	let unico;
	$(document).on('click','.editar', function(){
		unico = this.id;

		$.ajax({
			type:"POST",
			url:'',
			dataType:'json',
			data:{
				editar:'noloserick',
				unico
			},
			success(uni){
				$("#monedaEdit").val(uni[0].moneda);
				$("#cambioEdit").val(uni[0].cambio);

			}

		})

	})

	$("#monedaEdit").keyup(()=> {  validarSelect($("#monedaEdit"),$("#error2") ,"Error de Tipo de Moneda,") });
	$("#cambioEdit").keyup(()=> {  validarNumero($("#cambioEdit"),$("#error2") ,"Error de Valor de Moneda,") });

	let etipo, ecambio;  
	$("#enviarEdit").click((e)=>{

		etipo = validarSelect($("#monedaEdit"),$("#error2") ,"Error de Tipo de Moneda,");
		ecambio = validarNumero($("#cambioEdit"),$("#error2") ,"Error de Valor de Moneda,");

		$.ajax({

			type:"POST",
			url:"",
			dataType:"json",
			data:{
				cambioEdit: $("#cambioEdit").val(),
				tipoEdit: $("#monedaEdit").val(),
				unico

			},
			success(data){
				if (etipo == true && ecambio == true) {
					tabla.destroy();
					$("#closeEdit").click();
					Toast.fire({ icon: 'success', title: 'Tipo de cambio registrado'})
					rellenar();
				}else{
					e.preventDefault()
				}

			}
		})



	})






})