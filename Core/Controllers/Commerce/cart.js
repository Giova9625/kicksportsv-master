// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_PEDIDOS = '../../Core/Api/Commerce/pedido.php?action=';
//Api para hacer funcionar el combobox por medio de la funcion readall
const API_TALLA = '../../Core/Api/Commerce/detalle.php?action=readAll';

// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se llama a la función que obtiene los productos del carrito de compras para llenar la tabla en la vista.
    readCart();


     //Se llama a la funcion fill select procedente del archivo components.js para poder llenar un select
    //El llenado del select se realiza al momento del document ready para que asi se inicialice junto a la vista
    fillSelect( API_TALLA, 'talla', null );
});

// Función para obtener el detalle del pedido (carrito de compras).
function readCart()
{   
    $.ajax({
        dataType: 'json',
        url: API_PEDIDOS + 'readCart'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje y se direcciona a la página principal.
        if ( response.status ) {
            // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
            let content = '';
            // Se declara e inicializa una variable para calcular el importe por cada producto.
            let subtotal = 0;
            // Se declara e inicializa una variable para ir sumando cada subtotal y obtener el monto final a pagar.
            let total = 0;
            // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                subtotal = row.precio * row.cantidad;
                total += subtotal;
                // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                content += `
                    <tr>
                        <td>${row.producto}</td>
                        <td>${row.marca}</td>
                        <td>${row.talla}</td>
                        <td>${row.precio}</td>
                        <td>${row.cantidad}</td>
                        <td>${subtotal.toFixed(2)}</td>
                        <td>
                            <a href="#" onclick="openUpdateDialog(${row.id_detalle}, ${row.cantidad})" class="btn waves-effect cyan darken-3 tooltipped" data-tooltip="Editar Detalle"><i class="material-icons">edit</i></a>
                            <a href="#" onclick="openDeleteDialog(${row.id_detalle})" class="btn waves-effect orange tooltipped" data-tooltip="Remover"><i class="material-icons">remove_shopping_cart</i></a>
                        </td>
                    </tr>
                `;
            });
            // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
            $( '#tbody-rows' ).html( content );
            // Se muestra el total a pagar con dos decimales.
            $( '#pago' ).text( total.toFixed(2) );
            // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
            $( '.tooltipped' ).tooltip();
        } else {
            sweetAlert1( 4, response.exception, 'index.php' );
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

// Función que abre una caja de dialogo (modal) con formulario para modificar la cantidad de producto.
function openUpdateDialog( id, quantity )
{
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    $( '#item-modal' ).modal( 'open' );
    // Se inicializan los campos del formulario con los datos del registro seleccionado previamente.
    $( '#id_detalle' ).val( id );
    $( '#cantidad' ).val( quantity );
   
    
    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
    M.updateTextFields();
}

// Evento para cambiar la cantidad de producto.
$( '#item-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: API_PEDIDOS + 'updateDetail',
        data: $( '#item-form' ).serialize(),
        dataType: 'json'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            // Se actualiza la tabla en la vista para mostrar la modificación de la cantidad de producto.
            readCart();
            // Se cierra la caja de dialogo (modal).
            $( '#item-modal' ).modal( 'close' );
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

// Función que abre una caja de dialogo para confirmar la finalización del pedido.
function finishOrder()
{
    swal({
        title: 'Aviso',
        text: '¿Está seguro de finalizar el pedido?',
        icon: 'info',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function( value ) {
        // Se verifica si fue cliqueado el botón Sí para realizar la petición respectiva, de lo contrario no se hace nada.
        if ( value ) {
            $.ajax({
                type: 'post',
                url: API_PEDIDOS + 'finishOrder',
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
        }
    });
}

//funcion combobox
function getTalla(){
    $.ajax({
        url: API_PEDIDOS + 'getTalla',
        type: 'post',
        dataType: 'json',
        success: function (response) {
            let jsonResponse = response.dataset;
            let dropDown = $('#talla').html();

            jsonResponse.forEach(talla => {
                dropDown += `
                    <option value="${talla.id_talla}">${talla.talla}</option>
                `;
            });

            $('#talla').html(dropDown);
        },
        error: function (jqXHR) {
            // Se verifica si la API ha respondido para mostrar la respuesta, de lo contrario se presenta el estado de la petición.
            if (jqXHR.status == 200) {
                console.log(jqXHR.responseText);
            } else {
                console.log(jqXHR.status + ' ' + jqXHR.statusText);
            }
        }
    });
}

// Función que abre una caja de dialogo para confirmar la eliminación de un producto del carrito de compras.
function openDeleteDialog( id )
{
    swal({
        title: 'Advertencia',
        text: '¿Está seguro de remover el producto?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function( value ) {
        // Se verifica si fue cliqueado el botón Sí para realizar la petición respectiva, de lo contrario no se hace nada.
        if ( value ) {
            $.ajax({
                type: 'post',
                url: API_PEDIDOS + 'deleteDetail',
                data: { id_detalle: id },
                dataType: 'json'
            })
            .done(function( response ) {
                // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
                if ( response.status ) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de borrar un producto del pedido.
                    readCart();
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
        }
    });
}