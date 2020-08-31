<?php
require_once('../../Helpers/database.php');
require_once('../../Helpers/validator.php');
require_once('../../Models/marcas.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $marcas = new Marcas;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_administrador'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $marcas->readAllMarcas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay marcas registradas';
                }
                break;
            case 'search':
                $_POST = $marcas->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $marcas->searchMarca($_POST['search'])) {
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
                $_POST = $marcas->validateForm($_POST);
                if ($marcas->setNombre($_POST['nombre1'])) {
                        if (is_uploaded_file($_FILES['archivo_categoria1']['tmp_name'])) {
                            if ($marcas->setImagen($_FILES['archivo_categoria1'])) {
                                if ($marcas->createMarca()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Marca creada correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = $marcas->getImageError();
                            }
                        } else {
                            $result['exception'] = 'Seleccione una imagen';
                        }

                } else {
                    $result['exception'] = 'Nombre incorrecto';
                }
                break;
            case 'readOne':
                if ($marcas->setId($_POST['id_marca'])) {
                    if ($result['dataset'] = $marcas->readOneMarca()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Marca inexistente';
                    }
                } else {
                    $result['exception'] = 'Marca incorrecta';
                }
                break;
            case 'update':
                $_POST = $marcas->validateForm($_POST);
                if ($marcas->setId($_POST['id_marca2'])) {
                    if ($data = $marcas->readOneMarca()) {
                        if ($marcas->setNombre($_POST['nombre2'])) {
                                if (is_uploaded_file($_FILES['archivo_categoria2']['tmp_name'])) {
                                    if ($marcas->setImagen($_FILES['archivo_categoria2'])) {
                                        if ($marcas->updateMarca()) {
                                            $result['status'] = 1;
                                            if ($marcas->deleteFile($marcas->getRuta(), $data['imagen_marca'])) {
                                                $result['message'] = 'Marca modificada correctamente';
                                            } else {
                                                $result['message'] = 'Marca modificada pero no se borro la imagen anterior';
                                            }
                                        } else {
                                            $result['exception'] = Database::getException();
                                        } 
                                    } else {
                                        $result['exception'] = $marcas->getImageError();
                                    }
                                } else {
                                    if ($marcas->updateMarca()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Marca modificada correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                }
                            
                        } else {
                            $result['exception'] = 'Nombre incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Marca inexistente';
                    }
                } else {
                    $result['exception'] = 'Marca incorrecta';
                }
                break;
            case 'delete':
                if ($marcas->setId($_POST['id_marca'])) {
                    if ($data = $marcas->readOneMarca()) {
                        if ($marcas->deleteMarca()) {
                            $result['status'] = 1;
                            if ($marcas->deleteFile($marcas->getRuta(), $data['imagen_marca'])) {
                                $result['message'] = 'Marca eliminada correctamente';
                            } else {
                                $result['message'] = 'Marca eliminada pero no se borro la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Marca inexistente';
                    }
                } else {
                    $result['exception'] = 'Marca incorrecta';
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