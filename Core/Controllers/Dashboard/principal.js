// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CLIENTES = '../../Core/Api/Dashboard/cliente.php?action=';
const API_PEDIDOS = '../../Core/Api/Commerce/pedido.php?action=';
const API_PRODUCTOS = '../../Core/Api/Dashboard/productos.php?action=';


// Método que se ejecuta cuando el documento está listo.
$( document ).ready(function() {
    // Se declara e inicializa un objeto con la fecha y hora actual del cliente.
    // Se llama a la función que muestra una gráfica en la página web.
    graficaCategorias();
    graficaDepartamento();
    graficaEstado();
    graficaTalla();
    graficaMarca();
});

// Función para graficar la cantidad de generos por cliente.
function graficaCategorias()
{
    $.ajax({
        dataType: 'json',
        url: API_CLIENTES + 'cantidadClienteGenero',
        data: null
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se remueve la etiqueta canvas asignada para la gráfica.
        if ( response.status ) {
            // Se declaran los arreglos para guardar los datos por gráficar.
            let genero = [];
            let cantidad = [];
            // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                // Se asignan los datos a los arreglos.
                genero.push( row.genero );
                cantidad.push( row.cantidad );
            });
            // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
            barGraph( 'chart', genero, cantidad, 'Cantidad de clientes', 'Cantidad de clientes por genero' );
        } else {
            $( '#chart' ).remove();
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

// funcion de clientes por departamento
function graficaDepartamento()
{
    $.ajax({
        dataType: 'json',
        url: API_CLIENTES + 'cantidadClienteDepartamento',
        data: null
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se remueve la etiqueta canvas asignada para la gráfica.
        if ( response.status ) {
            // Se declaran los arreglos para guardar los datos por gráficar.
            let cliente = [];
            let departamento = [];
            // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                // Se asignan los datos a los arreglos.
                cliente.push( row.cliente );
                departamento.push( row.departamento );
            });
            // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
            doughnutGraph( 'chart2', departamento, cliente, 'Clientes por departamento' );
        } else {
            $( '#chart2' ).removechart();
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


//Función para graficar la cantidad estados en pedidos
function graficaEstado()
{
    $.ajax({
        dataType: 'json',
        url: API_PEDIDOS + 'cantidadEstadoPedido',
        data: null
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se remueve la etiqueta canvas asignada para la gráfica.
        if ( response.status ) {
            // Se declaran los arreglos para guardar los datos por gráficar.
            let estado = [];
            let pedido = [];
            // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                // Se asignan los datos a los arreglos.
                estado.push( row.estado );
                pedido.push( row.pedido );
            });
            // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
            barGraph( 'chart3', estado, pedido, 'Cantidad de pedidos', 'Cantidad de pedidos por estado' );
        } else {
            $( '#chart3' ).remove();
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


//Función para graficar la cantidad de productos por talla
function graficaTalla()
{
    $.ajax({
        dataType: 'json',
        url: API_PRODUCTOS + 'cantidadProductosTalla',
        data: null
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se remueve la etiqueta canvas asignada para la gráfica.
        if ( response.status ) {
            // Se declaran los arreglos para guardar los datos por gráficar.
            let talla = [];
            let producto = [];
            // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                // Se asignan los datos a los arreglos.
                talla.push( row.talla );
                producto.push( row.productos );
            });
            // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
            barGraph( 'chart4', talla, producto, 'Cantidad de productos', 'Cantidad de productos por talla' );
        } else {
            $( '#chart4' ).remove();
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

//Función para graficar la cantidad de productos por talla
function graficaMarca()
{
    $.ajax({
        dataType: 'json',
        url: API_PRODUCTOS + 'cantidadProductosMarca',
        data: null
    })
    .done(function( response ) {
        // Se comprueba si la API ha retornado datos, de lo contrario se remueve la etiqueta canvas asignada para la gráfica.
        if ( response.status ) {
            // Se declaran los arreglos para guardar los datos por gráficar.
            let marca = [];
            let cantidad = [];
            // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
            response.dataset.forEach(function( row ) {
                // Se asignan los datos a los arreglos.
                marca.push( row.nombre );
                cantidad.push( row.cantidad );
            });
            // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
            barGraph( 'chart5', marca, cantidad, 'Cantidad de productos', 'Cantidad de productos por marca' );
        } else {
            $( '#chart5' ).remove();
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