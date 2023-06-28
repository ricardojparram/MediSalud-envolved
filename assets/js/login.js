$(document).ready(function(){

  $("#cedula").keyup(()=>{ 
    let valid = validarCedula($("#cedula"),$("#error") ,"Error de cedula,");
    if(valid){ validarC(); }  
  })

  $("#boton").click((e)=>{
    e.preventDefault()
    $.ajax({

      type: "post",
      url: '',
      dataType: 'json',
      data: {
        a: 'si',
        cedula: $("#cedula").val(),
        password: $("#pass").val()
      },
      success(data){
        e.preventDefault()
        let vcedula, vpassword

        validarCedula($("#cedula"),$("#error") ,"Error de cedula,");
        validarContraseña($("#pass"),$("#error") , "Error de contraseña,"); 

        if(data.resultado === "Error de cedula"){
          $("#error").text(data.error);
          $("#cedula").attr("style","border-color: red;")
          $("#cedula").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
        }else{
          vcedula = true;
        }
        if(data.resultado === "Error de contraseña"){
          $("#error").text(data.error);
          $("#pass").attr("style","border-color: red;")
          $("#pass").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
        }else{
          vpassword = true;
        }
        

        if(vcedula === true && vpassword === true){

          Swal.fire({
            title: 'Iniciando sesión!',
            text: 'Los datos son correctos.',
            icon: 'success',
          })
          setTimeout(function(){
            location = '?url=home'
          }, 1600);

        }

      }

    })

    
  })

  function validarC(){
    $.getJSON('',{cedula: $("#cedula").val(),validar: 'xd'},
      function(data){
        if(data.resultado === "Error de cedula"){
          $("#error").text(data.error);
          $("#cedula").attr("style","border-color: red;")
          $("#cedula").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
        }
      })
  }

});