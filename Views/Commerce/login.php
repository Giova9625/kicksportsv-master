<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Iniciar sesión');
?>

<div class="container">
    <!-- Título para la página web -->
    <h4 class="center-align indigo-text">Iniciar sesión</h4>
    <!-- Formulario para iniciar sesión -->
    <form method="post" id="session-form">
        <div class="row">
            <div class="input-field col s12 m4 offset-m4">
                <i class="material-icons prefix">email</i>
                <input type="email" id="correo" name="correo" class="validate" required/>
                <label for="usuario">Correo electrónico</label>
            </div>
            <div class="input-field col s12 m4 offset-m4">
                <i class="material-icons prefix">security</i>
                <input type="password" id="clave" name="clave" class="validate" required/>
                <label for="clave">Clave</label>
            </div>
        </div>
        <div class="row center-align">
            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>
            <a href="signin.php" type="submit" class="btn waves-effect indigo tooltipped" data-tooltip="Registrarse"><i class="material-icons">person</i></a>
        </div>
    </form>
      <!--Boton para recuperar contraseña-->
      <div class="col s12 center-align">
               <p><a href="#res-password-modal" class="btn waves-effect black tooltipped modal-trigger" data-tooltip="Recuperar Contraseña"><i class="material-icons">person</i></a></p>
        </div>

        <!-- Componente Modal para mostrar el formulario de cambiar contraseña -->
        <div id="res-password-modal" class="modal">
            <div class="modal-content">
                <h4 class="center-align">recuperar contraseña</h4>
                <form method="post" id="res-password-form">
                    <div class="row center-align">
                        
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix">email</i>
                            <input id="correo" type="email" name="correo" class="validate" required/>
                            <label for="correo">Correo</label>
                        </div>
                    </div>
                    <div class="row center-align">
                        <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                    </div>
                </form>
            </div>
        </div>
</div>

<?php
Commerce::footerTemplate('login.js');
?>