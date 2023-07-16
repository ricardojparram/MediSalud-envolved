$(document).ready(function(){
    let tabla;
    rellenar();
    function rellenar(){
        $.ajax({
            method: "post",
            url: '',
            dataType: 'JSON',
            data: {mostrar: "xd"},
            success(list){
                console.log(list);
                tabla = $("#tabla").DataTable({
                    responsive: true,
                    data: list
                });
            }
        })
    }
})