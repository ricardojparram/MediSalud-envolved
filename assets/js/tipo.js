$(document).ready(function(){
let tabla
rellenar();

function rellenar(){
	 $.ajax({
      type: "POST",
      url: '',
      dataType: 'json',
      data:{mostrar: 'xd'},
      success(tipoa){
        tabla = $("#tabla").DataTable({
          responsive: true,
          data: tipoa
        });
      }
    })
}



 $("#tipNom").keyup(()=> {  validarNombre($("#tipNom"),$("#error") ,"Error del Tipo de Producto,") });


let ytipo
$("#enviar").click((e)=>{
	ytipo =  validarNombre($("#tipNom"),$("#error") ,"Error del Tipo de Producto, ");
 	if(ytipo){
 $.ajax({
 	type:"POST",
 	url:"",
 	dataType:"json",
 	data:{

 		tipo: $("#tipNom").val(),

 	},
 	success(data){
 		console.log(ytipo)
 		if(ytipo == true){
 			tabla.destroy()
 		
 		$("#closeAg").click();
 		Toast.fire({ icon: 'success', title:' Tipo de Producto registrado'})
       rellenar();

 	}else{
 		e.preventDefault()
 	   }


   }
})

}

})

$("#closeRegis").click(()=>{
 	$("#basicModal input").attr("style","borde-color:none; backgraund-image: none;");
 	$("#error").text("");
 })


let id;
$(document).on('click', '.borrar',function (){
	id = this.id;
})
$("#delete").click(()=>{
	$.ajax({
		type:"POST",
		url:'',
		dataType:'json',
		data:{
			borrar:'cualquiera',
			id

		},
		success(tipoE){
			if (tipoE.resultado === "Eliminado"){
				tabla.destroy();
				$("#cerrar").click();
				Toast.fire({icon: 'error', title:'tipo de Producto eliminado'})
				rellenar();
			}else{
				console.log("No se elimino");
			}
		}
	})
})
let tipoedit
$(document).on('click', '.editar', function(){
	tipoedit= this.id;
	console.log(tipoedit);
	$.ajax({
		type:"POST",
		url:'',
		dataType:'json',
		data:{
			editar:'si puede ser ',
			tipoedit
		},

		success(log){
			console.log(log);
			$("#tipNomEdit").val(log[0].des_tipo);
		}


	})
})
$("#tipNomEdit").keyup(()=>{  validarNombre($("#tipNomEdit"),$("#error2"),"Error de Tipo de Producto") });

let jtipo;
$("#enviarEditar").click((e)=>{
jtipo = validarNombre($("#tipNomEdit"),$("#error2"),"Error de Tipo de Producto");
if(ytipo){
$.ajax({
	type:"POST",
	url:"",
	dataType:"json",
	data:{
		tipoEditar: $("#tipNomEdit").val(),
		tipoedit
	},success(){
		if (jtipo) {
        tabla.destroy();
        $("#closeEditar").click();
        Toast.fire({ icon: 'success', title: 'Tipo de cambio registrado'})
        rellenar();
      }else{
        e.preventDefault()
      }
	}
})
}
})














})