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

		$('.tipo_medicamento').html(producto.des_tipo);
		$('.nombre_medicamento').html(producto.nombre);
		$('.descripcion_medicamento').html(producto.descripcion);
		$('.precio_bs').html(producto.p_venta);
		$('.codigo_producto').html(producto.cod_producto);
		$('.tipo_producto').html(producto.des_tipo);
		$('.contraindicaciones').html(producto.contraindicaciones);

	})

})