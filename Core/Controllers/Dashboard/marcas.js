// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_MARCAS = '../../Core/Api/Dashboard/marcas.php?action=';

// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows( API_MARCAS );
 
  
    
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
                <td><img src="../../Resources/Img/marcas/${row.imagen_marca}"  height="100"></td>
                <td>${row.nombre}</td>
                <td>
                <a href="#" onclick="openUpdateModal(${row.id_marca})"  class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"> <i class="zmdi zmdi-edit"></i></a>
                <a href="#" onclick="openDeleteDialog(${row.id_marca})"  class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"> <i class="zmdi zmdi-delete"></i></a>
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
    searchRows( API_MARCAS, this );
});

var dialog1 = document.querySelector('#crtdialog');
// Función que prepara formulario para insertar un registro.
function openCreateModal()
{
    // Se limpian los campos del formulario.
    $( '#crtform' )[0].reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    
    dialog1.showModal();
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
        url: API_MARCAS + 'readOne',
        data: { id_marca: id },
        type: 'post'
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado una respuesta satisfactoria, de lo contrario se muestra un mensaje de error.
        if ( response.status ) {
            // Se inicializan los campos del formulario con los datos del registro seleccionado previamente.
            $( '#id_marca2' ).val( response.dataset.id_marca );
            $( '#nombre2' ).val( response.dataset.nombre );
            // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
           
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
$( '#crtform' ).submit(function( event ) {
    event.preventDefault();
    // Se llama a la función que crea o actualiza un registro. Se encuentra en el archivo components.js
    // Se comprueba si el id del registro esta asignado en el formulario para actualizar, de lo contrario se crea un registro.
    saveRow( API_MARCAS, 'create', this, 'crtdialog' );
});

// Evento para crear o modificar un registro.
$( '#uptform' ).submit(function( event ) {
    event.preventDefault();
    // Se llama a la función que crea o actualiza un registro. Se encuentra en el archivo components.js
    // Se comprueba si el id del registro esta asignado en el formulario para actualizar, de lo contrario se crea un registro.
    saveRow( API_MARCAS, 'update', this, 'uptdialog' );
});


// Función para establecer el registro a eliminar mediante el id recibido.
function openDeleteDialog( id )
{
    // Se declara e inicializa un objeto con el id del registro que será borrado.
    let identifier = { id_marca: id };
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete( API_MARCAS, identifier );
}