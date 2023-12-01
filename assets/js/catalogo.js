$(document).ready(function(){

	async function getProductosBD(){
		await $.post('',{mostrarCatalogo: ''}, function(res){
				let productos = JSON.parse(res).reduce((acc, curr) => {
					acc[curr.cod_producto] = curr;
					return acc;
				}, {});
	            localStorage.setItem('productos', JSON.stringify(productos));
			})
	}
	const getProductos = () => JSON.parse(localStorage.getItem('productos'));
	const getProdDetalle = (id) => {let prod = getProductos(); return prod[`${id}`] }

	getProductosBD().then(() => {
		mostrarCategorias().then(() => {
			validarCategoria();
			$(".categorias_check").click(function(){ filtrarCategoria(this.id) })
		})
		mostrarCatalogo(getProductos())
	})


	function mostrarCategorias(){
		return $.ajax({type: 'POST',url: '',dataType: 'json',data:{mostrarCategorias: ''},
			success(res){
				let categorias = `
				<span>
					<input type="radio" class="btn-check categorias_check" name="options-outlined" id="todas_las_categorias">
					<label class="btn btn-sm btn-outline-dark" for="todas_las_categorias">Todos</label>
				</span>
				`;
				res.forEach((categoria) => {
					categorias += `
					<span>
						<input type="radio" class="btn-check categorias_check" name="options-outlined" id="${categoria.des_clase}">
						<label class="btn btn-sm btn-outline-dark" for="${categoria.des_clase}">${categoria.des_clase}</label>
					</span>
					`
				})
				$('.categorias').html(categorias);
			}
		})
	}

	function mostrarCatalogo(products){
				let mostrar = '';
	            for(let i in products){
	             	mostrar += `
		            <div class="product-container">
		              <div class="card-product position-relative">
		                <div class="card-body">
		                  <div class="text-center position-relative">
		                    <img src="${products[i].img}" alt="Imagen del producto" class="mb-3 img-fluid">
		                    <small class="text-warning position-absolute bottom-0 end-0">
		                      <i class="bi bi-star-fill"></i>
		                      <i class="bi bi-star-fill"></i>
		                      <i class="bi bi-star-fill"></i>
		                      <i class="bi bi-star-fill"></i>
		                      <i class="bi bi-star-half"></i>
		                    </small>
		                  </div>
		                  <div class="text-small mb-1">
		                    <a href="#!" class="text-decoration-none text-muted" tabindex="0"><small>${products[i].des_clase}</small></a>
		                  </div>
		                  <h2 class="fs-6">${products[i].nombre}</h2>
		                  <!-- rating -->

		                  <div class="d-flex justify-content-between align-items-center mt-3">
		                    <div>
		                      <span class="text-dark">Bs. ${products[i].p_venta}</span><span class="text-muted"> $5</span>
		                    </div>
		                    <!-- btn -->
		                    <button id_prod="${products[i].cod_producto}" class="btn btn-sm btn-success text-white mostrarCatalogo" data-bs-toggle="modal" data-bs-target="#AñadirCarritoModal">
		                      <strong>Comprar </strong><i class="fs-7 text-white bi bi-cart-plus-fill"></i> 
		                    </button>
		                  </div>
		                </div>
		              </div>
		            </div>
	             	`;
	            }
	            $('.catalogoProductos').html(mostrar);
			}
		// })
	// }

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

	})

	
	let params = new URLSearchParams(document.location.search)
	function validarCategoria(){ 
		let tipo_catalogo = params.get("tipo");

		if(tipo_catalogo == null || tipo_catalogo == ""){
			$('#todas_las_categorias').attr("checked", "");
			return filtrarCategoria("todas_las_categorias");
		}

		if(document.getElementById(tipo_catalogo) == null) return;

		$(`#${tipo_catalogo}`).attr("checked", "");
		filtrarCategoria(tipo_catalogo)
		
	}

	function filtrarCategoria(categoria){
		if(categoria === "todas_las_categorias"){
			params.delete("tipo")
		}else{
			params.set('tipo', categoria)
		}
		window.history.pushState(null, "", `?${params.toString()}`);
		let products = getProductos();

		if(categoria === "todas_las_categorias") return mostrarCatalogo(products);

		let result = Object.fromEntries(Object.entries(products).filter(row => row[1].des_clase === categoria));
		mostrarCatalogo(result);
	}


})