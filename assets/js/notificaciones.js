$(document).ready(function(){
  let tiempoNotificacion = 1800000; 
  let tiempoDelete = 60000

  notificaciones();

  function notificaciones(){
      $.ajax({
        type: 'POST',
        url:  '',
        dataType: 'json',
        data: {notificacion : 'notificacion'},
        success(data){
          let mostrar = '';
          let mostrar1 = '';
          let porVencer = data.PorVencer;
          let vencidos = data.vencidos;

          let contador = 0;
          let contador1 = 0;
          let minutos = 0;
          let tiempoMinutos = 60000;
          const actualizaMinutos = () => {
            minutos++;
            $('.notification-item .tiempo').text(`Tiempo activo: ${minutos} minutos`);
          }

          porVencer.forEach(row =>{     
            setInterval(actualizaMinutos , tiempoMinutos)
            mostrar += `
            <li class="notification-item w-100">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
            <h4>Productos por expirar</h4>
            <p>Faltan ${row.dias_restantes} dias para el expire el producto: ${row.nombre} </p>
            <p class='tiempo'>tiempo activo: ${minutos} minutos</p>
            </div>
            </li> `
            contador++;
          })

          vencidos.forEach(row =>{
           setInterval(actualizaMinutos , tiempoMinutos);
           mostrar1 += `
           <li class="notification-item w-100">
           <i class="bi bi-x-circle text-danger"></i>
           <div>
           <h4>Productos vencidos</h4>
           <p>Van ${row.dias_vencidos} dias expirado el producto: ${row.nombre} </p>
           <p class='tiempo'>tiempo activo: ${minutos} minutos</p>
           </div>
           </li> `
           contador1++;
         })

          total = contador + contador1;

          $('.notifications .item').append(mostrar);
          $('.notifications .item').append(mostrar1);
          $('.contador').text(total);
          $('.numNoti').text(total);

          setTimeout(()=>{
          $('.notification-item').remove();
          $('.contador').text(0);
          $('.numNoti').text(0);
          }, tiempoDelete);
        }
      })
    
  }

  setInterval(notificaciones, tiempoNotificacion);
})
