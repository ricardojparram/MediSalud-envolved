$(document).ready(function(){

    rellenar(true);
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
                    console.log(row)
                    tabla += `
                        <tr>
                            <td>${row.nombre}</td>
                            <td>${row.totales}</td>
                            <td class="d-flex justify-content-center">
                                <button type="button" id="${row.id}" class="btn btn-dark modulos mx-2" data-bs-toggle="modal" data-bs-target="#modulos"><i class="bi bi-shield-lock-fill"></i></button>
                                <button type="button" id="${row.id}" class="btn btn-dark permisos mx-2" data-bs-toggle="modal" data-bs-target="#permisos"><i class="bi bi-lock-fill"></i></button>
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
        id = this.id; 
        $.ajax({
            method: "post",
            url: "",
            dataType: "json",
            data: {modulos:'xd', id},
            success(data){
                let contenido = "";
                data.forEach(row => {
                    let check = (row.status = 1) ? "checked" : "";
                    contenido += `
                    <div class="form-check form-switch col-lg-4 col-md-6">
                        <input class="form-check-input" type="checkbox" ${check} role="switch" id="${row.id_modulo}">
                        <label class="form-check-label" for="${row.id_modulo}">${row.nombre}</label>
                    </div>
                    `
                });
                $('#modulosForm').html(contenido);
            }

        })

    });

    $('#enviarModulos').click(()=>{
        let datos = $('#modulosForm input').map(input => { console.log(input.val())});
        console.log(datos);
    })

})