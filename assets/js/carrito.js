$(document).ready(function(){

	const getProductos = () => JSON.parse(localStorage.getItem('productos'));
	const getProdDetalle = (id) => {let prod = getProductos(); return prod[`${id}`] }

	const setCar = (prods) => localStorage.setItem('carrito', JSON.stringify(prods));
	const getCar = () => {
		return (localStorage.getItem('carrito') === "") ? "" : JSON.parse(localStorage.getItem('carrito'));
	};
	const getOneProd = (id) => {let car = getCar(); return car[`${id}`] }
	const insertIntoCar = (id,prod) => {
		let car = getCar();
		car[`${id}`] = prod;
		setCar(car);
	}
	const updateProd = (id, cantidad) => {
		let car = getCar();
		car[`${id}`].cantidad = cantidad;
		setCar(car);
	}
	const deleteProd = (id) => {
		let car = getCar(); 
		delete car[`${id}`];
		setCar(car);
	}
	const deleteCar = () => localStorage.setItem('carrito', []);

	let session = true;
	let productosCarrito = "";

	if('carrito' in localStorage){
		productosCarrito = (localStorage.getItem('carrito') !== "")
		? getCar() : "";
	}else{
		localStorage.setItem('carrito', []);
	}


	consultarCarrito().then((res) =>{
		if(res != true) session = false;

		mostrarCarrito();
		editarCantidad();
		confirmarEliminar();
	})

	function mergeCarts(carrito, carritoStorage){

		if(Object.keys(carritoStorage).length === 0){
			setCar(carrito);
			carritoStorage = getCar();
		}

		if(JSON.stringify(carritoStorage) === JSON.stringify(carrito)) return;

		if(Object.keys(carritoStorage).length >= 1){
			Object.entries(carrito).forEach((prod) => {
				if (carritoStorage[prod[1].cod_producto]) {
					if(carritoStorage[prod[1].cod_producto].cantidad !== prod[1].cantidad){
						carritoStorage[prod[1].cod_producto].cantidad = parseInt(carritoStorage[prod[1].cod_producto].cantidad) + parseInt(prod[1].cantidad);
					}
					// carritoStorage[prod[1].cod_producto].p_venta = prod[1].p_venta; 
				} else {
					carritoStorage[prod[1].cod_producto] = prod[1];
				}
			});
			setCar(carritoStorage);
		}
	}
	async function consultarCarrito(){
		let res;
		await $.ajax({method: 'POST',dataType: 'json',url: '?url=carrito',
			data: {consultarCarrito:''},
			success(response){
				if(response.resultado != 'ok'){
					res = false;
					return;
				}

				res = true;

				let carritoBD = response.carrito.reduce((acc, curr) => {
					acc[curr.cod_producto] = curr;
					return acc;
				}, {});

				mergeCarts(carritoBD, productosCarrito);
			},
			error(res){
				Toast.fire({ icon: 'error', title: 'Ha ocurrido un error al consultar carrito.' });
				res = false;
				throw new Error("Ha ocurrido un error al consultar carrito.");
			}
		})
		return res;
	}
	
	function mostrarCarrito(){
		carrito = Object.entries(getCar());
		let div = '';
		if(carrito.length === 0){
			div = `<div class="alert alert-secondary w-75" role="alert">
						<h3>Su carrito está vacío.</h3>
		            </div>`;
		    $('.carrito-container').html(div);
		    $('.regresar').parent().toggleClass('col-6')
			$('.cardTotal').hide();
			$('.vaciar').hide();
		}

		if(carrito.length > 0){
			let productos = [];
			let precioTotal = 0;
			let flexDirection = ($('.carrito-container').width() < 400) ? 'item-carrito-tienda' : '';
			carrito.forEach((row, i) => {
				let prod = getProdDetalle(row[1].cod_producto);
					prod.cantidad = row[1].cantidad;
				let precioUnidadTotal = parseFloat(prod.p_venta) * parseFloat(prod.cantidad);
				precioTotal += precioUnidadTotal;
				let hr = (i == carrito.length - 1) ? '' : '<hr class="my-2">';
				let img = (prod.img == null) ? '' : prod.img;

				div += `
				<div class="item-carrito  ${flexDirection} p-2">
	                <img class="" src="${img}">
	                <div class="descripcion ">
	                  <h3>${prod.nombre}</h3>
	                  <p>${prod.descripcion}</p>
	                  <div class="opciones position-relative">
	                    <input type="number" id="${prod.cod_producto}" value="${prod.cantidad}" class="form-control cantidad" placeholder="Cant.">
	                    <a class="eliminar" prod="${prod.cod_producto}" >Eliminar</a>
	                    <div class="invalid-tooltip">Cantidad no disponible.</div>
	                  </div>
	                </div>
	                <div class="precio">
	                  <h6>Unidad: <span class="precioUnidad">${prod.p_venta}</span>$</h6>
	                  <h6 class="fs-5">Total: <span class="precioUnidadTotal">${precioUnidadTotal}</span>$</h6>
	                </div>
	            </div>
	            ${hr}
	            `
	            productos.push({id_producto: prod.cod_producto, cantidad: prod.cantidad});		
			})

			actualizarBadge(productos.length);
			$('.carrito-container').html(div);
			$('#precioTotal').html(precioTotal);
			validarStock(productos);
		}

	}

	async function validarStock(productos, tooltipClass = '.invalid-tooltip'){
		let res;
		await $.ajax({ method: 'POST', url: '?url=carrito', dataType: 'json',
			data: {validar:'', productos},
			success(response){ 
				let resultado = [];
				response.forEach(row => {
					let tooltip = $(`#${row.id_producto}`).closest('.opciones').find(tooltipClass);
					if(row.info.resultado){
						$(`#${row.id_producto}`).attr("style","border-color: none;")
						tooltip.hide();
					}else{
						$(`#${row.id_producto}`).attr("style","border-color: red;")
						tooltip.text('Cantidad no disponible.')
						tooltip.show();
					}
					resultado.push(row.info.resultado);
				})
				res = !resultado.includes(false);
			}
		})
		return res;
	}

	function actualizarTotalCarrito(){
		let total = 0;
		$('.carrito-container').find('.precioUnidadTotal').each(function(){
			let precio = Number($(this).text());
			total += precio;
		})
		$('#precioTotal').html(total);
	}

	let precioUnidad, cantidadProducto, precioUnidadTotal, input;
	function editarCantidad(){
		let timeoutId;
		$('.opciones .cantidad').on('keyup change',function(){
			clearTimeout(timeoutId);
			input = $(this);
			let {id: id_producto, value: cantidad} = this;
			let productoEditado = [{id_producto, cantidad}];
			timeoutId = setTimeout(function() {
				if(validarInputCantidadCarrito(input) != true) return;
				validarStock(productoEditado).then((res) => {
					if(!res) return;

					if(session === false){
						updateProd(id_producto, cantidad);
						prod = getOneProd(id_producto);
						precioUnidad = parseFloat(prod.p_venta);
						cantidadProducto = parseInt(prod.cantidad);
						precioUnidadTotal = precioUnidad * cantidadProducto;
						input.closest('.item-carrito').find('.precioUnidadTotal').html(precioUnidadTotal);
						input.closest('.item-carrito').find('.precioUnidad').html(precioUnidad);
						actualizarTotalCarrito()
						return;
					}

					$.post('?url=carrito',{editar:'', id_producto, cantidad}, function(response){
						let result = JSON.parse(response);

						if(!result.resultado){
							Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
						}else{
							updateProd(id_producto, cantidad);
							precioUnidad = Number(result.info.precioActual);
							cantidadProducto = Number(result.info.cantidad);
							precioUnidadTotal = precioUnidad * cantidadProducto;
							input.closest('.item-carrito').find('.precioUnidadTotal').html(precioUnidadTotal);
							input.closest('.item-carrito').find('.precioUnidad').html(precioUnidad);
							actualizarTotalCarrito()
						}
					}).fail(()=>{
						Toast.fire({ icon: 'error', title: 'Ha ocurrido un error al editar la cantidad.' });
						throw new Error("Ha ocurrido un error al editar la cantidad.");
					})

				})
			}, 700);
		})
	}

	function actualizarBadge($cantidad){
		badge = $('#carrito_badge');
		badge.html($cantidad)
	}

	let id;
	function confirmarEliminar(){
		$('.opciones .eliminar').on('click', function(e){
			e.preventDefault();
			let prodTitle = $(this).closest('.descripcion').find('h3').text();
			$('#delProductTitle').html(prodTitle);
			$('#delModal').modal('show')

			id = $(this).attr('prod');
		})
	}
	


	$('#delProductFromCar').click(function(){
		if(session === false){
			deleteProd(id);
			Toast.fire({ icon: 'success', title: 'Producto eliminado del carrito.' })
			$('.carrito-container').empty();
			$('#delModal').modal('hide');
			mostrarCarrito();
			return;
		}

		$.ajax({type : 'post', url : '?url=carrito', data : {eliminar:'', id}, dataType: 'json',
			success(data){
				if(data.resultado === true){
					deleteProd(id);
					Toast.fire({ icon: 'success', title: 'Producto eliminado del carrito.' })
					$('.carrito-container').empty();
					$('#delModal').modal('hide');
					mostrarCarrito();
				}else{
					Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' })
					$('#delModal').modal('hide');
				}
			},
			error(){
				Toast.fire({ icon: 'error', title: 'Ha ocurrido un error al eliminar producto.' });
				throw new Error("Ha ocurrido un error al eliminar producto.");
			}
		})

	})

	let validCantidad;
	$('.cantidad_producto button').click(function(){
		let input = $('#cantidad_añadir_producto');
		let cantidad = Number(input.val());
		if($(this).hasClass('mas')) cantidad++;
		if($(this).hasClass('menos')) cantidad--;
		cantidad = (cantidad < 1) ? 1 : cantidad;
		input.val(cantidad);
		validCantidad = validarInputCantidadCarrito(input, '.invalid-tooltip-prod');
	})
	$('#cantidad_añadir_producto').on('keyup', function(){
		validCantidad = validarInputCantidadCarrito($(this), '.invalid-tooltip-prod');
	})


	$(document).on('click','.mostrarCatalogo', function(){id = this.attributes.id_prod.value;})

	function añadirCarrito(productsAdded){

		let carrito = productsAdded.reduce((acc, curr) => {
			let prodDetalle = getProdDetalle(curr.id_producto);
			acc[curr.id_producto] = {
				cod_producto: curr.id_producto,
				cantidad: curr.cantidad,
			};
			return acc;
		}, {});

		let carritoStorage = getCar();	
		mergeCarts(carrito, carritoStorage);

		if(session === true){
			carrito = getCar();
			$.ajax({ url:'?url=carrito', type: 'post', dataType: 'json',
				data: {añadirCarrito:'', productos: carrito},
				success(res){
					console.log(res);
					// if(res.resultado === true){
					// 	$('.cerrar').click();
					// 	carrito.refrescar();
					// 	Toast.fire({ icon: 'success', title: 'Se ha añadido el producto al carrito.'});
					// }else{
					// 	$('.cerrar').click();
					// 	Toast.fire({ icon: 'error', title: res.msg});
					// }
				},
				error: (e) => {
					$('.cerrar').click();
					Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.'});
				}

			})
		}

	}

	$('#añadir_al_carrito').click(function(){
			input = $('#cantidad_añadir_producto');
			cantidad = Number(input.val());

			if(validarInputCantidadCarrito(input, '.invalid-tooltip-prod') != true) return;

			let prod = [{id_producto: id, cantidad}]
			validarStock(prod, '.invalid-tooltip-prod').then((res) => {
				if(!res) return;

				añadirCarrito(prod);

				// $.ajax({ url:'?url=carrito', type: 'post', dataType: 'json',
				// 	data: {añadirCarrito:'', prod},
				// 	success(res){
				// 		if(res.resultado === true){
				// 			$('.cerrar').click();
				// 			carrito.refrescar();
				// 			Toast.fire({ icon: 'success', title: 'Se ha añadido el producto al carrito.'});
				// 		}else{
				// 			$('.cerrar').click();
				// 			Toast.fire({ icon: 'error', title: res.msg});
				// 		}
				// 	},
				// 	error: (e) => {
				// 		$('.cerrar').click();
				// 		Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.'});
				// 	}

				// })
				
			})

		})

	$('.vaciar').click(function(e){
		e.preventDefault();
		$('#vaciarCarritoModal').modal('show');
	})

	$('#vaciarCarritoConfirm').click(() => {

		if(session === false){
			deleteCar();
			$('#vaciarCarritoModal').modal('hide');
			$('.carrito-container').empty();
			Toast.fire({ icon: 'success', title: 'Se ha vaciado su carrito, correctamente.'});
			mostrarCarrito();
			return;
		}

		$.post('?url=carrito', {vaciarCarrito: ''}, function(response){
			let res = JSON.parse(response);
			if(res.resultado){
				deleteCar();
				$('#vaciarCarritoModal').modal('hide');
				$('.carrito-container').empty();
				Toast.fire({ icon: 'success', title: 'Se ha vaciado su carrito, correctamente.'});
				mostrarCarrito();
			}else{
				$('#vaciarCarritoModal').modal('hide');
				Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.'});
			}
		})
	})


	$('#realizarFacturacion').click(function(){
		let productos = [];
		$('.cantidad').each(function(){
			let input = $(this);
			if(validarInputCantidadCarrito(input) != true) throw new Error('Input inválido.');
			let {id: id_producto, value: cantidad} = this;
			productos.push({id_producto, cantidad});
		})
		validarStock(productos).then(res => {
			if(!res) return;
			window.location = "?url=pago";
		});
	})


})