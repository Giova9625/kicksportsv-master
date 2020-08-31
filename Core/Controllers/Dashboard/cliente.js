// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CLIENTES = '../../Core/Api/Dashboard/cliente.php?action=';

// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows( API_CLIENTES);
   
});

// Función para llenar la tabla con los datos enviados por readRows().
function fillTable( dataset )
{
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.forEach(function( row ) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.nombre}</td>
                <td>${row.apellido}</td>
                <td>${row.apodo}</td>
                <td>${row.correo}</td>
                <td>${row.direccion}</td>
                <td>${row.departamento}</td>
                <td>${row.telefono}</td>
                <td>${row.genero}</td>
                <td>${row.ciudad}</td>
                <td>${row.codigo_postal}</td>
                <td>
                    <a href="#" onclick="openDeleteDialog(${row.id_cliente})"  class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"> <i class="zmdi zmdi-delete"></i></a> 
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    $( '#tbody-rows' ).html( content );
    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    //$( '.materialboxed' ).materialbox();
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    //$( '.tooltipped' ).tooltip();
}

// Evento para mostrar los resultados de una búsqueda.
$( '#search-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows( API_CLIENTES, this );
});

// Función que prepara formulario para insertar un registro.
function openCreateModal()
{
    // Se limpian los campos del formulario.
    $( '#save-form' )[0].reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    $( '#save-modal' ).modal( 'open' );
    
}

// Función que prepara formulario para modificar un registro.
function openUpdateModal( id )
{
    // Se limpian los campos del formulario.
    $( '#save-form' )[0].reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    $( '#save-modal' ).modal( 'open' );


    $.ajax({
        dataType: 'json',
        url: API_CLIENTES + 'readOne',
        data: { id_cliente: id },
        type: 'post'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            // Se inicializan los campos del formulario con los datos del registro seleccionado previamente.
            $( '#id_cliente' ).val( response.dataset.id_cliente );
            $( '#nombre' ).val( response.dataset.nombre );
            $( '#apellido' ).val( response.dataset.apellido );
            $( '#apodo' ).val( response.dataset.apodo );
            $( '#correo' ).val( response.dataset.correo );
            $( '#contra' ).val( response.dataset.contra );
            $( '#direccion' ).val( response.dataset.direcccion );
            $( '#departamento' ).val( response.dataset.departamento );
            $( '#telefono' ).val( response.dataset.telefono );
            $( '#genero' ).val( response.dataset.genero );
            $( '#ciudad' ).val( response.dataset.ciudad );
            $( '#codigo_postal' ).val( response.dataset.codigo_postal );
            // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
            M.updateTextFields();
        } else {
            sweetAlert( 2, response.exception, null );
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
$( '#save-form' ).submit(function( event ) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que crea o actualiza un registro. Se encuentra en el archivo components.js
    // Se comprueba si el id del registro esta asignado en el formulario para actualizar, de lo contrario se crea un registro.
    if ( $( '#id_cliente' ).val() ) {
        saveRow( API_CLIENTES, 'update', this, 'save-modal' );
    } else {
        saveRow( API_CLIENTES, 'create', this, 'save-modal' );
    }
});

// Función para establecer el registro a eliminar mediante el id recibido.
function openDeleteDialog( id )
{
    // Se declara e inicializa un objeto con el id del registro que será borrado.
    let identifier = { id_cliente: id };
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete( API_CLIENTES, identifier );
}