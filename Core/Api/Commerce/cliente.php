<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../Models/cliente.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $cliente = new Clientes;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como cliente para realizar las acciones correspondientes.
    if (isset($_SESSION['id_cliente'])) {
        // Se compara la acción a realizar cuando un cliente ha iniciado sesión.
        switch ($_GET['action']) {
            case 'logout':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
            default:
                exit('Acción no disponible dentro de la sesión');
        }
    } else {
        // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'register':
                $_POST = $cliente->validateForm($_POST);
                        if ($cliente->setNombre($_POST['nombre'])) 
                        {
                            if ($cliente->setApellido($_POST['apellido'])) 
                            {
                                if ($cliente->setApodo($_POST['apodo'])) 
                                {
                                    if ($cliente->setCorreo($_POST['correo'])) 
                                    {
                                        if ($_POST['contra'] == $_POST['contra2']) 
                                        {
                                            if ($cliente->setContra($_POST['contra'])) 
                                            {
                                                if ($cliente->setDireccion($_POST['direccion'])) 
                                                {
                                                    if ($cliente->setDepartamento($_POST['departamento']))
                                                    {
                                                        if ($cliente->setTelefono($_POST['telefono'])) 
                                                        {
                                                            if ($cliente->setGenero($_POST['genero'])) 
                                                            {
                                                                if ($cliente->setCiudad($_POST['ciudad'])) 
                                                                {
                                                                    if ($cliente->setCodigo($_POST['codigo_postal'])) 
                                                                    {
                                                                        if ($cliente->createCliente()) 
                                                                        {
                                                                            $result['status'] = 1;
                                                                            $result['message'] = 'Cliente registrado correctamente';
                                                                        } else {
                                                                            $result['exception'] = 'Ocurrió un problema al registrar el cliente';
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'Codigo postal incorrecto';
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Ciudad incorrecta';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Genero no aceptado';
                                                            } 
                                                        } else {
                                                            $result['exception'] = 'Telefono incorrecto';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Departamento diferentes';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Direccion incorrecto';
                                                }
                                            } else {
                                                $result['exception'] = 'Clave incorrecta';
                                            }
                                        } else {
                                            $result['exception'] = 'Contras distintas';
                                        }
                                    } else {
                                        $result['exception'] = 'Correo incorrecta';
                                    }
                                } else {
                                    $result['exception'] = 'Apodo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    
                break;
                        /*
    *   Hecho por Juan, esto es lo del login lo unico que toque de la api.
    */
            case 'login':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->checkUser($_POST['correo'])) 
                {
                        if ($cliente->checkPassword($_POST['clave'])) 
                        {
                            $_SESSION['id_cliente'] = $cliente->getId();
                            $_SESSION['correo'] = $cliente->getCorreo();
                            $result['status'] = 1;
                            $result['message'] = 'Autenticación correcta';
                        } else {
                            $result['exception'] = 'Clave incorrecta';
                        }

                } else {
                    $result['exception'] = 'Alias incorrecto';
                }
            break;
            default:
                exit('Acción no disponible fuera de la sesión');
        }
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>