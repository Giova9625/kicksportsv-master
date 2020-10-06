
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="../../Resources/Css/normalize.css">
	<link rel="stylesheet" href="../../Resources/Css/sweetalert2.css">
	<link rel="stylesheet" href="../../Resources/Css/material.min.css">
	<link rel="stylesheet" href="../../Resources/Css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../../Resources/Css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="../../Resources/Css/main.css">
	
</head>

<?php
$_SESSION['10']=time();  
?>

<body>
	<div class="login-wrap cover">
		<div class="container-login">
			<p class="text-center" style="font-size: 80px;">
				<i class="zmdi zmdi-account-circle"></i>
			</p>
			<p class="text-center text-condensedLight">INGRESA CON TU CUENTA</p>
			<form id="login_form" method="post" autocomplete="off">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				    <input class="mdl-textfield__input" type="text" id="usuario" name="usuario">
				    <label class="mdl-textfield__label" for="usuario">Correo electronico</label>
				</div>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				    <input class="mdl-textfield__input" type="password" id="contra" name="contra">
				    <label class="mdl-textfield__label" for="contra">Contraseña</label>
				</div>
				<button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect" style="color: #3F51B5; margin: 0 auto; display: block;">
					INGRESAR
				</button>
			</form>
		</div>
	</div>

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

	<script src="../../Resources/Js/jquery-3.4.1.min.js"></script>
	<script src="../../Resources/Js/material.min.js" ></script>
	<script src="../../Resources/Js/sweetalert.min.js" ></script>
	<script src="../../Resources/Js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="../../Resources/Js/mainn.js" ></script>
	<script src="../../Core/Helpers/components.js"></script>
	<script src="../../Core/Controllers/Dashboard/account.js"></script>
	<script src="../../Core/Controllers/Dashboard/index.js"></script>
</body>
</html>