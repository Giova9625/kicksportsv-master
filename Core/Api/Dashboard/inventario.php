<?php
require_once('../../Helpers/database.php');
require_once('../../Helpers/validator.php');
require_once('../../Models/Inventario.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $inventario = new Inventario;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
	if (isset($_SESSION['id_administrador'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $inventario->readAllInventario()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay existencias registradas';
                }
                break;
            case 'search':
                $_POST = $producto->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $producto->searchProductos($_POST['search'])) {
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
                $_POST = $producto->validateForm($_POST);
                if ($producto->setProducto($_POST['producto1'])) {
                    if ($producto->setDescripcion($_POST['descripcion1'])) {
                        if ($producto->setPrecio($_POST['precio1'])) {
                            if (isset($_POST['marca1'])) {
                                if ($producto->setNombre($_POST['marca1'])) {
                                    
                                        if (is_uploaded_file($_FILES['archivo_producto1']['tmp_name'])) {
                                            if ($producto->setImagen($_FILES['archivo_producto1'])) {
                                                if ($producto->createProducto()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Producto creado correctamente';
                                                } else {
                                                    $result['exception'] = Database::getException();;
                                                }
                                            } else {
                                                $result['exception'] = $producto->getImageError();
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione una imagen';
                                        }
                                    
                                } else {
                                    $result['exception'] = 'Marca incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Seleccione una Marca';
                            }
                        } else {
                            $result['exception'] = 'Precio incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Descripción incorrecta';
                    }
                } else {
                    $result['exception'] = 'Nombre incorrecto';
                }
                break;
            case 'readOne':
                if ($inventario->setId($_POST['id_existencia'])) {
                    if ($result['dataset'] = $inventario->readOneInventario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Inventario inexistente';
                    }
                } else {
                    $result['exception'] = 'Inventario incorrecto';
                }
                break;
            case 'update':
                $_POST = $producto->validateForm($_POST);
                if ($producto->setId($_POST['id_producto2'])) {
                    if ($data = $producto->readOneProducto()) {
                        if ($producto->setProducto($_POST['producto2'])) {
                            if ($producto->setDescripcion($_POST['descripcion2'])) {
                                if ($producto->setPrecio($_POST['precio2'])) {
                                    if ($producto->setNombre($_POST['marca2'])) {
                                            if (is_uploaded_file($_FILES['archivo_producto2']['tmp_name'])) {
                                                if ($producto->setImagen($_FILES['archivo_producto2'])) {
                                                    if ($producto->updateProducto()) {
                                                        $result['status'] = 1;
                                                        if ($producto->deleteFile($producto->getRuta(), $data['imagen_producto'])) {
                                                            $result['message'] = 'Producto modificado correctamente';
                                                        } else {
                                                            $result['message'] = 'Producto modificada pero no se borro la imagen anterior';
                                                        }
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    }
                                                } else {
                                                    $result['exception'] = $producto->getImageError();
                                                }
                                            } else {
                                                if ($producto->updateProducto()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Producto modificado correctamente';
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                } 
                                            }
                                        
                                    } else {
                                        $result['exception'] = 'Seleccione una marca';
                                    }
                                } else {
                                    $result['exception'] = 'Precio incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Descripción incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Nombre incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                break;
            case 'delete':
                if ($producto->setId($_POST['id_producto'])) {
                    if ($data = $producto->readOneProducto()) {
                        if ($producto->deleteProducto()) {
                            $result['status'] = 1;
                            if ($producto->deleteFile($producto->getRuta(), $data['imagen_producto'])) {
                                $result['message'] = 'Producto eliminado correctamente';
                            } else {
                                $result['message'] = 'Producto eliminado pero no se borro la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                break;
            case 'cantidadProductosMarca':
                if ($result['dataset'] = $producto->cantidadProductosMarca()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay datos disponibles';
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