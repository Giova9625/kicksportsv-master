<?php
require_once('../../Helpers/database.php');
require_once('../../Helpers/validator.php');
require_once('../../Models/tallas.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $tallas = new Tallas;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_administrador'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $tallas->readAllTallas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay tallas registradas';
                }
                break;
            case 'search':
                $_POST = $tallas->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $tallas->searchTalla($_POST['search'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1) {
                            $result['message'] = 'Se encontraron '.$rows.' coincidencias';
                        } else {
                            $result['message'] = 'Solo existe una coincidencia';
                        }
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
            case 'create':
                $_POST = $tallas->validateForm($_POST);
                if ($tallas->setTalla($_POST['talla1'])) {
                    if ($tallas->setDescripcion($_POST['descripcion1'])) {

                                if ($tallas->createTalla()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Talla creada correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }        
                    } else {
                        $result['exception'] = 'Descripción incorrecta';
                    }
                } else {
                    $result['exception'] = 'Talla incorrecta';
                }
                break;
                case 'readOne':
                    if ($tallas->setId($_POST['id_talla'])) {
                        if ($result['dataset'] = $tallas->readOneTalla()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'Talla inexistente';
                        }
                    } else {
                        $result['exception'] = 'Talla incorrecta';
                    }
                    break;
            case 'update':
                $_POST = $tallas->validateForm($_POST);
                if ($tallas->setId($_POST['id_talla2'])) {
                    if ($data = $tallas->readOneTalla()) {
                        if ($tallas->setTalla($_POST['talla2'])) {
                            if ($tallas->setDescripcion($_POST['descripcion2'])) {
                                        if ($tallas->updateTalla()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Talla modificada correctamente';
                                            
                                        } else {
                                            $result['exception'] = Database::getException();
                                        } 
                                   
                            } else {
                                $result['exception'] = 'Descripción incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Nombre de talla incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Talla inexistente';
                    }
                } else {
                    $result['exception'] = 'Talla incorrecta';
                }
                break;
            case 'delete':
                if ($tallas->setId($_POST['id_talla'])) {
                    if ($data = $tallas->readOneTalla()) {
                        if ($tallas->deleteTalla()) {
                            $result['status'] = 1;
                            $result['message'] = 'Talla eliminada correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Talla inexistente';
                    }
                } else {
                    $result['exception'] = 'Talla incorrecta';
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
        exit('Acceso no disponible');
    }
} else {
    exit('Recurso denegado');
}
?>