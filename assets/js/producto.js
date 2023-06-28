$(document).ready(function(){

  fechaHoy($('#fecha'));

   /* --- FUNCIÓN PARA RELLENAR LA TABLA --- */
    let tablaMostrar
    rellenar();
       function rellenar(){
         $.ajax({
          method: "POST",
          url: " ",
          dataType: "json",
          data:{mostrar: "produ"},
          success(data){
            console.log(data);
            tablaMostrar = $('#tableMostrar').DataTable({
              responsive : true, 
              data : data
            });
          }
        })
      }


      $('#descripcion').keyup(()=> {validarStringLong($("#descripcion"),$("#error1"),"Error de descripcion") });
      $('#fecha').change(function(){
      validarFechaHoy($("#fecha"),$("#error2"),"Error de fecha"); 
     })
      $('#composición').keyup(()=> {validarStringLong($("#composición"),$("#error3"),"Error de Composición") });
      $('#posologia').keyup(()=> {validarStringLong($("#posologia"),$("#error4"),"Error de posologia") });
       $('#ubicación').change(function(){
        validarSelect($("#ubicación"),$("#error5"),"Error elige ubicación");
      })
      $('#laboratorio').change(function(){
        validarSelect($("#laboratorio"),$("#error6"),"Error elige laboratorio");
      })
      $('#presentación').change(function(){
       validarSelect($("#presentación"),$("#error7"),"Error elige presentación");
     })
      $('#tipoP').change(function(){
        validarSelect($("#tipoP"),$("#error8"),"Error elige tipo producto");
      })
      $('#clase').change(function(){
       validarSelect($("#clase"),$("#error9"),"Error elige clase");
     })
      $('#contraIn').keyup(()=> {validarStringLong($("#contraIn"),$("#error10"),"Error elige ubicación") });
      $('#cantidad').keyup(()=> {validarNumero($("#cantidad"),$("#error11"),"Error de cantidad") });
      $('#precioV').keyup(()=> {validarVC($("#precioV"),$("#error12"),"Error de precio venta") });

      let click = 0;
      setInterval(()=>{click = 0}, 2000);

    /* --- AGREGAR --- */

    $("#boton").click((e)=>{

      if(click >= 1){ throw new Error('Spam de clicks');}

      let descripcion = validarStringLong($("#descripcion"),$("#error1"),"Error de descripcion");
      let fecha = validarFechaHoy($("#fecha"),$("#error2"),"Error de fecha");
      let composición = validarStringLong($("#composición"),$("#error3"),"Error de Composición");
      let posologia = validarStringLong($("#posologia"),$("#error4"),"Error de posologia");
      let ubicación = validarSelect($("#ubicación"),$("#error5"),"Error ubicación");
      let laboratorio = validarSelect($("#laboratorio"),$("#error6"),"Error laboratorio");
      let presentación = validarSelect($("#presentación"),$("#error7"),"Error presentación");
      let tipo = validarSelect($("#tipoP"),$("#error8"),"Error tipo producto");
      let clase = validarSelect($("#clase"),$("#error9"),"Error clase");
      let contraIn = validarStringLong($("#contraIn"),$("#error10"),"Error contraindicaciones");
      let cantidad = validarNumero($("#cantidad"),$("#error11"),"Error de cantidad");
      let precioV = validarVC($("#precioV"),$("#error12"),"Error de precio venta");

      if(descripcion && fecha && composición && posologia && laboratorio && tipo && presentación && ubicación && contraIn && cantidad && precioV){

        $descripcionP = $('#descripcion');
        $fechaVP = $('#fecha');
        $composicionP = $('#composición');
        $posologiaP = $('#posologia');
        $laboratorioP = $('#laboratorio');
        $tipoP = $('#tipoP');
        $clase = $('#clase');
        $presentaciónP = $('#presentación');
        $ubicaciónP = $('#ubicación');
        $contraInP = $('#contraIn');
        $cantidadP = $('#cantidad');
        $precioVenP = $('#precioV');


        //  ENVÍO DE DATOS
        $.ajax({
          type: "POST",
          url: '',
          dataType: 'json',
          data: {
            "descripcion" : $descripcionP.val(),  
            "fechaV" : $fechaVP.val(),
            "composicionP" : $composicionP.val(),
            "posologia" : $posologiaP.val(),
            "laboratorio" : $laboratorioP.val(),
            "tipoP" : $tipoP.val(),
            "clase" : $clase.val(),
            "presentación" : $presentaciónP.val(),
            "ubicación" : $ubicaciónP.val(),
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
              $("#fechaEd").val(data[0].vencimiento);
              $("#composicionEd").val(data[0].composicion);
              $("#laboratorioEd").val(data[0].cod_lab); 
              $("#tipoEd").val(data[0].cod_tipo);
              $("#claseEd").val(data[0].cod_clase);
              $("#presentaciónEd").val(data[0].cod_pres);
              $("#posologiaEd").val(data[0].posologia);
              $("#ubicaciónEd").val(data[0].ubicacion);
              $("#contraInEd").val(data[0].contraindicaciones);
              $("#cantidadEd").val(data[0].stock);
              $("#VentaEd").val(data[0].p_venta);
              
            }

          })
      });
          
      $('#descripcionEd').keyup(()=> {validarStringLong($("#descripcionEd"),$("#errorE1"),"Error de descripcion") });
       $('#fechaEd').change(function(){
       validarFecha($('#fechaEd'),$("#errorE2"),"Error de fecha");
      })
      $('#composicionEd').keyup(()=> {validarStringLong($("#composicionEd"),$("#errorE3"),"Error de Composición") });
      $('#posologiaEd').keyup(()=> {validarStringLong($("#posologiaEd"),$("#errorE4"),"Error de posologia") });
      $('#ubicaciónEd').change(function(){
        validarSelect($("#ubicaciónEd"),$("#errorE5"),"Error ubicación");
      })
      $('#laboratorioEd').change(function(){
        validarSelect($("#laboratorioEd"),$("#errorE6"),"Error laboratorio");
      })
      $('#presentaciónEd').change(function(){
       validarSelect($("#presentaciónEd"),$("#errorE7"),"Error presentación");
     })
      $('#tipoEd').change(function(){
        validarSelect($("#tipoEd"),$("#errorE8"),"Error tipo producto");
      })
      $('#claseEd').change(function(){
       validarSelect($("#claseEd"),$("#errorE9"),"Error clase");
     })
         
      $('#contraInEd').keyup(()=> {validarStringLong($("#contraInEd"),$("#errorE10"),"Error de contraindicaciones") });
      $('#cantidadEd').keyup(()=> {validarNumero($("#cantidadEd"),$("#errorE11"),"Error de cantidad") });
      $('#VentaEd').keyup(()=> {validarVC($("#VentaEd"),$("#errorE12"),"Error de precio venta") });

     
      // FORMULARIO DE EDITAR

      $("#actualizar").click((e)=>{
          //VALIDACIONES
          if(click >= 1){ throw new Error('Spam de clicks');}

          let descripcionE = validarStringLong($("#descripcionEd"),$("#errorE1"),"Error de descripcion");
          let fechaE = validarFecha($('#fechaEd'),$("#errorE2"),"Error de fecha")
          let composicionE = validarStringLong($("#composicionEd"),$("#errorE3"),"Error de Composición") ;
          let posologiaE = validarStringLong($("#posologiaEd"),$("#errorE4"),"Error de posologia") ;
          let ubicaciónE = validarSelect($("#ubicaciónEd"),$("#errorE5"),"Error ubicación");
          let laboratorioE = validarSelect($("#laboratorioEd"),$("#errorE6"),"Error laboratorio");
          let presentaciónE = validarSelect($("#presentaciónEd"),$("#errorE7"),"Error presentación");
          let tipoE = validarSelect($("#tipoEd"),$("#errorE8"),"Error tipo producto");
          let claseE = validarSelect($("#claseEd"),$("#errorE9"),"Error clase");
          let contraInE = validarStringLong($("#contraInEd"),$("#errorE10"),"Error de contraindicaciones");
          let cantidadE = validarNumero($("#cantidadEd"),$("#errorE11"),"Error de cantidad");
          let VentaE = validarVC($("#VentaEd"),$("#errorE12"),"Error de precio venta");

          if(descripcionE && fechaE && composicionE && posologiaE && laboratorioE && tipoE && claseE && presentaciónE && ubicaciónE && contraInE && cantidadE && VentaE){

      //  ENVÍO DE DATOS
      $.ajax({
        type: "POST",
        url: '',
        dataType: "json",
        data: {
          descripcionEd : $('#descripcionEd').val(),
          fechaEd : $('#fechaEd').val() ,
          composicionEd : $('#composicionEd').val(), 
          posologiaEd: $('#posologiaEd').val(),
          laboratorioEd : $('#laboratorioEd').val() ,
          tipoEd : $('#tipoEd').val() ,
          claseEd : $('#claseEd').val(),
          presentaciónEd : $('#presentaciónEd').val() ,
          ubicaciónEd : $('#ubicaciónEd').val() ,
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