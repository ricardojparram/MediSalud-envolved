$(document).ready(function(){
 
 let mostrar;
 
 mostrarCatalogo()
 function mostrarCatalogo(){
 	$.ajax({
 		type: 'POST',
 		url: '',
 		dataType: 'json',
 		data: {mostraC: 'XD' },
 		success(data){

 		}
 	})
 }

})