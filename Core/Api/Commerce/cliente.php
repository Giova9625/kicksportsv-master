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
        switch ($_GET['action']) 
        {
            case 'logout':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
                case 'readProfile':
                    if ($cliente->setId($_SESSION['id_cliente'])) {
                        if ($result['dataset'] = $cliente->readOneCliente()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'Cliente inexistente';
                        }
                    } else {
                        $result['exception'] = 'Cliente incorrecto';
                    }
                    break;
                    case 'password':
                        if ($cliente->setId($_SESSION['id_cliente'])) 
                        {
                            $_POST = $cliente->validateForm($_POST);
                                if ($cliente->setContra($_POST['clave_actual_1'])) 
                                {
                                    if ($cliente->checkPassword($_POST['clave_actual_1'])) 
                                    {
                                        if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) 
                                        {
                                            if ($cliente->setContra($_POST['clave_nueva_1'])) 
                                            {
                                                if ($cliente->changePassword()) 
                                                {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Contraseña cambiada correctamente';
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                            } else {
                                                $result['exception'] = 'Clave nueva menor a 6 caracteres';
                                            }
                                        } else {
                                            $result['exception'] = 'Claves nuevas diferentes';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave actual incorrecta';
                                    }
                                } else {
                                    $result['exception'] = 'Clave actual menor a 6 caracteres';
                                }
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
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
                 // Se sanea el valor del token para evitar datos maliciosos.
                $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
                if ($token) {
                    $secretKey = '6LdBzLQUAAAAAL6oP4xpgMao-SmEkmRCpoLBLri-';
                    $ip = $_SERVER['REMOTE_ADDR'];

                    $data = array(
                        'secret' => $secretKey,
                        'response' => $token,
                        'remoteip' => $ip
                    );

                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data)
                        ),
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false
                        )
                    );

                    $url = 'https://www.google.com/recaptcha/api/siteverify';
                    $context  = stream_context_create($options);
                    $response = file_get_contents($url, false, $context);
                    $captcha = json_decode($response, true);

                    if ($captcha['success']) 
                    {

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
                    } else {
                        $result['exception'] = 'No eres un humano';
                    }
                } else {
                    $result['exception'] = 'Ocurrió un problema al cargar el reCAPTCHA';
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