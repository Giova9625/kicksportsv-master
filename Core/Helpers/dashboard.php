<?php
/*
*	Clase para definir las plantillas de las páginas web del sitio privado.
*/
class Dashboard

{
     /*
    *   Método para imprimir la plantilla del encabezado.
    *
    *   Parámetros: $title (título de la página web y del contenido principal).
    *
    *   Retorno: ninguno.
    */
    public static function headerTemplate($title)
    {
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
        session_start();
        // Se imprime el código HTML de la cabecera del documento.
        print('
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <title>Dashboard - '.$title.'</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>Inicio</title>
                    <link type="text/css" rel="stylesheet" href="../../Resources/Css/normalize.css">
                    <link type="text/css" rel="stylesheet" href="../../Resources/Css/material.min.css">
                    <link type="text/css" rel="stylesheet" href="../../Resources/Css/material-design-iconic-font.min.css">
                    <link type="text/css" rel="stylesheet" href="../../Resources/Css/jquery.mCustomScrollbar.css">
                    <link type="text/css" rel="stylesheet" href="../../Resources/Css/main.css">
                    
                </head>
                <body>
        ');
        // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
        if (isset($_SESSION['id_administrador'])) {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a main.php
            if ($filename != 'index.php' && $filename != 'register.php') {
                // Se imprime el código HTML para el encabezado del documento con el menú de opciones.
                print('

				<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> KickSportSV 
			</div>
			<figure class="full-width navLateral-body-tittle-menu">
				<div>
					<img src="../../Resources/Img/avatar-male.png" alt="Avatar" class="img-responsive">
				</div>
				<figcaption>
					<span>
                        '.$_SESSION['usuario'].'<p>
						<small> Administrador </small>
					</span>
				</figcaption>
			</figure>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">
					<li class="full-width">
						<a href="principal.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
							<div class="navLateral-body-cr">
								INICIO
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-case"></i>
							</div>
							<div class="navLateral-body-cr">
								ADMINISTRAR
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="marcas.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-assignment-o"></i>
									</div>
									<div class="navLateral-body-cr">
										MARCAS
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="tallas.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-developer-board"></i>
									</div>
									<div class="navLateral-body-cr">
										TALLAS
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="comentarios.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-comment-alt-text"></i>
									</div>
									<div class="navLateral-body-cr">
										COMENTARIOS
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="noticias.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-image-alt"></i>
									</div>
									<div class="navLateral-body-cr">
										NOTICIAS
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-face"></i>
							</div>
							<div class="navLateral-body-cr">
								USUARIOS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="administrador.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-account"></i>
									</div>
									<div class="navLateral-body-cr">
										ADMINISTRADORES
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="cliente.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-accounts"></i>
									</div>
									<div class="navLateral-body-cr">
										CLIENTES
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="productos.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-store"></i>
							</div>
							<div class="navLateral-body-cr">
								PRODUCTOS
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="pedidos.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
							<div class="navLateral-body-cr">
								PEDIDOS
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="inventario.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-truck"></i>
							</div>
							<div class="navLateral-body-cr">
								INVENTARIO
							</div>
						</a>
					</li>
					
				</ul>
			</nav>
		</div>
	</section>
	<!-- pageContent -->
	<section class="full-width pageContent">
		<!-- navBar -->
		<div class="full-width navBar">
			<div class="full-width navBar-options">
				<i class="zmdi zmdi-swap btn-menu" id="btn-menu"></i>	
				<div class="mdl-tooltip" for="btn-menu">Ocultar / Mostrar MENU</div>
				<nav class="navBar-options-list">
					<ul class="list-unstyle">
						
						<li class="btn-exit" id="btn-exit">
							<i class="zmdi zmdi-power"  onclick="signOff()"></i>
							<div class="mdl-tooltip" for="btn-exit">Cerrar Sesion</div>
							
						</li>
						<li class="text-condensedLight noLink" ><small> '.$_SESSION['usuario'].'</small></li>
						<li class="noLink">
							<figure>
								<img src="../../Resources/Img/avatar-male.png" alt="Avatar" class="img-responsive">
							</figure>
						</li>
					</ul>
				</nav>
			</div>
		</div>
                ');
            } else {
                header('location: principal.php');
            }
        } else {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
            if ($filename != 'index.php' && $filename != 'register.php') {
                header('location: index.php');
            } else {
                // Se imprime el código HTML para el encabezado del documento con un menú vacío cuando sea iniciar sesión o registrar el primer usuario.
                print('');
            }
        }
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
		
		<dialog id="message" class="mdl-dialog">
        	<div class="mdl-dialog__content mdl-typography--text-center">
            	<p><i class="material-icons" id="icon"></i></p>
            	<h4><b id="title"></b></h4>
            	<p id="text"></p>
        	</div>
        	<div class="mdl-dialog__actions">
            	<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored close">Aceptar</button>
        	</div>
    	</dialog>
                  
			<script type="text/javascript" src="../../Resources/Js/jquery-3.4.1.min.js"></script>
			<script type="text/javascript" src="../../Resources/Js/material.min.js" ></script>
			<script type="text/javascript" src="../../Resources/Js/mainn.js" ></script>
			<script type="text/javascript" src="../../Resources/Js/sweetalert.min.js" ></script>
			<script type="text/javascript" src="../../Resources/Js/jquery.mCustomScrollbar.concat.min.js" ></script>
			<script type="text/javascript" src="../../Core/Helpers/components.js"></script>
            <script type="text/javascript" src="../../Core/Controllers/Dashboard/account.js"></script>
            <script type="text/javascript" src="../../Core/Controllers/Dashboard/'.$controller.'"></script>
		</body>
		</html>
        ');
    }

}
?>
 
                   
				