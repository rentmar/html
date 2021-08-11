$(document).ready(function () {
    $('.despliegue').DataTable({
        language: {
            search: "Buscar",
            info: "Mostrar _START_ / _END_ de _TOTAL_ entradas",
            lenghtMenu: "Mostrar _MENU_ registros",
            paginate: {
                first: "Inicio",
                previous: "Anterior",
                next: "Siguiente",
                last: "Fin",
            },
        }
    });

});
function lineaParaEditar  (idlinea,nombre){
	$('mdltxtidlinea').val(idlinea);
	$('mdltxtnombre').val(nombre);
}