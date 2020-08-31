// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CATALOGO = '../../Core/Api/Commerce/catalogo.php?action=';
const API_PEDIDOS = '../../Core/Api/Commerce/pedido.php?action=';
//Api para hacer funcionar el combobox por medio de la funcion readall
const API_TALLA = '../../Core/Api/Commerce/detalle.php?action=readAll';

// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se busca en la URL las variables (parámetros) disponibles.
    let params = new URLSearchParams( location.search );
    // Se obtienen los datos localizados por medio de las variables.
    const ID = params.get( 'id' );
    // Se llama a la función que muestra el detalle del producto seleccionado previamente.
    readOneProducto( ID );

    //Se llama a la funcion fill select procedente del archivo components.js para poder llenar un select
    //El llenado del select se realiza al momento del document ready para que asi se inicialice junto a la vista
    fillSelect( API_TALLA, 'talla', null );
});

// Función para obtener y mostrar los datos del producto seleccionado.
function readOneProducto( id )
{
    $.ajax({
        dataType: 'json',
        url: API_CATALOGO + 'readOneProducto',
        data: { id_producto: id },
        type: 'post'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se muestra un mensaje de error en pantalla.
        if ( response.status ) {
            // Se colocan los datos en la tarjeta de acuerdo al producto seleccionado previamente.
            $( '#imagen_producto' ).prop( 'src', '../../resources/img/productos/' + response.dataset.imagen_producto );
            $( '#producto' ).text(response.dataset.producto);
            $( '#descripcion' ).text(response.dataset.descripcion);
            $( '#precio' ).text(response.dataset.precio);
            // Se asignan los valores a los campos ocultos del formulario.
            $( '#id_producto').val(response.dataset.id_producto);
            $( '#cost').val(response.dataset.precio);
        } else {
            // Se presenta un mensaje de error cuando no existen datos para mostrar.
            $( '#title' ).html( `<i class="material-icons small">cloud_off</i><span class="red-text">${response.exception}</span>` );
            // Se limpia el contenido del div sino existen datos para mostrar.
            $( '#detalle' ).html( '' );
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
}

// Evento para agregar un producto al carrito de compras. se encuentra en la vista del detalle
$( '#shopping-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: API_PEDIDOS + 'createDetail',
        data: $( '#shopping-form' ).serialize(),
        dataType: 'json'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje.
        
        if ( response.status ) {
            sweetAlert1( 1, response.message, 'cart.php' );
        } else {
            // Se verifica si el usuario ha iniciado sesión para mostrar algún error ocurrido, de lo contrario se direcciona para que se autentique. 
            if ( response.session ) {
                sweetAlert1( 2, response.exception, null );
            } else {
                sweetAlert1( 3, response.exception, 'login.php' );
            }
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