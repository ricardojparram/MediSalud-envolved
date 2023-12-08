$(document).ready(function(){

	mostrarCatalogo()
	const getProductos = () => JSON.parse(localStorage.getItem('productos'));
	const getProdDetalle = (id) => {let prod = getProductos(); return prod[`${id}`] }

	function mostrarCatalogo(){
		$.ajax({type: 'POST',url: '',dataType: 'json',data:{mostraC: ''},
			success(data){
				let productos = data.reduce((acc, curr) => {
					acc[curr.cod_producto] = curr;
					return acc;
				}, {});
	            localStorage.setItem('productos', JSON.stringify(productos));
				let mostrar = '';
	            data.forEach(row =>{
	             	mostrar += `
		            <div class="product-container">
		              <div class="card-product position-relative">
		                <div class="card-body">
		                  <div class="text-center position-relative">
		                    <img src="${row.img}" alt="Imagen del producto" class="mb-3 img-fluid">
		                    <small class="text-warning position-absolute bottom-0 end-0">
		                      <i class="bi bi-star-fill"></i>
		                      <i class="bi bi-star-fill"></i>
		                      <i class="bi bi-star-fill"></i>
		                      <i class="bi bi-star-fill"></i>
		                      <i class="bi bi-star-half"></i>
		                    </small>
		                  </div>
		                  <div class="text-small mb-1">
		                    <a href="#!" class="text-decoration-none text-muted" tabindex="0"><small>${row.des_tipo}</small></a>
		                  </div>
		                  <h2 class="fs-6">${row.nombre}</h2>
		                  <!-- rating -->

		                  <div class="d-flex justify-content-between align-items-center mt-3">
		                    <div>
		                      <span class="text-dark">Bs. ${row.p_venta}</span><span class="text-muted"> $5</span>
		                    </div>
		                    <!-- btn -->
		                    <button id_prod="${row.cod_producto}" class="btn btn-sm btn-success text-white mostrarCatalogo" data-bs-toggle="modal" data-bs-target="#AñadirCarritoModal">
		                      <strong>Comprar </strong><i class="fs-7 text-white bi bi-cart-plus-fill"></i> 
		                    </button>
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

	$(document).on('click' , '.mostrarCatalogo' , function(){
		id = this.attributes.id_prod.value;
		let producto = getProdDetalle(id);
		 console.log(producto)
		$('.tipo_medicamento').html(producto.des_tipo);
		$('.nombre_medicamento').html(producto.nombre);
		$('.descripcion_medicamento').html(producto.descripcion);
		$('.precio_bs').html(producto.p_venta);
		$('.producto_imagen_modal').attr('src', producto.img);
		$('.codigo_producto').html(producto.cod_producto);
		$('.tipo_producto').html(producto.des_tipo);
		$('.contraindicaciones').html(producto.contraindicaciones);

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