// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CLIENTE = '../../Core/Api/Commerce/cliente.php?action=';


// Evento para realizar el registro de un cliente.
$( '#register-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    $.ajax({
        type: 'post',
        //Metodo para llamar el case 'register' de la api
        url: API_CLIENTE + 'register',
        data: $( '#register-form' ).serialize(),
        dataType: 'json'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            sweetAlert1( 1, response.message, 'login.php' );
        } else {
            sweetAlert1( 2, response.exception, null );
        }
    })
    .fail(function( jqXHR ) {
        // Se verifica si la API ha respondido para mostrar la respuesta, de lo contrario se presenta el estado de la petición.
        if ( jqXHR.status == 200 ) {
            console.log( jqXHR.responseText );
        } else {
            console.log( jqXHR.status + ' ' + jqXHR.statusText );
        }
    });
});