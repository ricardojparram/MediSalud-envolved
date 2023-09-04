$(document).ready(function(){

    let permisos;
    $.ajax({method: 'POST', url: "", dataType: 'json', data: {getPermisos:'a'},
        success(data){ permisos = data; }
    }).then(rellenar(true));

    let mostrar
    function rellenar(bitacora = false){ 
        $.ajax({
            type: "post",
            url: "",
            dataType: "json",
            data: {mostrar: "labs", bitacora},
            success(data){
                let tabla;
                data.forEach(row => {
                    let editarPermiso = (permisos.editar != 1) ? 'disabled' : '';
                    tabla += `
                        <tr>
                            <td>${row.nombre}</td>
                            <td>${row.totales}</td>
                            <td class="d-flex justify-content-center">
                                <button type="button" id="${row.id}" ${editarPermiso} class="btn btn-dark modulos mx-2" data-bs-toggle="modal" data-bs-target="#modulos"><i class="bi bi-shield-lock-fill"></i></button>
                                <button type="button" id="${row.id}" ${editarPermiso} class="btn btn-dark permisos mx-2" data-bs-toggle="modal" data-bs-target="#permisos"><i class="bi bi-lock-fill"></i></button>
                            </td>
                        </tr>`;
                });
                $('#tabla tbody').html(tabla);
                mostrar = $('#tabla').DataTable({
                    resposive: true
                });
            }
        })

    }

    let id 

    $(document).on('click', '.modulos', function() {
        if(permisos.editar != 1){
            Toast.fire({ icon: 'error', title: 'No tienes permisos para esta acción.' });
            throw new Error('Permiso denegado.');
        }
        id = this.id; 
        $.ajax({
            method: "post",
            url: "",
            dataType: "json",
            data: {modulos:'xd', id},
            success(data){
                let contenido = "";
                data.forEach(row => {
                    let check = (row.status == 1) ? "checked" : "";
                    contenido += `
                    <div class="form-check form-switch col-lg-4 col-md-6">
                        <input class="form-check-input" type="checkbox" ${check} modulo_id="${row.id_modulo}" role="switch" id="modulo_${row.id_modulo}">
                        <label for="modulo_${row.id_modulo}" class="form-check-label">${row.nombre}</label>
                    </div>
                    `
                });
                $('#modulosForm').html(contenido);
            }

        })

    });

    $('#enviarModulos').click(()=>{
        let datos_modulos = [];
        $('#modulosForm input').each(function(){
            let id_modulo = $(this).attr('modulo_id'),
                status = (this.checked == true) ? 1 : 0;
            datos_modulos.push({id_modulo, status});
        })
        $.ajax({
            method: 'POST',
            url: "",
            dataType: 'json',
            data: {datos_modulos, id},
            success(data){
                if(data.respuesta == 'ok'){
                    Toast.fire({ icon: 'success', title: data.msg });
                    $('.cerrar').click();
                }
            }
        })    
    })

    $(document).on('click', '.permisos', function() {
        if(permisos.editar != 1){
            Toast.fire({ icon: 'error', title: 'No tienes permisos para esta acción.' });
            throw new Error('Permiso denegado.');
        }
        id = this.id; 
        $.ajax({
            method: "post",
            url: "",
            dataType: "json",
            data: {permisos:'xd', id},
            success(data){
                let contenido = "";
                data.forEach(row => {
                    let consultarCheck = (row.consultar == 1) ? "checked" : "",
                        registrarCheck = (row.registrar == 1) ? "checked" : "",
                        editarCheck = (row.editar == 1) ? "checked" : "",
                        eliminarCheck = (row.eliminar == 1) ? "checked" : ""
                    contenido += `
                    <div class="modulo_permiso col-6 row w-50 justify-content-center mb-4">
                      <p class="text-center col-12" id="${row.id_modulo}" ><b>${row.nombre}</b></p>
                      <div class="form-check form-switch col-12 col-lg-6 row justify-content-around">
                        <label class="form-check-label " for="consultar_${row.id_modulo}">Consultar</label>
                        <input class="form-check-input " type="checkbox" ${consultarCheck} role="switch" id="consultar_${row.id_modulo}">
                      </div>
                      <div class="form-check form-switch col-12 col-lg-6 row justify-content-around">
                        <label class="form-check-label " for="registrar_${row.id_modulo}">Registrar</label>
                        <input class="form-check-input " type="checkbox" ${registrarCheck} role="switch" id="registrar_${row.id_modulo}">
                      </div>
                      <div class="form-check form-switch col-12 col-lg-6 row justify-content-around">
                        <label class="form-check-label " for="editar_${row.id_modulo}">Editar</label>
                        <input class="form-check-input " type="checkbox" ${editarCheck} role="switch" id="editar_${row.id_modulo}">
                      </div>
                      <div class="form-check form-switch col-12 col-lg-6 row justify-content-around">
                        <label class="form-check-label " for="eliminar_${row.id_modulo}">Eliminar</label>
                        <input class="form-check-input " type="checkbox" ${eliminarCheck} role="switch" id="eliminar_${row.id_modulo}">
                      </div>
                    </div>
                    `
                });
                $('#permisosForm').html(contenido);
            }

        })

    });

    $('#enviarPermisos').click(()=>{
        let datos_permisos = [];
        $('.modulo_permiso').each(function(){
            let id_modulo = $(this).find('p')[0].id;

            let inputs = $(this).find('input[type="checkbox"]')
            let consultar = (inputs[0].checked == true) ? 1 : 0,
                registrar = (inputs[1].checked == true) ? 1 : 0,
                editar = (inputs[2].checked == true) ? 1 : 0,
                eliminar = (inputs[3].checked == true) ? 1 : 0;

            datos_permisos.push({id_modulo, consultar, registrar, editar, eliminar});

        })

        $.ajax({
            method: 'POST',
            url: "",
            dataType: 'json',
            data: {datos_permisos, id},
            success(data){
                if(data.respuesta == 'ok'){
                    Toast.fire({ icon: 'success', title: data.msg });
                    $('.cerrar').click();
                }else{
                    Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
                }
            }
        })    
    })



})