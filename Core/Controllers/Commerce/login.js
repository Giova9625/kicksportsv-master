// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CLIENTE = '../../Core/Api/Commerce/cliente.php?action=';

$( document ).ready(function() {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
 
  
    
});

// Evento para validar el cliente al momento de iniciar sesión.
$( '#session-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: API_CLIENTE + 'login',
        data: $( '#session-form' ).serialize(),
        dataType: 'json'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            sweetAlert1( 1, response.message, 'index.php' );
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

      /*
    *   Hecho por Juan, esto es el controlador del login.
    */

    // Evento para validar la recuperacion de contraseña.
    $( '#res-password-form' ).submit(function( event ) {
        // Se evita recargar la página web después de enviar el formulario.
        event.preventDefault();
        $.ajax({
            type: 'post',
            url: API_CLIENTE + 'recuperar',
            data: $( '#res-password-form' ).serialize(),
            dataType: 'json'
        })
        .done(function( response ) {
            // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
            if ( response.status ) {
                // Se cierra la caja de dialogo (modal) que contiene el formulario para cambiar contraseña, ubicado en el archivo de las plantillas.
                $( '#res-password-modal' ).modal( 'close' );
                sweetAlert1( 1, response.message, null );
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