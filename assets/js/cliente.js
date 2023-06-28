$(function() {

  // obtener campos ocultar div
  var checkbox = $("#gridCheck1");
  var hidden = $("#divOcult");

  hidden.hide();
  checkbox.change(function() {
    if (checkbox.is(':checked')) {

      $("#divOcult").fadeIn()
    } else {

      $("#divOcult").fadeOut()
          $("#telClien, #emailClien").val(""); // limpia los valores de los input al ser ocultado
          $('input[type=checkbox]').prop('checked',false);// limpia los valores de checkbox al ser ocultado
          
        }
      });
});


$(document).ready(function(){

    /*let identificadorIntervaloDeTiempo;

    function Intervalo() {
    identificadorIntervaloDeTiempo = setInterval(refrescar, 1000);
    }
    const intervalID = setInterval(refrescar, 1000,);

    */

    refrescar();
    let tabla;
    function refrescar(){ 
      $.ajax({
        method: "post",
        url: "",
        dataType: "json",
        data: {mostrar: "clien" },
        success(list){
          console.log(list);
          tabla = $("#tabla").DataTable({
            responsive: true,
            data: list
          });
        }
      })

    }

    $("#nomClien").keyup(()=> {  validarNombre($("#nomClien"),$("#error") ,"Error de nombre,") });
    $("#apeClien").keyup(()=> {  validarNombre($("#apeClien"),$("#error") , "Error de apellido,") });
    $("#cedClien").keyup(()=> {  let valid = validarCedula($("#cedClien"),$("#error") ,"Error de cédula,") 
      if(valid == true){
        validarC();
      }
    });
    $("#direcClien").keyup(()=> { validarDireccion($("#direcClien"),$("#error") , "Error de direccion,") });
    $("#telClien").keyup(()=> {  validarTelefonoOp($("#telClien"),$("#error") ,"Error de telefono,") });
    $("#emailClien").keyup(()=> {  validarCorreoOp($("#emailClien"),$("#error") , "Error de correo,") });


    $("#enviar").click((e)=>{
      e.preventDefault();

      $name = $("#nomClien");
      $lastName = $("#apeClien");
      $dni = $("#cedClien");
      $direc = $("#direcClien");
      $phone = $("#telClien");
      $email = $("#emailClien");



      $.ajax({
        type: "POST",
        url: '',
        dataType: "json",
        data: {
          "nomClien": $name.val(),
          "apeClien": $lastName.val(),
          "cedClien": $dni.val(),
          "direcClien": $direc.val(),
          "telClien": $phone.val(),
          "emailClien": $email.val()

        },
        success(user){
          e.preventDefault();
          let correo, telefono, direccion, cedula, apellido, nombre
          correo = validarCorreoOp($("#emailClien"),$("#error") , "Error de correo,");
          telefono = validarTelefonoOp($("#telClien"),$("#error") ,"Error de telefono,");      
          direccion = validarDireccion($("#direcClien"),$("#error") , "Error de direccion,");
          validarCedula($("#cedClien"),$("#error") ,"Error de Cedula,");
          apellido = validarNombre($("#apeClien"),$("#error") , "Error de apellido,");
          nombre = validarNombre($("#nomClien"),$("#error") , "Error de nombre,");

          if(user.resultado === "Error de cedula"){
            $("#error").text(user.error);
            $("#cedClien").attr("style","border-color: red;")
            $("#cedClien").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
          }else{
            cedula = true;
          }


          if(correo && telefono && direccion && cedula && apellido && nombre){
            tabla.destroy();
            $("#cerrarModal").click();
            Toast.fire({ icon: 'success', title: 'Cliente Registrado' })
            refrescar();
          }else{
            e.preventDefault()
          }
        }

      })   


    })
    $("#telClienEdit").keyup(()=> {  validarTelefonoOp($("#telClienEdit"),$("#error2") ,"Error de telefono,") });
    $("#emailClienEdit").keyup(()=> {  validarCorreoOp($("#emailClienEdit"),$("#error2") , "Error de correo,") });
    $("#nomClienEdit").keyup(()=> {  validarNombre($("#nomClienEdit"),$("#error2") ,"Error de nombre,") });
    $("#apeClienEdit").keyup(()=> {  validarNombre($("#apeClienEdit"),$("#error2") , "Error de apellido,") });
    $("#cedClienEdit").keyup(()=> {  validarCedula($("#cedClienEdit"),$("#error2") , "Error de cedula,") });
    $("#direcClienEdit").keyup(()=> { validarDireccion($("#direcClienEdit"),$("#error2") , "Error de direccion,") });

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
        success(eli){
          if (eli.resultado === "Eliminado") {
            tabla.destroy();
            $("#cerrarModalDel").click();
            Toast.fire({ icon: 'error', title: 'Cliente Eliminado' })
            refrescar();
          }else{
            console.log("No se elimino")
          }
        }
      })

        

      })
   
    let id;
    $(document).on('click', '.editar', function() {

      id = this.id; 
      console.log(id);

      $.ajax({
        type: "POST",
        url: "",
        dataType: "json",
        data : {unico: 'lol', id},
        
        success(data){
          $("#nomClienEdit").val(data[0].nombre);
          $("#apeClienEdit").val(data[0].apellido);
          $("#cedClienEdit").val(data[0].cedula);
          $("#direcClienEdit").val(data[0].direccion);
          $("#telClienEdit").val(data[0].celular);
          $("#emailClienEdit").val(data[0].correo);
        }
      })


      $("#enviarEdit").click((e)=>{
        e.preventDefault();

        let nombreEdit = validarNombre($("#nomClienEdit"),$("#error2") , "Error de nombre,");
        let direccionEdit = validarDireccion($("#direcClienEdit"),$("#error2") , "Error de direccion,");
        let cedulaEdit = validarCedula($("#cedClienEdit"),$("#error2") ,"Error de RIF,");
        let apellidoEdit = validarNombre($("#apeClienEdit"),$("#error2") , "Error de apellido,");
        let correoEdit = validarCorreoOp($("#emailClienEdit"),$("#error2") , "Error de correo,");
        let telefonoEdit = validarTelefonoOp($("#telClienEdit"),$("#error2") ,"Error de telefono,");

        let nomEdit = $("#nomClienEdit").val();
        let apeEdit = $("#apeClienEdit").val();
        let cedEdit = $("#cedClienEdit").val();
        let direcEdit = $("#direcClienEdit").val();
        let celuEdit = $("#telClienEdit").val();
        let emailEdit = $("#emailClienEdit").val();
        console.log(nomEdit, apeEdit, cedEdit, direcEdit, celuEdit, emailEdit, id);

        $.ajax({
          type: "POST",
          url: '',
          dataType: "json",
          data: {nomEdit, apeEdit, cedEdit, direcEdit, celuEdit, emailEdit, id},
          success(result){
            console.log(result);
            if (result.resultado === "Editado") {
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
    });

    function validarC(){
      $.getJSON('',{
        cedula: $("#cedClien").val(), 
        validar: 'xd'},
        function(valid){
          console.log(valid);
          if(valid.resultado === "Error de cedula"){
            $("#error").text(valid.error);
            $("#cedClien").attr("style","border-color: red;")
            $("#cedClien").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
          }
        })
    }

  })