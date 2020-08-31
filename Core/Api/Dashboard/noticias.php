<?php
require_once('../../Helpers/database.php');
require_once('../../Helpers/validator.php');
require_once('../../Models/noticias.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $noticias = new Noticias;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_administrador'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $noticias->readAllNoticias()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay noticias registradas';
                }
                break;
            case 'search':
                $_POST = $noticias->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $noticias->searchNoticia($_POST['search'])) {
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
                $_POST = $noticias->validateForm($_POST);
                if ($noticias->setTitulo($_POST['titulo_noticia1'])) {
                    if ($noticias->setDescripcion($_POST['descripcion_noticia1'])) {
                        if (is_uploaded_file($_FILES['archivo_categoria1']['tmp_name'])) {
                            if ($noticias->setImagen($_FILES['archivo_categoria1'])) {
                                if ($noticias->createNoticia()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Noticia creada correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = $noticias->getImageError();
                            }
                        } else {
                            $result['exception'] = 'Seleccione una imagen';
                        }
                    } else {
                        $result['exception'] = 'Descripción incorrecta';
                    }
                } else {
                    $result['exception'] = 'Titulo incorrecto';
                }
                break;
            case 'readOne':
                if ($noticias->setId($_POST['id_noticia'])) {
                    if ($result['dataset'] = $noticias->readOneNoticia()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Noticia inexistente';
                    }
                } else {
                    $result['exception'] = 'Noticia incorrecta';
                }
                break;
            case 'update':
                $_POST = $noticias->validateForm($_POST);
                if ($noticias->setId($_POST['id_noticia2'])) {
                    if ($data = $noticias->readOneNoticia()) {
                        if ($noticias->setTitulo($_POST['titulo_noticia2'])) {
                            if ($noticias->setDescripcion($_POST['descripcion_noticia2'])) {
                                if (is_uploaded_file($_FILES['archivo_categoria2']['tmp_name'])) {
                                    if ($noticias->setImagen($_FILES['archivo_categoria2'])) {
                                        if ($noticias->updateNoticia()) {
                                            $result['status'] = 1;
                                            if ($noticias->deleteFile($noticias->getRuta(), $data['imagen_noticia'])) {
                                                $result['message'] = 'Noticia modificada correctamente';
                                            } else {
                                                $result['message'] = 'Noticia modificada pero no se borro la imagen anterior';
                                            }
                                        } else {
                                            $result['exception'] = Database::getException();
                                        } 
                                    } else {
                                        $result['exception'] = $noticias->getImageError();
                                    }
                                } else {
                                    if ($noticias->updateNoticia()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Noticia modificada correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                }
                            } else {
                                $result['exception'] = 'Descripción incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Titulo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Noticia inexistente';
                    }
                } else {
                    $result['exception'] = 'Noticia incorrecta';
                }
                break;
            case 'delete':
                if ($noticias->setId($_POST['id_noticia'])) {
                    if ($data = $noticias->readOneNoticia()) {
                        if ($noticias->deleteNoticia()) {
                            $result['status'] = 1;
                            if ($noticias->deleteFile($noticias->getRuta(), $data['imagen_noticia'])) {
                                $result['message'] = 'Noticia eliminada correctamente';
                            } else {
                                $result['message'] = 'Noticia eliminada pero no se borro la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Noticia inexistente';
                    }
                } else {
                    $result['exception'] = 'Noticia incorrecta';
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