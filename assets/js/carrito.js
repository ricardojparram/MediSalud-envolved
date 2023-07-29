$(document).ready(function(){

	mostrarCarrito();
	function mostrarCarrito(){
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: '',
			data: {mostrar:'', carrito:''},
			success(response){
				let div = '';
				if(typeof response.error != 'undefined'){
					div = `
							<div class="alert alert-secondary w-75" role="alert">
				                <h3>Necesita iniciar sesión para agregar productos al carrito.</h3>
				                <div>
				                  <a class="text-center col-6" href=""><u>Iniciar sesión</u></a> | 
				                  <a class="text-center col-6" href=""><u>Registrarse</u></a>
				                </div>
				            </div>`;
					$('.carrito-container').html(div);
					$('.cardTotal').hide();
					$('.vaciar').hide();
				}
				if(response.length == 0){
					div = `
							<div class="alert alert-secondary w-75" role="alert">
				                <h3>Su carrito está vacío.</h3>
				            </div>`;
				    $('.carrito-container').html(div);
				    $('.carrito-container').css({width:'500px'})
				    $('.regresar').parent().toggleClass('col-6')
					$('.cardTotal').hide();
					$('.vaciar').hide();
				}
				if(response.length > 0){
					let precioTotal = 0;
					response.forEach(row => {
						console.log(row);
						let precioUnidadTotal = row.precioActual * row.cantidad;
						precioTotal += precioUnidadTotal;
						div += `
						<div class="item-carrito p-2">
			                <img class="" src="https://images.squarespace-cdn.com/content/v1/58126462bebafbc423916e25/1490212943759-5AVQSBMUSU12111CKAYM/image-asset.png">
			                <div class="descripcion">
			                  <h3>${row.descripcion}</h3>
			                  <p>${row.contraindicaciones}</p>
			                  <div class="opciones">
			                    <input type="number" value="${row.cantidad}" class="form-control cantidad" placeholder="Cant.">
			                    <a class="eliminar" href="#">Eliminar</a>
			                  </div>
			                </div>
			                <div class="precio">
			                  <h6>Unidad: ${row.precioActual}$</h6>
			                  <h6 class="fs-5">Total: ${precioUnidadTotal}$</h6>
			                </div>
			              </div>
						`
					})
					$('.carrito-container').html(div);
					$('#precioTotal').html(precioTotal+'$');
				}

			}
		})
	}

})