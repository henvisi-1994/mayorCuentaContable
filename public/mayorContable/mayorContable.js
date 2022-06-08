$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('document').ready(function () {
   $('#frmDiarioMayor').on('submit', buscar);
});
function buscar(event) {
    event.preventDefault();
    var data = new FormData($('#frmDiarioMayor').get(0));
    let html='';
    let i=0;
    $('#diarios').empty();
    //metodo ajax para buscar los datos en la base de datos  en la base de datos
    $.ajax({
        url: 'mayorCuentaContable',
        type: 'POST',
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#aniofisc').val(response.anio_fiscal);
            $('#nom_cuenta').val(response.nombre_cuenta);
            $.each(JSON.parse(response.data), function (key, value) {
                i++;
                html += `<tr>
                <th scope="row">${i}</th>
                <td >${value.diario}</td>
                <td>${value.fecha}</td>
                <td>${value.ref}</td>
                <td>${value.debito}</td>
                <td>${value.credito}</td>
                <td>${value.saldo}</td>
                <td colspan="2">${value.detalle}</td>
            </tr>   `
            });
            $('#diarios').html(html);
        } //fin success
    }); //fin ajax
}
