<?php
require_once('../../Helpers/database.php');
require_once('../../Helpers/validator.php');
require_once('../../Models/pedidos.php');
require_once('../../models/tallas.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $pedido = new Pedidos;

    $talla = new Tallas;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_cliente'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $pedido->readAllPedidos()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay pedidos registrados';
                }
                break;
            case 'search':
                $_POST = $pedido->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $pedido->searchPedidos($_POST['search'])) {
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
                //Metodo para commerce
                case 'createDetail':
                    if ($pedido->setCliente($_SESSION['id_cliente'])) 
                    {
                        if ($pedido->readOrder()) 
                        {
                            $_POST = $pedido->validateForm($_POST);
                            if ($pedido->setProducto($_POST['id_producto'])) 
                            {
                                if ($pedido->setCantidad($_POST['cantidad'])) 
                                {
                                    if ($pedido->setPrecio($_POST['cost'])) 
                                    {
                                        if ($pedido->setTalla($_POST['talla'])) 
                                        {
                                            if ($pedido->createDetail()) 
                                            {
                                                $result['status'] = 1;
                                                $result['message'] = 'Producto agregado correctamente';
                                            } else {
                                                $result['exception'] = 'Ocurrió un problema al agregar el producto';
                                            }
                                        } else {
                                            $result['exception'] = 'Talla incorrecta';
                                        }
                                    } else {
                                        $result['exception'] = 'Precio incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Cantidad incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Producto incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Ocurrió un problema al obtener el pedido';
                        }
                    } else {
                        $result['exception'] = 'Cliente incorrecto';
                    }
                break;
            
            case 'readOne':
                if ($pedido->setId($_POST['id_cliente'])) {
                    if ($result['dataset'] = $pedido->readOnePedido()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Pedido inexistente';
                    }
                } else {
                    $result['exception'] = 'Pedido incorrecto';
                }
                break;
            //Metodo para commerce
                case 'readCart':
                    if ($pedido->setCliente($_SESSION['id_cliente'])) {
                        if ($pedido->readOrder()) {
                            if ($result['dataset'] = $pedido->readCart()) {
                                $result['status'] = 1;
                                $_SESSION['id_pedido'] = $pedido->getIdPedido();
                            } else {
                                $result['exception'] = 'No tiene productos en su pedido';
                            }
                        } else {
                            $result['exception'] = 'Debe agregar un producto al pedido';
                        }
                    } else {
                        $result['exception'] = 'Cliente incorrecto';
                    }
                    break;
                //Metodo para commerce
                case 'deleteDetail':
                    if ($pedido->setIdPedido($_SESSION['id_pedido'])) {
                        if ($pedido->setIdDetalle($_POST['id_detalle'])) {
                            if ($pedido->deleteDetail()) {
                                $result['status'] = 1;
                                $result['message'] = 'Producto removido correctamente';
                            } else {
                                $result['exception'] = 'Ocurrió un problema al remover el producto';
                            }
                        } else {
                            $result['exception'] = 'Detalle incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Pedido incorrecto';
                    }
                    break;

                    //Metodo para grafica
                    case 'cantidadEstadoPedido':
                        
                        if ($result['dataset'] = $pedido->cantidadEstadoPedido()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'No hay datos disponibles';
                        }
                    break;

                 //Metodo para commerce   
            case 'finishOrder':
                if ($pedido->setIdPedido($_SESSION['id_pedido'])) {
                    if ($pedido->setEstado(1)) {
                        if ($pedido->updateOrderStatus()) {
                            $result['status'] = 1;
                            $result['message'] = 'Pedido finalizado correctamente';
                        } else {
                            $result['exception'] = 'Ocurrió un problema al finalizar el pedido';
                        }
                    } else {
                        $result['exception'] = 'Estado incorrecto';
                    }
                } else {
                    $result['exception'] = 'Pedido incorrecto';
                }
                break;

                    //Metodo para commerce
                case 'updateDetail':
                    if ($pedido->setIdPedido($_SESSION['id_pedido'])) {
                        $_POST = $pedido->validateForm($_POST);
                        if ($pedido->setIdDetalle($_POST['id_detalle'])) {
                            if ($pedido->setCantidad($_POST['cantidad'])) 
                            {
                                if ($pedido->setTalla($_POST['talla'])) 
                                {
                                    if ($pedido->updateDetail()) 
                                    {
                                        $result['status'] = 1;
                                        $result['message'] = 'Cantidad modificada correctamente';
                                    } else {
                                        $result['exception'] = 'Ocurrió un problema al modificar la cantidad';
                                    }
                                } else {
                                    $result['exception'] = 'Talla incorrecta';
                                } 
                            } else {
                                $result['exception'] = 'Cantidad incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Detalle incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Pedido incorrecto';
                    }
                    break;
                    //Metodo para combobox
                    case 'readAllTalla':
                        if ($result['dataset'] = $talla->readAllTallas()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'No se encontraron tallas disponibles';
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
}
?>