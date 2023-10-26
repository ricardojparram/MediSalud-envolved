$(document).ready(function(){

	mostrarCatalogo()

	function mostrarCatalogo(){
		$.ajax({type: 'POST',url: '',dataType: 'json',data:{mostraC: ''},
			success(data){
				// console.log(data);
	            localStorage.setItem('productos', JSON.stringify(data));
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

	let id, producto;
	let cantidad, error, input;

	function actualizarTotal(){
		input = $('#catalogoCantidadInput');
		cantidad = Number(input.val());
		error = $('#errorCantidadCatalogo');
		if(validarVC(input, error, 'Error,') != true){
			error.css({display: 'block'});
			return
		}else{
			error.css({display: 'none'});
		}
		let total = producto.p_venta * cantidad;
		$('#totalProductoCatalogo').html(total);
	}

	$(document).on('click' , '.mostrarC' , function(){
     id = this.id;
     
     $.ajax({type: 'POST',url: '',dataType: 'json',data: {mostraProductos: '', id },
     	success(data){
     		producto = data[0];
        	let datos;
	        datos = `          
		         <p class="fw-bold">Producto: ${data[0].descripcion}</p>
		         <p class="fw-bold">Precio: ${data[0].p_venta}</p>
		         <p class="fw-bold">fecha vencimiento: ${data[0].vencimiento}</p>
		         <div class="d-flex justify-content-between h-25">
			        <input id="catalogoCantidadInput" placeholder="${data[0].stock}" class="w-50 form-control align-self-center" type="number">
					<p class="card-title fw-bold fs-5 align-self-center">Total: <span id="totalProductoCatalogo" class="fs-5 text-black">200</span></p>
		         </div>
		         <p style="color:red;display:none;font-size:15px" id="errorCantidadCatalogo"></p>
         		`
        	$('.mostrarP').html(datos);
        	$('#catalogoCantidadInput').keyup(() => actualizarTotal())
     	}
     })
 
	})

	async function validarStock(id, input = $('#catalogoCantidadInput')){
		let stock = 0;
		cantidad = Number(input.val());
		error = $('#errorCantidadCatalogo');
		await $.ajax({ type: 'POST', url: '', dataType: 'json', 
			data: { validarStock: 'mostrar', id },
			success: (data) => { stock = Number(data.stock) },
			error: () => { throw new Error('Ocurrió un error al validar stock.') }
		})

		if(cantidad > stock){
			input.css({"border-color": "red", "background-image":"url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"});														
			error.html('Cantidad no disponible').css({display: 'block'});
			return false
		}else{
			input.css({"border-color" : "none"});
			error.css({display: 'none'});
			return true;
		}

	}

	$('#añadirAlCarrito').click(function(){
		input = $('#catalogoCantidadInput');
		cantidad = Number(input.val());
		error = $('#errorCantidadCatalogo');

		if(validarVC(input, error, 'Error,') != true){
			error.css({display: 'block'});
			return
		}else{
			error.css({display: 'none'});
		}

		validarStock(id).then((res) => {
			if(!res) return;

			$.ajax({ url: '', type: 'post', dataType: 'json',
				data: {añadirCarrito:'', id, cantidad},
				success(res){
					if(res.resultado === true){
						$('.cerrar').click();
						carrito.refrescar();
						Toast.fire({ icon: 'success', title: 'Se ha añadido el producto al carrito.'});
					}else{
						$('.cerrar').click();
						Toast.fire({ icon: 'error', title: res.msg});
					}
				},
				error: (e) => {
					$('.cerrar').click();
					Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.'});
				}

			})
			
		})

	})


})