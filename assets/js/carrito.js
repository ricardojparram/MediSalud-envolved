$(document).ready(function(){

	mostrarCarrito().then(() => {
		editarCantidad();
	})
	async function mostrarCarrito(){
		await $.ajax({
			method: 'POST',
			dataType: 'json',
			url: '?url=carrito',
			data: {mostrar:'', carrito:''},
			success(response){
				let div = '';
				if(typeof response.error != 'undefined'){
					div = `<div class="alert alert-secondary w-75" role="alert">
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
					div = `<div class="alert alert-secondary w-75" role="alert">
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
					let flexDirection = ($('.carrito-container').width() < 400) ? 'item-carrito-tienda' : '';
					for(let i = 0; i < response.length; i++){
						let row = response[i];
						let precioUnidadTotal = row.precioActual * row.cantidad;
						precioTotal += precioUnidadTotal;
						let hr = (i == response.length - 1) ? '' : '<hr class="my-2">';
						div += `
						<div class="item-carrito ${flexDirection} p-2">
			                <img class="" src="https://images.squarespace-cdn.com/content/v1/58126462bebafbc423916e25/1490212943759-5AVQSBMUSU12111CKAYM/image-asset.png">
			                <div class="descripcion">
			                  <h3>${row.descripcion}</h3>
			                  <p>${row.contraindicaciones}</p>
			                  <div class="opciones">
			                    <input type="number" id="${row.cod_producto}" value="${row.cantidad}" class="form-control cantidad" placeholder="Cant.">
			                    <a class="eliminar" href="#">Eliminar</a>
			                  </div>
			                  <p class="error" style="color:red;"></p>
			                </div>
			                <div class="precio">
			                  <h6>Unidad: ${row.precioActual}$</h6>
			                  <h6 class="fs-5">Total: ${precioUnidadTotal}$</h6>
			                </div>
			            </div>
			            ${hr}
			            `
					}

					$('.carrito-container').html(div);
					$('#precioTotal').html(precioTotal);
				}

			}
		})
	}

	async function validarStock(productos){
		let res;
		await $.ajax({ method: 'POST', url: '?url=carrito', dataType: 'json',
			data: {validar:'', productos},
			success(response){ 
				let resultado = [];
				response.forEach(row => {
					let errorElement = $(`#${row.id_producto}`).closest('.descripcion').find('.error');
					if(row.info.resultado){
						$(`#${row.id_producto}`).attr("style","border-color: none;")
						errorElement.html('')
					}else{
						$(`#${row.id_producto}`).attr("style","border-color: red;")
						errorElement.html(response.msg)
					}
					resultado.push(row.info.resultado);
				})
				res = !resultado.includes(false);
			}
		})
		return res;
	}

	function editarCantidad(){
		$('.opciones .cantidad').on('keyup change', function(){
			let {id: id_producto, value: cantidad} = this;
			let productos = [{id_producto, cantidad}];
			validarStock(productos).then((res) => {
				if(!res) return;

				$.post('',{editar:'', id_producto, cantidad}, function(response){
					let  result = JSON.parse(response);
					if(!result.resultado){
						Toast.fire({ icon: 'error', title: result.msg });
					}
				})

			})
		})
	}

})