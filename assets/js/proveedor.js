$(document).ready(function(){

  /* --- FUNCIÓN PARA RELLENAR LA TABLA --- */
  rellenar();
  let mostrar
  function rellenar(){ 
    $.ajax({
      type: "post",
      url: "",
      dataType: "json",
      data: {mostrar: "pro" },
      success(data){
        mostrar = $('#tableMostrar').DataTable({
          responsive: true,
          data: data
        })
      }
    })

  }

  /* --- AGREGAR --- */

  // VALIDACIONES
  $("#rif").keyup(()=> {  validarCedula($("#rif"),$("#error") ,"Error de RIF,") });
  $("#razon").keyup(()=> {  validarNombre($("#razon"),$("#error") , "Error de nombre,") });
  $("#direccion").keyup(()=> {  validarDireccion($("#direccion"),$("#error") , "Error de direccion,") });
  $("#telefono").keyup(()=> {  validarTelefono($("#telefono"),$("#error") ,"Error de telefono,") });

  $("#registrar").click((e)=>{

    let vrif = validarCedula($("#rif"),$("#error") ,"Error de RIF,");
    let vnombre = validarNombre($("#razon"),$("#error") , "Error de nombre,");
    let vdireccion = validarDireccion($("#direccion"),$("#error") , "Error de direccion,");
    let vtelefono = validarTelefono($("#telefono"),$("#error") ,"Error de telefono,");

    if(vrif ==true && vnombre ==true && vdireccion ==true && vtelefono ==true){

      // ENVÍO DE DATOS
      $.ajax({

        type: "post",
        url: '',
        data: {
          rif : $("#rif").val(),
          razon : $("#razon").val(),
          direccion : $("#direccion").val(),
          telefono : $("#telefono").val(),
          contacto : $("#contacto").val()
        },
        success(){

          mostrar.destroy(); // VACÍA LA DATATABLE
          rellenar();  // FUNCIÓN PARA RELLENAR DATATABLE
          $('#agregarform').trigger('reset'); // LIMPIAR EL FORMULARIO
            $('.cerrar').click(); // CERRAR EL MODAL
            Toast.fire({ icon: 'success', title: 'Proveedor registrado' }) // ALERTA 
            
        }

      })

      e.preventDefault();

    }else{
      e.preventDefault();
    }   

  })

    let id 
    // SELECCIONA ITEM
    $(document).on('click', '.editar', function() {
      console.log("entrando");
        id = this.id; // se obtiene el id del botón, previamente le puse de id el codigo en rellenar()
        // RELLENA LOS INPUTS
          $.ajax({
            method: "post",
            url: "",
            dataType: "json",
            data: {select: "dro", id}, // id : id
            success(data){
              $("#rifEdit").val(data[0].rif);
              $("#razonEdit").val(data[0].razon_social);
              $("#direccionEdit").val(data[0].direccion);
              $("#telefonoEdit").val(data[0].telefono);
              $("#contactoEdit").val(data[0].contacto);
            }



        })
         


  });



    // VALIDACIONES
  $("#rifEdit").keyup(()=> {  validarCedula($("#rifEdit"),$("#errorEdit") ,"Error de RIF,") });
  $("#razonEdit").keyup(()=> {  validarNombre($("#razonEdit"),$("#errorEdit") , "Error de nombre,") });
  $("#direccionEdit").keyup(()=> {  validarDireccion($("#direccionEdit"),$("#errorEdit") , "Error de direccion,") });
  $("#telefonoEdit").keyup(()=> {  validarTelefono($("#telefonoEdit"),$("#errorEdit") ,"Error de telefono,") });

  // FORMULARIO DE EDITAR

  $("#editar").click((e)=>{
      //VALIDACIONES

    let vrif = validarCedula($("#rifEdit"),$("#errorEdit") ,"Error de RIF,");
    let vnombre =  validarNombre($("#razonEdit"),$("#errorEdit") , "Error de nombre,");
    let vdireccion = validarDireccion($("#direccionEdit"),$("#errorEdit") , "Error de direccion,");
    let vtelefono = validarTelefono($("#telefonoEdit"),$("#errorEdit") ,"Error de telefono,");
    //let vdireccion = $("#direccionEdit");

    console.log(vdireccion);

    if(vrif ==true && vnombre ==true && vdireccion ==true && vtelefono ==true){



      //  ENVÍO DE DATOS
      $.ajax({

        type: "post",
        url: '',
        data: {
          rifEdit : $("#rifEdit").val(),
          razonEdit : $("#razonEdit").val(),
          direccionEdit : $("#direccionEdit").val(),
          telefonoEdit : $("#telefonoEdit").val(),
          contactoEdit : $("#contactoEdit").val(),
          id
        },
        success(){
          mostrar.destroy();
          rellenar(); 
          $('#editarform').trigger('reset');
          $('.cerrar').click();
          Toast.fire({ icon: 'success', title: 'Laboratorio modificado' })
        }

      })

      e.preventDefault();

    }else{
      e.preventDefault();
    }   

  })
    

    $(document).on('click', '.borrar', function() {
      id = this.id;

       });

      $('#borrar').click(()=>{
          console.log(id);
        $.ajax({
          type : 'post',
          url : '',
          data : {eliminar : 'asd', id},
          success(data){
            mostrar.destroy();
            $('.cerrar').click();
            rellenar();
            Toast.fire({ icon: 'success', title: 'Proveedor eliminado' })
          }
        })
      })
    



})

