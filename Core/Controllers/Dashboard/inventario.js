// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_INVENTARIO = '../../Core/Api/Dashboard/inventario.php?action=readAll';
const API_PRODUCTOS = '../../Core/Api/Dashboard/productos.php?action=';
const API_TALLAS = '../../Core/Api/Dashboard/tallas.php?action=readAll';



// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows( API_INVENTARIO );
   
    fillSelect( API_PRODUCTOS, 'producto', null );
    fillSelect( API_TALLAS, 'talla', null );
});

// Función para llenar la tabla con los datos enviados por readRows().
function fillTable( dataset )
{
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.forEach(function( row ) {
        // Se establece un icono para el estado del producto.
        
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td><img src="../../resources/img/productos/${row.imagen_producto}" class="materialboxed" height="100"></td>
                <td>${row.producto}</td>
                <td>${row.descripcion}</td>
                <td>${row.precio}</td>
                <td>${row.talla}</td>
                <td>${row.genero}</td>
                <td>${row.cantidad}</td>

                <td>
                <a href="#" onclick="openUpdateModal(${row.id_existencia})"  class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"> <i class="zmdi zmdi-edit"></i></a>
                <a href="#" onclick="openDeleteDialog(${row.id_existencia})"  class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"> <i class="zmdi zmdi-delete"></i></a> 
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediantssse su id para mostrar los registros.
    $( '#tbody-rows' ).html( content );
    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
   // $( '.materialboxed' ).materialbox();
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    //$( '.tooltipped' ).tooltip();
}

// Evento para mostrar los resultados de una búsqueda.
$( '#search-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows( API_INVENTARIO, this );
});
var dialog1 = document.querySelector('#crtdialog');
// Función que prepara formulario para insertar un registro.
function openCreateModal()
{
    // Se limpian los campos del formulario.
    $( '#crtform' )[0].reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    
    dialog1.showModal();
    // Se llama a la función que llena el select del formulario. Se encuentra en el archivo components.js
    fillSelect( API_TALLAS, 'talla1', null );
    fillSelect( API_PRODUCTOS, 'producto1', null );
}
var dialog2 = document.querySelector('#uptdialog');
// Función que prepara formulario para modificar un registro.
function openUpdateModal( id )
{
    // Se limpian los campos del formulario.
    $( '#uptform' )[0].reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    
    dialog2.showModal();

    $.ajax({
        dataType: 'json',
        url: API_INVENTARIO + 'readOne',
        data: { id_producto: id },
        type: 'post'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            // Se inicializan los campos del formulario con los datos del registro seleccionado previamente
            $( '#id_existencia2' ).val( response.dataset.id_existencia );
            $( '#cantidad2' ).val( response.dataset.producto );
            fillSelect( API_TALLAS, 'talla2', response.dataset.id_talla);
            fillSelect( API_PRODUCTOS, 'producto2', response.dataset.id_producto );

        } else {
            sweetAlert( 2, result.exception, null );
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

// Evento para crear o modificar un registro.
$( '#crtform' ).submit(function( event ) {
    event.preventDefault();
    // Se llama a la función que crea o actualiza un registro. Se encuentra en el archivo components.js
    // Se comprueba si el id del registro esta asignado en el formulario para actualizar, de lo contrario se crea un registro.
    saveRow( API_INVENTARIO, 'create', this, 'crtdialog' );
});

// Evento para crear o modificar un registro.
$( '#uptform' ).submit(function( event ) {
    event.preventDefault();
    // Se llama a la función que crea o actualiza un registro. Se encuentra en el archivo components.js
    // Se comprueba si el id del registro esta asignado en el formulario para actualizar, de lo contrario se crea un registro.
    saveRow( API_INVENTARIO, 'update', this, 'uptdialog' );
});

// Función para establecer el registro a eliminar mediante el id recibido.
function openDeleteDialog( id )
{
    // Se declara e inicializa un objeto con el id del registro que será borrado.
    let identifier = { id_existencia: id };
    confirmDelete( API_INVENTARIO, identifier );
}