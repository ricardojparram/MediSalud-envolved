$(document).ready(function(){

  let tiempo_para_repetir_peticion = 1800000; 
  if('noti_info' in localStorage === false){
    localStorage.setItem('noti_info', JSON.stringify({ noti_cantidad: 0, leidos: 0 }))
  }

  const getNotiInfo = () => JSON.parse(localStorage.getItem('noti_info'));
  const setNotiInfo = noti_info => localStorage.setItem('noti_info', JSON.stringify(noti_info))
  const getLeidos = () => JSON.parse(localStorage.getItem('noti_info')).leidos;
  const setLeidos = (leidos) => {
    let noti_info = getNotiInfo(); noti_info.leidos = leidos; setNotiInfo(noti_info);
  }
  const getNotiCantidad = () => JSON.parse(localStorage.getItem('noti_info')).noti_cantidad;
  const setNotiCantidad = (noti_cantidad) => {
    let noti_info = getNotiInfo(); noti_info.noti_cantidad = noti_cantidad; setNotiInfo(noti_info);
  }


  getNotificaciones();
  function getNotificaciones(){
    $.ajax({ type: 'POST', url:  '?url=notificaciones', dataType: 'json', data: {notificacion : ''},
      success(data){
        mostrarNotificaciones(data.productos_stock_bajo, data.productos_vencidos, data.dia_de_inventario);
        
      }, 
      error(qXHR, textStatus, errorThrown){
        throw new Error('Error al obtener datos de notificación:', textStatus, errorThrown);
      }
    })
  }

  setInterval(getNotificaciones, tiempo_para_repetir_peticion);

  function mostrarNotificaciones(productos_stock_bajo, productos_vencidos, dia_de_inventario) {
    let mostrar = '', mostrar1 = '', mostrar2 = '';
    let count_stock_bajo = 0, count_vencidos = 0, count_dia_inventario = 0;

    productos_stock_bajo.forEach((row)=> {
      let minutos = 0;
      let tiempoMinutos = 60000;
      const actualizaMinutos = function() {
        minutos++;
        $('.notification-item .tiempo').text(`Tiempo activo: ${minutos} minutos`);
      };
      setInterval(actualizaMinutos, tiempoMinutos);
      mostrar += `
      <li class="notification-item notificacion w-100">
      <div class="row">
       <div class="col-md-12">
        <div class="d-flex justify-content-between">
          <div class="text-center mt-3">
            <i class="bi bi-exclamation-circle text-warning"></i>
          </div>
          <div class="mx-2">
            <h4>Productos por expirar</h4>
            <p>Faltan ${row.dias_restantes} días para que expire el producto: ${row.nombre}</p>
            <p class='tiempo'>Tiempo activo: ${minutos} minutos</p>
          </div>
          </div>
        </div>
      </div>
      </li>

      <li class='divisor'>
        <hr class="dropdown-divider">
      </li>

      `;
      count_stock_bajo++;
    });

    productos_vencidos.forEach((row)=> {
      let minutos = 0;
      let tiempoMinutos = 60000;
      const actualizaMinutos = function() {
        minutos++;
        $('.notification-item .tiempo').text(`Tiempo activo: ${minutos} minutos`);
      };
      setInterval(actualizaMinutos, tiempoMinutos);
      mostrar1 += `
        <li class="notification-item notificacion">
          <div class="row">
            <div class="col-md-12">
              <div class="d-flex justify-content-between">
                <div class="text-center mt-3">
                  <i class="bi bi-x-circle text-danger"></i>
                </div>
                <div>
                  <h4>Producto vencido</h4>
                  <p>El producto: ${row.nombre} expiro hace ${Math.abs(row.dias_vencidos)} dias</p>
                  <p class='tiempo'>tiempo activo: ${minutos} minutos</p>
                </div>
              </div>
            </div>
          </div>
        </li>

        <li class='divisor'>
          <hr class="dropdown-divider">
        </li>
      `;
      count_vencidos++;
    });

    dia_de_inventario.forEach((row)=>{
      let minutos = 0
      let tiempoMinutos = 60000
      const actualizaMinutos = function() {
        minutos++;
        $('.notification-item .tiempo').text(`Tiempo activo: ${minutos} minutos`);
      };
      setInterval(actualizaMinutos, tiempoMinutos);
      mostrar2 += `
      <li class="notification-item notificacion w-100">
        <div class="row">
          <div class="col-md-12">
            <div class="d-flex justify-content-between">
              <div class="text-center mt-3">
                <i class="bi bi-exclamation-circle text-warning"></i>
              </div>
              <div>
                <h4>Dia de Inventario: ${Number(row.dia_inventario).toFixed(2)}</h4>
                <p>Stock Producto: ${row.stock}</p>
                <p>Quedan ${ (row.stock / row.dia_inventario).toFixed(0) } dias de inventario del producto: <strong>${row.descripcion}</strong> </p>
                <p class='tiempo'>tiempo activo: ${minutos} minutos</p>
              </div>
            </div>
          </div>
        </div>

      </li>

        <li class='divisor'>
           <hr class="dropdown-divider">
        </li>
      `;
      count_dia_inventario++;
    })

    let total_notificaciones = count_stock_bajo + count_vencidos + count_dia_inventario;

    setNotiCantidad(total_notificaciones);

    if(getLeidos() == total_notificaciones) total_notificaciones = 0;
    if(getLeidos() < total_notificaciones) total_notificaciones = total_notificaciones - getLeidos();

    $('.notifications .item').append(mostrar);
    $('.notifications .item').append(mostrar1);
    $('.notifications .item').append(mostrar2);
    $('.contador').text(total_notificaciones);
    $('.numNoti').text(getNotiCantidad);

  }

  $('.notification_icon').click(function(){
    document.body.addEventListener('click', restaurarNotis);
  })

  function restaurarNotis(event) {
    if (!event.target.closest('a')) {
      $('.contador').html(0);
      setLeidos(getNotiCantidad());
      document.body.removeEventListener('click', restaurarNotis);
    }
  }

  
})
