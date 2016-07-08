/**
 * Created by Carlos on 8/07/2016.
 */
$('#formCube').on('submit', function (e) {
    e.preventDefault();
    var input = $('#input').val();
    var token = $('#_token').val();
    var url = this.action;
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        data: {input},
        dataType: "json",
        success: function (data) {
            // console.log(data);
            $('#result').val(data.output);
            $("#msg-success").fadeIn();
            $("#msg-success").fadeOut(5000);
        },
        error: function (data) {
            // console.log(data);
            if (data.status == 500) {
                $('#result').val("");
                $("#tittle").text("Error de formato de entrada");
                $('.modal-body').append('<div> <ul> <strong>Whoops!</strong> El error puede estar relacionado con:' +
                    '<br><br>' +
                    '<li>No sé está procesando el número de casos de prueba indicado por la variable T (Primera linea de le entrada)</li>' +
                    '<li>No sé está procesando el número de operaciones indicadas por la variable M ( Primera linea y segunda variable de cada caso)</li>' +
                    '</ul></div>');
                $('#show').modal('toggle');
            } else {
                $('#result').val("");
                $("#tittle").text(data.responseJSON.tittle);
                $('.modal-body').html(data.responseJSON.html);
                $('#show').modal('toggle');
            }
        },

    });
    $('.modal-body div').remove();
});