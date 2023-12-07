$(document).ready(function(){

  let tiempoNotificacion = 1800000; 
  let tiempoDelete = 1740000;

  localStorage.clear()

  function redondear(numero) {
    const parteEntera = Math.floor(numero);
    const parteDecimal = numero - parteEntera;

    if (parteDecimal === 0.5) {
      return parteEntera + 1;
    }

    const redondeo = Math.round(numero);
    return redondeo === 0 ? 1 : redondeo;
  }

  if(localStorage.getItem('porVencer') && localStorage.getItem('vencidos') && localStorage.getItem('diaDeInventario')){
    let porVencidoGuardado = JSON.parse(localStorage.getItem('porVencer'));
    let vencidosGuardados = JSON.parse(localStorage.getItem('vencidos'));
    let diaDeInventarioGuardado = JSON.parse(localStorage.getItem('diaDeInventario'));

    // Hacer algo con los datos guardados, por ejemplo:
    console.log('porVencer guardado: ', porVencidoGuardado);
    console.log('vencidos guardados: ', vencidosGuardados);
    console.log('diaDeInventario guardado: ', diaDeInventarioGuardado);

    mostrarNotificaciones(porVencidoGuardado , vencidosGuardados, diaDeInventarioGuardado);

   }

  notificaciones();
     
  function notificaciones(){
    $.ajax({
      type: 'POST',
      url:  '',
      dataType: 'json',
      data: {notificacion : 'notificacion'},
      success(data){
        console.log(data && data.PorVencer && data.vencidos)
        if(data && data.PorVencer && data.vencidos && data.diaDeInventario){
          mostrarNotificaciones(data.PorVencer, data.vencidos ,data.diaDeInventario);
        }else {
          throw new Error('Error al obtener datos de notificación');
        }
      }, 
      error: function(qXHR, textStatus, errorThrown){
        console.error('Error al obtener datos de notificación:', textStatus, errorThrown);
      }

    })


  }

  setInterval(notificaciones, tiempoNotificacion);

  setInterval(()=>{
    localStorage.removeItem('porVencer');
    localStorage.removeItem('vencidos');
    localStorage.removeItem('diaDeInventario')
    $('.notification-item').remove();
    $('.contador').text(0);
    $('.numNoti').text(0);
  }, tiempoDelete);

   function mostrarNotificaciones(porVencer, vencidos , diaDeInventario) {
    let mostrar = '';
    let mostrar1 = '';
    let mostrar2 = '';
    let contador = 0;
    let contador1 = 0;
    let contador2 = 0;

    porVencer.forEach((row)=> {
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
        <div class="col fs-5 text-end NotiButton">
          <a class="leido btn-sm" href="#">Marcar como leido</a>
        </div>
      </div>
      </li>

      <li class='divisor'>
        <hr class="dropdown-divider">
      </li>

      `;
      contador++;
    });

    vencidos.forEach((row)=> {
      let minutos = 0;
      let tiempoMinutos = 60000;
      const actualizaMinutos = function() {
        minutos++;
        $('.notification-item .tiempo').text(`Tiempo activo: ${minutos} minutos`);
      };
      setInterval(actualizaMinutos, tiempoMinutos);
      mostrar1 += `
      <li class="notification-item notificacion w-100">
        <div class="row">
          <div class="col-md-12">
          <div class="d-flex justify-content-between">
            <div class="text-center mt-3">
              <i class="bi bi-x-circle text-danger"></i>
             </div>
            <div>
              <h4>Productos vencidos</h4>
              <p>El producto: ${row.nombre} expiro hace ${Math.abs(row.dias_vencidos)} dias</p>
              <p class='tiempo'>tiempo activo: ${minutos} minutos</p>
            </div>
           </div>
          </div>
          <div class="col fs-5 text-end NotiButton">
            <a class="leido btn-sm" href="#">Marcar como leido</a>
          </div>
          </div>
        </li>

        <li class='divisor'>
          <hr class="dropdown-divider">
        </li>
      `;
      contador1++;
    });

    diaDeInventario.forEach((row)=>{
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
          <div class="col fs-5 text-end NotiButton">
           <a class="leido btn-sm" href="#">Marcar como leido</a>
          </div>
        </div>

      </li>

        <li class='divisor'>
           <hr class="dropdown-divider">
        </li>
      `;
      contador2++;
    })

    const total = contador + contador1 + contador2;

    $('.notifications .item').append(mostrar);
    $('.notifications .item').append(mostrar1);
    $('.notifications .item').append(mostrar2);
    $('.contador').text(total);
    $('.numNoti').text(total);

    localStorage.setItem('porVencer', JSON.stringify(porVencer));
    localStorage.setItem('vencidos', JSON.stringify(vencidos));
    localStorage.setItem('diaDeInventario', JSON.stringify(diaDeInventario));

  }

  $(document).on('click' , '.leido' , function(e){
    e.preventDefault()
    console.log('hola');

    const selectedNotification = $(this).closest('.notification-item');
    let divisor = selectedNotification.next('.divisor');

    selectedNotification.removeClass('notificacion').addClass('notificacion-visto');
    selectedNotification.find('.leido').remove();
    divisor.remove()
    $('.itemVisto').prepend(selectedNotification);
    $('.itemVisto').prepend('<li class="divisor"><hr class="dropdown-divider"></li>');
  })

  
})
