<?php
/*
*   Clase para definir las plantillas de las páginas web del sitio público.
*/
class Commerce
{
    /*
    *   Método para imprimir la plantilla del encabezado.
    *
    *   Parámetros: $title (título de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function headerTemplate($title)
    {
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
        session_start();
        // Se imprime el código HTML para el encabezado del documento.
        print('
            <!DOCTYPE html>
            <html lang="es">
                <head>
                    <meta charset="utf-8">
                    <title>KickSportsv - '.$title.'</title>
                    <link type="image/png" rel="icon" href="../../Resources/img/Logo2.png"/>
                    <link type="text/css" rel="stylesheet" href="../../Resources/Css/materialize.min.css"/>
                    <link type="text/css" rel="stylesheet" href="../../Resources/Css/material-icons.css"/>
                    <link type="text/css" rel="stylesheet" href="../../Resources/Css/commerce.css"/>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                </head>
                <body>
        ');
        // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de cliente para mostrar el menú de opciones, de lo contrario se muestra otro menú.
        if (isset($_SESSION['id_cliente'])) {
            // Se verifica si la página web actual es diferente a login.php y register.php, de lo contrario se direcciona a index.php
            if ($filename != 'login.php' && $filename != 'signin.php') {
                print('
                    <header>
                        <div class="navbar-fixed">
                            <nav class="blue">
                                <div class="nav-wrapper">
                                    <a href="index.php" class="brand-logo"><img src="../../resources/img/Logo2.png" height="80"></a>
                                    <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                    <ul class="right hide-on-med-and-down">
                                        <li><a href="index.php"><i class="material-icons left">local_offer</i>Productos</a></li>
                                        <li><a href="cart.php"><i class="material-icons left">shopping_cart</i>Carrito</a></li>
                                        <li><a href="#"><i class="material-icons left">account_box</i>Usuario: <b>'.$_SESSION['correo'].'</b></a></li>
                                        <li><a href="#" onclick="logOut()"><i class="material-icons left">close</i>Cerrar sesión</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <ul class="sidenav" id="mobile">
                            <li><a href="index.php"><i class="material-icons left">local_offer</i>Productos</a></li>
                            <li><a href="cart.php"><i class="material-icons left">shopping_cart</i>Carrito</a></li>
                            <li><a href="#" onclick="logOut()"><i class="material-icons left">close</i>Cerrar sesión</a></li>
                        </ul>
                    </header>
                    <main>
                ');
            } else {
                header('location: index.php');
            }
        } else {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
            if ($filename != 'cart.php') {
                print('
                    <header>
                        <div class="navbar-fixed">
                            <nav class="blue">
                                <div class="nav-wrapper">
                                    <a href="index.php" class="brand-logo"><img src="../../resources/img/logo2.png" height="80"></a>
                                    <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                    <ul class="right hide-on-med-and-down">
                                        <li><a href="index.php"><i class="material-icons left">local_offer</i>Productos</a></li>
                                        <li><a href="signin.php"><i class="material-icons left">person</i>Crear cuenta</a></li>
                                        <li><a href="login.php"><i class="material-icons left">forward</i>Iniciar sesión</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <ul class="sidenav" id="mobile">
                            <li><a href="index.php"><i class="material-icons left">local_offer</i>Productos</a></li>
                            <li><a href="signin.php"><i class="material-icons left">person</i>Crear cuenta</a></li>
                            <li><a href="login.php"><i class="material-icons left">forward</i>Iniciar sesión</a></li>
                        </ul>
                    </header>
                    <main>
                ');
            } else {
                header('location: login.php');
            }
        }
        // Se llama al método que contiene el código de las cajas de dialogo (modals).
        self::modals();
    }

    /*
    *   Método para imprimir la plantilla del pie.
    *
    *   Parámetros: $controller (nombre del archivo que sirve como controlador de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function footerTemplate($controller)
    {
        // Se imprime el código HTML para el pie del documento.
        print('
                    <!-- Contenedor para mostrar efecto parallax con una altura de 300px e imagen aleatoria -->
                    <div class="parallax-container">
                        <div class="parallax">
                            <img id="parallax">
                        </div>
                    </div>
                </main>
                <footer class="page-footer blue">
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <p>
                                <a href="index.php" class="brand-logo"><img src="../../resources/img/Logo2.png" height="175"></a>
                                </p>
                            </div>
                            <div class="col s12 m6 l6">
                                <h5 class="white-text">Contáctanos</h5>
                                <p>
                                    <blockquote>
                                        <a class="white-text" href="https://www.facebook.com/" target="_blank"><b>facebook</b></a>
                                        <span>|</span>
                                        <a class="white-text" href="https://twitter.com/" target="_blank"><b>twitter</b></a>
                                    </blockquote>
                                    <blockquote>
                                        <a class="white-text" href="https://www.instagram.com/" target="_blank"><b>instagram</b></a>
                                        <span>|</span>
                                        <a class="white-text" href="https://www.youtube.com/" target="_blank"><b>youtube</b></a>
                                    </blockquote>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <div class="container">
                            <span>© KickSportsv, todos los derechos reservados.</span>
                            <span class="grey-text text-lighten-4 right">Diseñado con <a class="red-text text-accent-1" href="http://materializecss.com/" target="_blank"><b>Materialize</b></a></span>
                        </div>
                    </div>
                </footer>
                <script type="text/javascript" src="../../Resources/js/jquery-3.4.1.min.js"></script>
                <script type="text/javascript" src="../../Resources/js/materialize.min.js"></script>
                <script type="text/javascript" src="../../Resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../Core/Helpers/components.js"></script>
                <script type="text/javascript" src="../../Core/Controllers/Commerce/initialization.js"></script>
                <script type="text/javascript" src="../../Core/Controllers/Commerce/account.js"></script>
                <script type="text/javascript" src="../../Core/Controllers/Commerce/'.$controller.'"></script>
            </body>
            </html>
        ');
    }

    /*
    *   Método para imprimir las cajas de dialogo (modals).
    */
    private static function modals()
    {
        // Se imprime el código HTML de las cajas de dialogo (modals).
        print('
            <!-- Componente Modal para mostrar los Términos y condiciones -->
            <div id="terminos" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">TÉRMINOS Y CONDICIONES</h4>
                    <p>Nuestra empresa ofrece los mejores productos a nivel nacional con una calidad garantizada y...</p>
                </div>
                <div class="divider"></div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
                </div>
            </div>

            <!-- Componente Modal para mostrar la Misión -->
            <div id="mision" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">MISIÓN</h4>
                    <p>Ofrecer los mejores productos a nivel nacional para satisfacer a nuestros clientes y...</p>
                </div>
                <div class="divider"></div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
                </div>
            </div>

            <!-- Componente Modal para mostrar la Visión -->
            <div id="vision" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">VISIÓN</h4>
                    <p>Ser la empresa lider en la región ofreciendo productos de calidad a precios accesibles y...</p>
                </div>
                <div class="divider"></div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
                </div>
            </div>

            <!-- Componente Modal para mostrar los Valores -->
            <div id="valores" class="modal">
                <div class="modal-content center-align">
                    <h4>VALORES</h4>
                    <p>Responsabilidad</p>
                    <p>Honestidad</p>
                    <p>Seguridad</p>
                    <p>Calidad</p>
                </div>
                <div class="divider"></div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
                </div>
            </div>
        ');
    }
}
?>