// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_PEDIDOS = '../../Core/Api/Dashboard/pedido.php?action=';

// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows( API_PEDIDOS);
   
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
                <td>${row.id_pedido}</td>
                <td>${row.apodo}</td>
                <td>${row.estado}</td>
                <td>
                    <a href="#" onclick="openDeleteDialog(${row.id_pedido})"  class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"> <i class="zmdi zmdi-delete"></i></a> 
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
    searchRows( API_PEDIDOS, this );
});


// Función para establecer el registro a eliminar mediante el id recibido.
function openDeleteDialog( id )
{
    // Se declara e inicializa un objeto con el id del registro que será borrado.
    let identifier = { id_pedido: id };
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete( API_PEDIDOS, identifier );
}