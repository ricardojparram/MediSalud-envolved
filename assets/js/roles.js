$(document).ready(function(){

    let permisos;
    $.ajax({method: 'POST', url: "", dataType: 'json', data: {getPermisos:''},
        success : (data) => permisos = data
    }).then(() => rellenar(true));

    let mostrar, permisoModificar;
    function rellenar(bitacora = false){
        $.ajax({
            type: "post",
            url: "",
            dataType: "json",
            data: {mostrar: "", bitacora},
            success(data){
                let tabla;
                permisoModificar = (typeof permisos["Modificar acciones"] === "undefined" && typeof permisos["Modificar acceso"] === "undefined") ? 'disabled' : '';
                data.forEach(row => {
                    tabla += `
                        <tr>
                            <td>${row.nombre}</td>
                            <td>${row.totales}</td>
                            <td class="d-flex justify-content-center">
                                <button type="button" id="${row.id}" ${permisoModificar} class="btn btn-dark asignar_permisos mx-2" data-bs-toggle="modal" data-bs-target="#permisos"><i class="bi bi-shield-lock-fill"></i></button>
                            </td>
                        </tr>`;
                });
                $('#tabla tbody').html(tabla);
                mostrar = $('#tabla').DataTable({
                    resposive: true
                });
            },
            error(e){
                Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
                throw new Error('Error al mostrar listado: '+e);
            }
        })

    }

    const icons = {
        Consultar : '<i class="bi bi-eye-fill"></i>',
        Registrar : '<i class="bi bi-plus-circle-fill"></i>',
        Editar : '<i class="bi bi-pencil-fill"></i>',
        Eliminar: '<i class="bi bi-trash-fill"></i>',
        "Modificar acciones" : '<i class="bi bi-pencil-fill"></i>',
        "Modificar acceso" : '<i class="bi bi-eye-slash-fill"></i>',
        "Exportar reporte" : '<i class="bi bi-file-pdf"></i>',
        "Exportar reporte estadistico" : '<i class="bi bi-file-spreadsheet"></i>'
    }

    let id 

    $(document).on('click', '.asignar_permisos', function() {
        if(permisoModificar === "disabled"){
            Toast.fire({ icon: 'error', title: 'No tienes permisos para esta acción.' });
            throw new Error('Permiso denegado.');
        }
        id = this.id; 
        $.ajax({
            method: "post", url: "", dataType: "json", data: {mostrar_permisos:"", id},
            success(data){
                let tabla = "";
                Object.entries(data).forEach(([modulo_nombre, row]) => {
                    let permisos = "";
                    Object.entries(row).forEach(([nombre_permiso, permiso]) => {
                        let checked = (permiso.status === "1") ? "checked" : "";
                        let title = (nombre_permiso == "Consultar") ? "Acceso" : nombre_permiso;
                        permisos += `
                        <div title="${title}" class="d-flex px-3 flex-column justify-content-center align-items-center">
                            <label for="${permiso.id_permiso}">${icons[nombre_permiso]}</label>
                            <input class="form-check-input " ${checked} type="checkbox" id="${permiso.id_permiso}">
                        </div>
                        `
                    })
                    tabla += `
                        <tr>
                            <td class="text-center align-middle">${modulo_nombre}</td>
                            <td>
                                <div class="d-flex  justify-content-center align-items-center">
                                    ${permisos}
                                </div>
                            </td>
                        </tr>
                    `
                })
                $('#tabla_permisos').html(tabla);
                
            },
            error(e){
                Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
                throw new Error('Error al mostrar listado: '+e);
            }

        })

    });


    $('#enviarPermisos').click(()=>{
        let datos_permisos = [];
        $('#tabla_permisos td input').each(function(i){
            let input_permiso = $(this)[0];
            datos_permisos[i] = {id_permiso : input_permiso.id, status : input_permiso.checked}
        })
       $.ajax({
            method: "post", url: "", dataType: "json", data: {datos_permisos, id},
            success(data){
                if(data.respuesta === "ok"){
                    Toast.fire({ icon: 'success', title: data.msg });
                    $('.cerrar').click();
                }else{
                    Toast.fire({ icon: 'error', title: 'Hubo un error al modificar los permisos.' });
                    throw new Error('Error al mostrar listado: '+data.msg);
                }
            },
            error(e){
                Toast.fire({ icon: 'error', title: 'Ha ocurrido un error.' });
                throw new Error('Error al mostrar listado: '+e);
            }
       })
    })

})