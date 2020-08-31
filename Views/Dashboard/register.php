<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Registrar primer usuario');
?>

<!-- Formulario para registrar al primer usuario del dashboard -->


<div class="login-wrap cover">
		<div class="container-login">
			<p class="text-center" style="font-size: 80px;">
				<i class="zmdi zmdi-account-circle"></i>
			</p>
			<form method="post" id="register-form">
				
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input id="nombre" type="text" name="nombre" class="validate" required/>
            	    <label for="nombre">Nombre</label>
				</div>

				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input id="apellido" type="text" name="apellido" class="validate" required/>
                    <label for="apellido">Apellido</label>
				</div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input id="correo" type="email" name="correo" class="validate" required/>
                   <label for="correo">Correo</label>
				</div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input id="usuario" type="text" name="usuario" class="validate" required/>
                   <label for="usuario">Usuario</label>
				</div>

               
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input id="clave1" type="password" name="clave1" class="validate" required/>
                   <label for="clave1">Contraseña</label>
				</div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input id="clave2" type="password" name="clave2" class="validate" required/>
                   <label for="clave2">Confirmar</label>
				</div> 

				<button type="submit" data-tooltip="Registrar" class="mdl-button mdl-js-button mdl-js-ripple-effect" style="color: #3F51B5; margin: 0 auto; display: block;">
					REGISTRAR
				</button>
			</form>
		</div>
	</div>

<?php
Dashboard::footerTemplate('register.js');
?>
