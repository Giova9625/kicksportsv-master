<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/marcas.php');
require_once('../../models/productos.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se instancian las clases correspondientes.
    $id = new Marcas;
    $producto = new Productos;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se compara la acción a realizar según la petición del controlador.
    switch ($_GET['action']) {
        case 'readAll':
            if ($result['dataset'] = $id->readAll()) {
                $result['status'] = 1;
            } else {
                $result['exception'] = 'Contenido no disponible';
            }
            break;
        case 'readProductosMarca':
            if ($producto->setNombre($_POST['id_marca'])) {
                if ($result['dataset'] = $producto->readProductosMarcas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
            } else {
                $result['exception'] = 'Marca incorrecta';
            }
            break;
        case 'readOneProducto':
            if ($producto->setId($_POST['id_producto'])) {
                if ($result['dataset'] = $producto->readOneProducto()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
            } else {
                $result['exception'] = 'Producto incorrecto';
            }
            break;
            case 'readAllTalla':
                if ($result['dataset'] = $id->readAllTalla()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;
        default:
            exit('Acción no disponible');
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    exit('Recurso denegado');
}
?>