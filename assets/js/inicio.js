$(document).ready(function(){

	mostrarCatalogo()
	function mostrarCatalogo(){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			data: {mostraC: 'XD' },
			success(data){
			let mostrar = '';
             data.forEach(row =>{
             	mostrar += `
	            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
	              <div class="card">
	                <div class="text-center m-3">
	                  <img class="card-img-top mx-auto" style="width: 80%;" src="https://images.squarespace-cdn.com/content/v1/58126462bebafbc423916e25/1490212943759-5AVQSBMUSU12111CKAYM/image-asset.png">
	                </div>
	                <div class="card-body d-flex flex-column justify-content-between">
	                  <div class="d-flex justify-content-between">
	                    <p class="card-title align-self-center">${row.descripcion}</p>
	                    <buttom class="btn btn-success align-self-center mostrarC" id='${row.cod_producto}' data-bs-toggle="modal" data-bs-target="#AñadirCarrito"><i class="bi bi-cart4"></i></buttom>
	                  </div>
	                  <div class="m-0 d-flex flex-column">
	                    <p class="card-text align-self-left">Precio: ${row.p_venta}</p>
	                  </div>
	                </div>
	              </div>
	            </div>
             	`;
             })
             $('#catalogo').html(mostrar);

			}
		})
	}

	let id;

	$(document).on('click' , '.mostrarC' , function(){
     id = this.id;
     
     $.ajax({
     	type: 'POST',
     	url: '',
     	dataType: 'json',
     	data: {mostraProductos: 'mostrar', id },
     	success(data){
         let datos;
         datos = `          
         <p class="fw-bold">Producto: ${data[0].descripcion}</p>
         <p class="fw-bold">Precio: ${data[0].p_venta}</p>
         <p class="fw-bold">fecha vencimiento: ${data[0].vencimiento}</p>
         <div class="d-flex justify-content-between h-25">
          <input placeholder="${data[0].stock}" class="form-control w-50 align-self-center" type="number">
          <p class="card-title fw-bold fs-5 align-self-center">Total: <span class="Total fs-5 text-black">200</span></p>
         </div>
         
         `
         $('.mostrarP').html(datos);
     	}
     }) 
 
	})

	function stockMax(id , input){
     $.ajax({
     	type: 'POST',
     	url: '',
     	dataType: 'json',
     	data: {stockMax: 'mostrar', id },
     	success(data){

     	}
     })
	}


})