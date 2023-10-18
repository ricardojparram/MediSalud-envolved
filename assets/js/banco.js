$(document).ready(function(){

    let mostrar;
    let permisos , editarPermiso , eliminarPermiso, registrarPermiso;

     $.ajax({method: 'POST', url: "", dataType: 'json', data: {getPermisos : "permiso"},
        success(data){ permiso = data; }

      }).then(function(){
        rellenar(true);
        registrarPermiso = (permiso.registrar != 1)? 'disable' : '';
        $('#agregarModal').attr(registrarPermiso, '');
    })

	function rellenar(bitacora = false){
		$.ajax({
			type: "POST",
			url: "",
			dataType: "json",
			data: {mostrar: "Bank" , bitacora},
			success(data){
				let tabla;
				data.forEach(row =>{
                    editarPermiso = (permiso.editar != 1)?  'disable' : '';
                    eliminarPermiso = (permiso.eliminar != 1)? 'disable' : '';
					tabla += `
					<tr>
					<td>${row.nombre}</td>
					<td>${row.cedulaRif}</td>
					<td>${row.des_tipo_pago}</td>
					<td class="d-flex justify-content-center">
					<button type="button" ${editarPermiso} id="${row.id_banco}" class="btn btn-success editar mx-2" data-bs-toggle="modal" data-bs-target="#Editar"><i class="bi bi-pencil"></i></button>
					<button type="button" ${eliminarPermiso} id="${row.id_banco}" class="btn btn-danger borrar mx-2" data-bs-toggle="modal" data-bs-target="#Borrar"><i class="bi bi bi-trash3"></i></button>
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
    
    selecBanco();
    function selecBanco(){
        console.log('HOLA')
        $.ajax({
            type: "POST",
            url: "",
            dataType: "json",
            data: {selectBanco: "selectBanco"},
            success(data){
                let listo = data
                let option = "";
                listo.forEach((row) =>{
                    option += `<option class="${row.codigo}" value="${row.id_banco}">${row.nombre}</option>`;
                }) 
                $('.nombre').each(function(){
                    if(this.children.length == 1){
                        $(this).append(option);
                    }
                })
            }
        })            


    }
    
    selecTipoPago();

    function selecTipoPago(){

    	$.post(``,{ selecTipoPago: 'selecTipoPago'}, function(data){
    		let lista = JSON.parse(data);
    		let option = "";
    		lista.forEach((row) =>{
    			option += `<option value="${row.cod_tipo_pago}">${row.des_tipo_pago}</option>`;
    		}) 
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


        function validarTipoP(input, div){
          return new Promise((resolve, reject) => {
        $.post('',{id : input.val(), validar: "tipoP"}, function(data){
            let mensaje = JSON.parse(data);
            if(mensaje.resultado === "Error de tipoP"){
                div.text(mensaje.error);
                input.attr("style","border-color: red;")
                input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
                return reject(false);
            }else{
                div.text(" ");
                return resolve(true);
            }
        })
      })
    }
    
    function ValidarDatos(dato ,dato1 , dato2, div , id = null){

        return new Promise((resolve, reject) => {
            $.post('',{tipoP : dato.val(), nombre : dato1.val(), cedulaRif : dato2.val(), id ,validarD: "CedulaRif"},
               function(data){
                let mensaje = JSON.parse(data);
                if(mensaje.resultado === "Error Datos"){
                    div.text(mensaje.error);
                    return reject(false);
                }else{
                    div.text(" ");
                    return resolve(true);
                }
            })
        })
    }
      let ValidarT;

      $('#tipoP').change(function(){
       let valid = validarSelect($("#tipoP"),$("#error1"),"Error elige un tipo");
       if (valid){
        validarTipoP($("#tipoP"), $("#error1"))
       }
      })
      $('#nombre').keyup(() =>{ validarStringLong($('#nombre'), $('#error2') , "Nombre invalido"); });
      $('#cedulaRif').keyup(() =>{ validarCedula($('#cedulaRif') , $('#error3') , "Error de Rif") } );
      $('#cuentaBank').keyup(() =>{ validarBanco($('#cuentaBank'), $('#error4') , "Error de codigo banco") });
      $('#codBank').keyup(() =>{ validarCodBank($('#codBank'), $('#error5') , "Error de codigo banco") });
      $('#telefono').keyup(() =>{ validarTelefono($('#telefono'), $('#error6') , "Error de telefono") });

     let click = 0;
     setInterval(() => { click = 0 ;}, 2000);

        $('#registrar').click((e) =>{
            e.preventDefault();

            if(click >=  1) throw new Error('Spam de clicks');

            let tipoP , Nombre , cedulaRif , cuentaBank , codBank , telefono , validar;

            let tPago = $('#tipoP').find('option:selected').text();
            let datos = [];
            validarTipoP($("#tipoP"), $("#error1")).then(()=>{

                switch(tPago){

                    case 'Seleccione una opción':
                    $('#error1').text(" seleccione una opción") 
                    $('#tipoP').attr("style","border-color: red;")
                    $('#tipoP').attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");                         
                    break;

                    case 'Pago movil' || 'Pago Movil' || 'pago movil' || 'pago Movil' || 'pagomovil' :
                // Validar 
                tipoP = validarSelect($('#tipoP'), $('#error1'), "Tipo invalido");
                Nombre = validarStringLong($('#nombre'), $('#error2'), "Nombre invalido");
                cedulaRif = validarCedula($('#cedulaRif'), $('#error3'), 'Error de Rif');
                codBank = validarCodBank($('#codBank'), $('#error5'), "Error de codigo banco");
                telefono = validarTelefono($('#telefono'), $('#error6'), "Error de telefono");
                

                ValidarDatos($("#tipoP"), $('#nombre'), $('#cedulaRif'), $("#error")).then((validar) => {
                  if (tipoP && Nombre && cedulaRif && codBank && telefono && validar) {
                    let pago = $('#tipoP').val();
                    let name = $('#nombre').val();
                    let cRif = $('#cedulaRif').val();
                    let cBank = $('#codBank').val();
                    let cell = $('#telefono').val();
                    datos = [pago, name, cRif, cBank, cell];
                    $.ajax({
                        type: "post",
                        url : "" ,
                        dataType: "json",
                        data: {data : datos , registro : "Registro"},
                        success(data){
                         if(data.resultado === "banco registrado."){
                            mostrar.destroy();
                            rellenar(); 
                            $('#agregarform').trigger('reset'); 
                            $('.cerrar').click(); 
                            Toast.fire({ icon: 'success', title: 'Banco registrado' }) 
                        }
                    }
                })
                } else {
                    e.preventDefault();
                }
            });
                break;

                default: 
                // Validar
                tipoP = validarSelect($('#tipoP'), $('#error1') , "Tipo invalido");
                Nombre = validarStringLong($('#nombre'), $('#error2') , "Nombre invalido");
                cedulaRif = validarCedula($('#cedulaRif'), $('#error3') , 'Error de Rif');
                cuentaBank = validarBanco($('#cuentaBank'), $('#error4') , 'Error de Rif');
                
                ValidarDatos($("#tipoP"), $('#nombre'), $('#cedulaRif'), $("#error")).then((validar) => {
                  if (tipoP && Nombre && cedulaRif && cuentaBank && validar) {
                    let pago = $('#tipoP').val();
                    let name = $('#nombre').val();
                    let cRif = $('#cedulaRif').val();
                    let Banco = $('#cuentaBank').val();
                    datos = [pago, name, cRif, Banco];
                    $.ajax({
                        type: "post",
                        url : "" ,
                        dataType: "json",
                        data: {data : datos , registro : "Registro"},
                        success(data){
                           if(data.resultado === "banco registrado."){
                            mostrar.destroy();
                            rellenar(); 
                            $('#agregarform').trigger('reset'); 
                            $('.cerrar').click(); 
                            Toast.fire({ icon: 'success', title: 'Banco registrado' }) 
                        }
                    }
                })
                } else {
                    e.preventDefault();
                }
            });
                
                break;
            }
        }).catch(()=>{
            $("#error1").text("El tipo pago no está registrado. Seleccione otro. ");
            throw new Error('No exite.');
        })
        click++;
    })

    let id;

    $(document).on("click", '.editar', function(){
        id = this.id;
        let cuentaBancaria = $('.cuentaBancaria');
        let codigoBanco = $('.CodigoBanco');
        let telefono = $('.telefono');

            $.ajax({
                method: "post",
                url: "",
                dataType: "json",
                data: {clickEdit: "editar Banco", id},
                success(data){
                  let tp = data[0].des_tipo_pago;
                  if (tp  == "Pago movil" || tp  == "Pago Movil" || tp == "pago movil" ||tp  == "pago Movil" || tp  == "pagomovil"){
                    cuentaBancaria.css("display", "none");
                    codigoBanco.css("display", "block");
                    telefono.css("display", "block");
                    $("#tipopEdit").val(data[0].tipo_pago);
                    $("#nombreEdit").val(data[0].nombre);
                    $("#cedulaRifEdit").val(data[0].cedulaRif);
                    $("#codBankEdit").val(data[0].CodBanco);
                    $("#telefonoEdit").val(data[0].telefono);
                }else{
                    cuentaBancaria.css("display", "block");
                    codigoBanco.css("display", "none");
                    telefono.css("display", "none");
                    $("#tipopEdit").val(data[0].tipo_pago);
                    $("#nombreEdit").val(data[0].nombre);
                    $("#cedulaRifEdit").val(data[0].cedulaRif);
                    $('#cuentaBankEdit').val(data[0].NumCuenta);
                }
            }
        });
    });
    
    function validarClick(){
        return new Promise((resolve, reject) =>{
            $.ajax({
                type: "POST",
                url: '',
                dataType: "json",
                data: { validarC: "existe", id},
                success(data) {
                if (data.resultado === "Error de banco") {  
                    Toast.fire({ icon: 'error', title: 'Esta banco ya esta anulada' }); // ALERTA 
                    mostrar.destroy();
                    rellenar();
                    $('.cerrar').click();
                    reject();
                }else{
                    resolve();
                }

            }
        })
      })
    }

    $('#tipopEdit').change(function(){
       let valid = validarSelect($("#tipopEdit"),$("#errorEdit1"),"Error elige un tipo");
       if (valid){
        validarTipoP($("#tipopEdit"), $("#errorEdit1"));
       }
      })
      $('#nombreEdit').keyup(() =>{ validarStringLong($('#nombreEdit'), $('#errorEdit2') , "Nombre invalido"); });
      $('#cedulaRifEdit').keyup(() =>{ validarCedula($('#cedulaRifEdit') , $('#errorEdit3') , "Error de Rif") } );
      $('#cuentaBankEdit').keyup(() =>{ validarBanco($('#cuentaBankEdit'), $('#errorEdit4') , "Error de codigo banco") });
      $('#codBankEdit').keyup(() =>{ validarCodBank($('#codBankEdit'), $('#errorEdit5') , "Error de codigo banco") });
      $('#telefonoEdit').keyup(() =>{ validarTelefono($('#telefonoEdit'), $('#errorEdit6') , "Error de telefono") });

 
      $('#editar').click((e) =>{
         e.preventDefault();

         if(click >=  1) throw new Error('Spam de clicks');

         validarClick().then(()=>{

           let tipopEdit , nombreEdit , cedulaRifEdit , cuentaBankEdit , codBankEdit , telefonoEdit , validarE;

           let tPagoEdit = $('#tipopEdit').find('option:selected').text();
           let datos = [];

           switch(tPagoEdit){

            case 'Seleccione una opción':
            $('#errorEdit1').text(" seleccione una opción") 
            $('#tipopEdit').attr("style","border-color: red;")
            $('#tipopEdit').attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");                         
            break;

            case 'Pago movil' || 'Pago Movil' || 'pago movil' || 'pago Movil' || 'pagomovil' :
            // Validar 
            tipopEdit = validarSelect($('#tipopEdit'), $('#errorEdit1'), "Tipo invalido");
            nombreEdit = validarStringLong($('#nombreEdit'), $('#errorEdit2'), "Nombre invalido");
            cedulaRifEdit = validarCedula($('#cedulaRifEdit'), $('#errorEdit3'), 'Error de Rif');
            codBankEdit = validarCodBank($('#codBankEdit'), $('#errorEdit5'), "Error de codigo banco");
            telefonoEdit = validarTelefono($('#telefonoEdit'), $('#errorEdit6'), "Error de telefono");

            ValidarDatos($("#tipopEdit"), $('#nombreEdit'), $('#cedulaRifEdit'), $("#errorEdit"), id).then((validarE) => {
              if (tipopEdit && nombreEdit && cedulaRifEdit && codBankEdit && telefonoEdit && validarE) {
                let pago = $('#tipopEdit').val();
                let name = $('#nombreEdit').val();
                let cRif = $('#cedulaRifEdit').val();
                let cBank = $('#codBankEdit').val();
                let cell = $('#telefonoEdit').val();
                datos = [pago, name, cRif, cBank, cell];
                $.ajax({
                    type: "post",
                    url : "" ,
                    dataType: "json",
                    data: {data : datos , id ,editar : "editar"},
                    success(data){
                     if(data.resultado === "banco editado."){
                        mostrar.destroy();
                        rellenar(); 
                        $('#agregarform').trigger('reset'); 
                        $('.cerrar').click(); 
                        Toast.fire({ icon: 'success', title: 'Banco editado' }) 
                    }
                }
            })
            } else {
                e.preventDefault();
            }
        });
            break;

            default: 
            // Validar
            tipopEdit = validarSelect($('#tipopEdit'), $('#errorEdit1'), "Tipo invalido");
            nombreEdit = validarStringLong($('#nombreEdit'), $('#errorEdit2'), "Nombre invalido");
            cedulaRifEdit = validarCedula($('#cedulaRifEdit'), $('#errorEdit3'), 'Error de Rif');
            cuentaBankEdit = validarBanco($('#cuentaBankEdit'), $('#errorEdit4') , 'Error de Rif');
            ValidarDatos($("#tipopEdit"), $('#nombreEdit'), $('#cedulaRifEdit'), $("#errorEdit"), id).then((validarE) => {
              if (tipopEdit && nombreEdit && cedulaRifEdit && cuentaBankEdit && validarE) {
                let pago = $('#tipopEdit').val();
                let name = $('#nombreEdit').val();
                let cRif = $('#cedulaRifEdit').val();
                let Banco = $('#cuentaBankEdit').val();
                datos = [pago, name, cRif, Banco];
                $.ajax({
                    type: "post",
                    url : "" ,
                    dataType: "json",
                    data: {data : datos , id ,editar : "editar"},
                    success(data){
                       if(data.resultado === "banco editado."){
                        mostrar.destroy();
                        rellenar(); 
                        $('#agregarform').trigger('reset'); 
                        $('.cerrar').click(); 
                        Toast.fire({ icon: 'success', title: 'Banco Editado' }) 
                    }
                }
            })
           
            } else {
                e.preventDefault();
            }
        });
            
            break;
        }

      

    }).catch(() =>{
       throw new Error('No exite.');
   })

    click++;

 })

    $(document).on('click', '.borrar', function(){
        id = this.id;

    })   
    
    $('#delete').click((e)=>{
       e.preventDefault();

       if(click >=  1) throw new Error('Spam de clicks');

       validarClick().then(()=>{

        $.ajax({
            type: "POST",
            url: "",
            dataType: "json",
            data: {eliminar: "eliminar Banco" , id},
            success(data){
                if (data.resultado === "Eliminado") {
                mostrar.destroy();
                rellenar();
                $('.cerrar').click();
                Toast.fire({ icon: 'success', title: 'Banco eliminada' }); // ALERTA 
                }
           }
       })

    }).catch(()=>{

        throw new Error('No exite.');

    })

    click++;
})

})