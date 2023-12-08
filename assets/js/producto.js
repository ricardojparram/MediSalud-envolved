$(document).ready(function(){

    fechaHoy($('#fecha'));

  let tablaMostrar;
  let permiso , eliminarPermiso, registrarPermiso;

  $.ajax({method: 'POST', url: "", dataType: 'json', data: {getPermisos : "permiso"},
    success(data){ permiso = data; }

  }).then(function(){
    rellenar(true);
    registrarPermiso = (permiso.registrar != 1)? 'disable' : '';
    $('#agregarModal').attr(registrarPermiso, '');
  })

       function rellenar(bitacora = false){
         $.ajax({
          method: "POST",
          url: " ",
          dataType: "json",
          data:{mostrar: "produ" , bitacora},
          success(data){
           let tabla;
            data.forEach(row =>{
              editarPermiso = (permiso.editar != 1)?  'disable' : '';
              imagenPermiso = (permiso.imagen != 1)? 'disable' : '';
              eliminarPermiso = (permiso.eliminar != 1)? 'disable' : '';

              tabla += `
              <tr>
              <td>${row.descripcion}</td>
              <td>${row.stock}</td>
              <td>${row.venta}</td>
              <td>${row.des_tipo}</td>
              <td>${row.vencimiento}</td>
              <td class="d-flex justify-content-center">
              <button type="button" ${editarPermiso} id="${row.cod_producto}" class="btn btn-success editar mx-2" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil"></i></button>
              <button type="button" ${imagenPermiso} id="${row.cod_producto}" class="btn btn-success editar mx-2" data-bs-toggle="modal" data-bs-target="#infoImg"> <i class="bi bi-eye icon-24 t" width="20"></i></button>
              <button type="button" ${eliminarPermiso} id="${row.cod_producto}" class="btn btn-danger borrar mx-2"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash3"></i></button>
              
             
              </td>
              </tr>
              `
            })
            $('#tbody').html(tabla);
            tablaMostrar = $('#tableMostrar').DataTable({
              resposive : true
            })
          }
        })
      }


       $('#descripcion').keyup(()=> {validarStringLong($("#descripcion"),$("#error2"),"Error de nombre") });

       $('#codigo').keyup(()=> {validarStringLong($("#codigo"),$("#error2"),"Error de nombre") });

      $('#fecha').change(function(){
      validarFechaHoy($("#fecha"),$("#error3"),"Error de fecha"); 
     })
      $('#composición').keyup(()=> {validarStringLong($("#composición"),$("#error4"),"Error de Composición") });

      $('#posologia').keyup(()=> {validarStringLong($("#posologia"),$("#error5"),"Error de posologia") });

       $('#ubicación').change(function(){
        validarSelect($("#ubicación"),$("#error6"),"Error, elige ubicación");
      })
      $('#laboratorio').change(function(){
        validarSelect($("#laboratorio"),$("#error7"),"Error, elige laboratorio");
      })
      $('#presentación').change(function(){
       validarSelect($("#presentación"),$("#error8"),"Error, elige presentación");
     })
      $('#tipoP').change(function(){
        validarSelect($("#tipoP"),$("#error9"),"Error, elige tipo producto");
      })
      $('#clase').change(function(){
       validarSelect($("#clase"),$("#error10"),"Error, elige clase");
     })
      $('#contraIn').keyup(()=> {validarStringLong($("#contraIn"),$("#error11"),"Error elige ubicación") });
      $('#cantidad').keyup(()=> {validarNumero($("#cantidad"),$("#error12"),"Error de cantidad") });
      $('#precioV').keyup(()=> {validarVC($("#precioV"),$("#error13"),"Error de precio venta") });

      let click = 0;
      setInterval(()=>{click = 0}, 2000);

    /* --- AGREGAR --- */

    $("#boton").click((e)=>{

      if(click >= 1) throw new Error('Spam de clicks');
    

      let descripcion = validarStringLong($("#descripcion"),$("#error2"),"Error de descripcion");
      let fecha = validarFechaHoy($("#fecha"),$("#error3"),"Error de fecha");
      let composición = validarStringLong($("#composición"),$("#error4"),"Error de Composición");
      let posologia = validarStringLong($("#posologia"),$("#error5"),"Error de posologia");
      let ubicación = validarSelect($("#ubicación"),$("#error6"),"Error ubicación");
      let laboratorio = validarSelect($("#laboratorio"),$("#error7"),"Error laboratorio");
      let presentación = validarSelect($("#presentación"),$("#error8"),"Error presentación");
      let tipo = validarSelect($("#tipoP"),$("#error9"),"Error tipo producto");
      let clase = validarSelect($("#clase"),$("#error10"),"Error clase");
      let contraIn = validarStringLong($("#contraIn"),$("#error11"),"Error contraindicaciones");
      let cantidad = validarNumero($("#cantidad"),$("#error12"),"Error de cantidad");
      let precioV = validarVC($("#precioV"),$("#error13"),"Error de precio venta");

      if(descripcion && fecha && composición && posologia && ubicación && laboratorio && presentación && tipo && clase && contraIn  && cantidad && precioV){
        
        $descripcionP = $('#descripcion');
        $fechaVP = $('#fecha');
        $composicionP = $('#composición');
        $posologiaP = $('#posologia');
        $ubicaciónP = $('#ubicación');
        $laboratorioP = $('#laboratorio');
        $presentaciónP = $('#presentación');
        $tipoP = $('#tipoP');
        $clase = $('#clase');
        $contraInP = $('#contraIn');
        $cantidadP = $('#cantidad');
        $precioVenP = $('#precioV');
        $codigo = $('#codigo');


        //  ENVÍO DE DATOS
        $.ajax({
          type: "POST",
          url: '',
          dataType: 'json',
          data: {
            "descripcion" : $descripcionP.val(),
             "codigo" : $codigo.val(),
            "fechaV" : $fechaVP.val(),
            "composicionP" : $composicionP.val(),
            "posologia" : $posologiaP.val(),
            "ubicación" : $ubicaciónP.val(),
            "laboratorio" : $laboratorioP.val(),
            "presentación" : $presentaciónP.val(),
            "tipoP" : $tipoP.val(),
            "clase" : $clase.val(),           
            "contraIn" : $contraInP.val(),
            "cantidad" : $cantidadP.val(),
            "precioV" : $precioVenP.val(),

          },
          success(data){

          tablaMostrar.destroy()
          rellenar();  // FUNCIÓN PARA RELLENAR
          $('#agregarform').trigger('reset'); // LIMPIAR EL FORMULARIO
          $('.cerrar').click();
          fechaHoy($('#fecha'));
          Toast.fire({ icon: 'success', title: 'Producto registrada' });
        }
        
      })
        
      }else{
        e.preventDefault();
      }
      click++;
    });

  /* --- CERRAR REGISTRAR --- */

  $('#cerrar').click(()=>{
     $('#agregarform').trigger('reset'); // LIMPIAR EL FORMULARIO
     $('#basicModal input').attr("style","borden-color:none;","borden-color:none;");
     $('#basicModal select').attr("style","borden-color:none;","borden-color:none;");
     $('.error').text('');
     fechaHoy($('#fecha'));
   })

   /* --- CERRAR MODIFICAR --- */

   $('#Cancelar').click(()=>{
     $('#editModal input').attr("style","borden-color:none;","borden-color:none;");
     $('#editModal select').attr("style","borden-color:none;","borden-color:none;");
     $('#error').text('');
     fechaHoy($('#fecha'));
   })

   /* --- EDITAR --- */ 
   let id;

   $(document).on('click', '.editar', function() {
        id = this.id; // se obtiene el id del botón, previamente le puse de id el codigo en rellenar()
          // RELLENA LOS INPUTS
          $.ajax({
            method: "POST",
            url: "",
            dataType: "json",
            data: {select: "edit", id},
            success(data){
             
              $("#descripcionEd").val(data[0].descripcion);
               $("#codigoEd").val(data[0].codigo);
              $("#fechaEd").val(data[0].vencimiento);
              $("#composicionEd").val(data[0].composicion);
              $("#posologiaEd").val(data[0].posologia); 
              $("#ubicaciónEd").val(data[0].ubicacion);
              $("#laboratorioEd").val(data[0].cod_lab);
              $("#presentaciónEd").val(data[0].cod_pres);
              $("#tipoEd").val(data[0].cod_tipo);
              $("#claseEd").val(data[0].cod_clase);
              $("#contraInEd").val(data[0].contraindicaciones);
              $("#cantidadEd").val(data[0].stock);
              $("#VentaEd").val(data[0].p_venta);
              
            }

          })
      });
      

      $('#descripcionEd').keyup(()=> {validarStringLong($("#descripcionEd"),$("#errorE2"),"Error de descripcion") });
       
       $('#fechaEd').change(function(){
       validarFecha($('#fechaEd'),$("#errorE3"),"Error de fecha");
      })

      $('#composicionEd').keyup(()=> {validarStringLong($("#composicionEd"),$("#errorE4"),"Error de Composición") });
     
      $('#posologiaEd').keyup(()=> {validarStringLong($("#posologiaEd"),$("#errorE5"),"Error de posologia") });
      $('#ubicaciónEd').change(function(){
        validarSelect($("#ubicaciónEd"),$("#errorE6"),"Error ubicación");
      })
      $('#laboratorioEd').change(function(){
        validarSelect($("#laboratorioEd"),$("#errorE7"),"Error laboratorio");
      })
      $('#presentaciónEd').change(function(){
       validarSelect($("#presentaciónEd"),$("#errorE8"),"Error presentación");
     })
      $('#tipoEd').change(function(){
        validarSelect($("#tipoEd"),$("#errorE9"),"Error tipo producto");
      })
      $('#claseEd').change(function(){
       validarSelect($("#claseEd"),$("#errorE10"),"Error clase");
     })
         
      $('#contraInEd').keyup(()=> {validarStringLong($("#contraInEd"),$("#errorE11"),"Error de contraindicaciones") });
      $('#cantidadEd').keyup(()=> {validarNumero($("#cantidadEd"),$("#errorE12"),"Error de cantidad") });
      $('#VentaEd').keyup(()=> {validarVC($("#VentaEd"),$("#errorE13"),"Error de precio venta") });

     
      // FORMULARIO DE EDITAR
    let ID;
        // Mostrar informacion 
        $(document).on('click', '.infoImg', function () {
            ID = this.ID;
            $.ajax({
                method: "post",
                url: "",
                dataType: "json",
                data: { select1: true, ID: ID },
                success(data) {
                    $("#cod_producto").val(data[0].cod_producto);
                    $("#img").val(data[0].img);

                    
                }
            });
        });

      $("#actualizar").click((e)=>{
          //VALIDACIONES
          if(click >= 1) throw new Error('Spam de clicks');
          
          let descripcionE = validarStringLong($("#descripcionEd"),$("#errorE2"),"Error de descripcion");        
          let fechaE = validarFecha($('#fechaEd'),$("#errorE3"),"Error de fecha")
          let composicionE = validarStringLong($("#composicionEd"),$("#errorE4"),"Error de Composición") ;
          let posologiaE = validarStringLong($("#posologiaEd"),$("#errorE5"),"Error de posologia") ;
          let ubicaciónE = validarSelect($("#ubicaciónEd"),$("#errorE6"),"Error ubicación");
          let laboratorioE = validarSelect($("#laboratorioEd"),$("#errorE7"),"Error laboratorio");
          let presentaciónE = validarSelect($("#presentaciónEd"),$("#errorE8"),"Error presentación");
          let tipoE = validarSelect($("#tipoEd"),$("#errorE9"),"Error tipo producto");
          let claseE = validarSelect($("#claseEd"),$("#errorE10"),"Error clase");
          let contraInE = validarStringLong($("#contraInEd"),$("#errorE11"),"Error de contraindicaciones");
          let cantidadE = validarNumero($("#cantidadEd"),$("#errorE12"),"Error de cantidad");
          let VentaE = validarVC($("#VentaEd"),$("#errorE13"),"Error de precio venta");

          if(descripcionE && fechaE && composicionE && posologiaE && ubicaciónE && laboratorioE && presentaciónE && tipoE && claseE  && contraInE && cantidadE && VentaE){

      //  ENVÍO DE DATOS
      $.ajax({
        type: "POST",
        url: '',
        dataType: "json",
        data: {
          
          
          descripcionEd : $('#descripcionEd').val(),
          codigoEd : $('#codigoEd').val(),
          fechaEd : $('#fechaEd').val(),
          composicionEd : $('#composicionEd').val(), 
          posologiaEd: $('#posologiaEd').val(),
          ubicaciónEd : $('#ubicaciónEd').val() ,
          laboratorioEd : $('#laboratorioEd').val() ,
          presentaciónEd : $('#presentaciónEd').val() ,
          tipoEd : $('#tipoEd').val() ,
          claseEd : $('#claseEd').val(),    
          contraInEd : $('#contraInEd').val() ,
          cantidadEd : $('#cantidadEd').val() ,
          VentaEd : $('#VentaEd').val() ,
          id 
        },
        success(data){
         tablaMostrar.destroy();
          rellenar();  // FUNCIÓN PARA RELLENAR
          $('#editarform').trigger('reset');
          $('#Cancelar').click();
          Toast.fire({ icon: 'success', title: 'Producto Actualizado' });
        } 

      }) 

    }else{
      e.preventDefault();
    }
    click++;

  })


    /* --- ELIMINAR --- */


    $(document).on('click','.borrar', function(){
     id = this.id;

   })

    $('#delete').click(()=>{
      if(click >= 1){ throw new Error('Spam de clicks');}
      console.log(id);
      $.ajax({
        type: 'POST',
        url: '',
        data: {delete : 'delete' , id},
        success(data){
          tablaMostrar.destroy();
          rellenar();
          $('.cerrar').click();
          Toast.fire({ icon: 'success', title: 'producto anulado' }) // ALERTA 
        }
      })
      click++;
    })


});