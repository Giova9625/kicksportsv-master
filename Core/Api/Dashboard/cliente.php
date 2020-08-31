<?php
require_once('../../Helpers/database.php');
require_once('../../Helpers/validator.php');
require_once('../../Models/cliente.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $clientes = new Clientes;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_administrador'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $clientes->readAllClientes()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay clientes registrados';
                }
                break;
            case 'search':
                $_POST = $clientes->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $clientes->searchCLientes($_POST['search'])) {
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
            
            case 'readOne':
                if ($clientes->setId($_POST['id_cliente'])) {
                    if ($result['dataset'] = $clientes->readOneCliente()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;
            
                case 'delete':
                    if ($clientes->setId($_POST['id_cliente'])) {
                        if ($data = $clientes->readOneCliente()) {
                            if ($clientes->deleteCliente()) {
                                $result['status'] = 1;
                                $result['message'] = 'CLiente eliminado correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Cliente inexistente';
                        }
                    } else {
                        $result['exception'] = 'Cliente incorrecto';
                    }
                    break;

                    case 'cantidadClienteGenero':
                        
                        if ($result['dataset'] = $clientes->cantidadClienteGenero()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'No hay datos disponibles';
                        }
                    break;

                    case 'cantidadClienteDepartamento':
                        
                        if ($result['dataset'] = $clientes->cantidadClienteDepartamento()) {
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
	exit('Recurso denegado');
}
}
?>