$(document).ready(function(){

  let tabla;
  rellenar();

  function rellenar(){
    $.ajax({
      type:"POST",
      url:'',
      dataType: 'json',
      data:{mostrar:'xd'},
      success(sol){
        console.log(sol);
        tabla = $("#tabla").DataTable({
          responsive: true,
          data:sol
        });
      }
    })
  }
  $("#tipo").keyup(()=> { validarString($("#tipo"),$("#error"),"Error de tipo de pago") });

  let ytipo;
  $("#enviar").click((e)=>{

    ytipo = validarString($("#tipo"),$("#error"),"Error de tipo de pago");

    if (ytipo) {


      $.ajax({

        type:"POST",
        url:"",
        dataType:"json",
        data:{
          metodo:$("#tipo").val()
        },
        success(data){
          console.log(ytipo);
          if (ytipo == true) {
            tabla.destroy();
            $("#close").click();
            Toast.fire({ icon: 'success', title: 'metodo de pago registrado' });
            rellenar();
          }else{
            e.preventDefault();
          }
        }
      })
    }
  })
  
$("#cerrarRegis, #cerrar").click(()=>{
  $("#registrarModal input").attr("style","borde-color:none; backgraund-image: none;");
  $("#error").text("");
 })

  let id;
  $(document).on('click', '.borrar', function(){
    id = this.id;
    console.log(id);
  })
  $("#deletes").click((e)=>{
    $.ajax({
      type:"POST",
      url:'',
      dataType:'json',
      data:{
        eliminar:'cualquier cosa',
        id
      },
      success(elba){
        if (elba.resultado === "Eliminado"){
          $("#closeModal").click();
          tabla.destroy();
          Toast.fire({icon: 'error', title: 'Tipo de pago eliminado'})
          rellenar();

        }else{
          console.log("No se elimino")
        }
      }
    })
  })



  let unicas;
  $(document).on('click', '.editar', function(){
    unicas = this.id;

    $.ajax({
      type:"POST",   
      url:'',
      dataType:'json',
      data:{
        editar:'siloserick',
        unicas
      },
      success(uno){
        console.log(uno);
        $("#tipoEdit").val(uno[0].des_tipo_pago);
      }
    })
  })

  $("#tipoEdit").keyup(()=> {  validarString($("#tipoEdit"),$("#error2") ,"Error de Tipo de Moneda,") });


  let ctipo; 
  $("#enviarEdit").click((e)=>{
    ctipo = validarString($("#tipoEdit"),$("#error2") ,"Error de Tipo de Moneda,");
    if (ctipo){
    $.ajax({

      type:"POST",
      url:"",
      dataType:"json",
      data:{
        tipoEdit: $("#tipoEdit").val(),
        unicas

      },
      success(data){
        console.log(ctipo);
        if (ctipo == true) {
          tabla.destroy();
          $("#closeEdit").click();
          Toast.fire({ icon: 'success', title: 'Tipo de cambio registrado'});
          rellenar();
        }else{
          e.preventDefault()
        }
      }
    })
}


  })

});
