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
			<form method="post" id="register-form" autocomplete="off">
				
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input id="nombre" type="text" name="nombre" class="validate" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" required/>
            	    <label for="nombre">Nombre</label>
				</div>

				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input id="apellido" type="text" name="apellido" class="validate" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" required/>
                    <label for="apellido">Apellido</label>
				</div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input id="correo" type="email" name="correo" class="validate" required/>
                   <label for="correo">Correo</label>
				</div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input id="usuario" type="text" name="usuario" class="validate" pattern="[A-Za-z0-9]{5,20}"
					title="Letras y números. Tamaño mínimo: 5. Tamaño máximo: 20" required/>
					   
                   <label for="usuario">Usuario</label>
				</div>

               
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				   <input id="clave1" type="password" name="clave1" class="validate" minlength="8" pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" 
				   title="La contraseña debe empezar con una letra contener minusculas, mayusculas y contener al menos un dígito" required/>
                   <label for="clave1">Contraseña</label>
				</div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input id="clave2" type="password" name="clave2" class="validate" minlength="8" pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" 
				   title="La contraseña debe empezar con una letra contener minusculas, mayusculas y contener al menos un dígito" required/>
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
