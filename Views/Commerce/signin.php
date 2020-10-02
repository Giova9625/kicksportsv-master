<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Registrarse');
?>

<div class="container">
    <!-- Título para la página web -->
    <h4 class="center-align indigo-text">Regístrate como Cliente</h4>
    <!-- Formulario para crear cuenta -->
    <form method="post" id="register-form">
        <!-- Campo oculto para asignar el token del reCAPTCHA -->
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"/>
        <div class="row">
        <!--Validacion pattern para nombres propios-->
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">account_box</i>
                <input type="text" id="nombre" name="nombre" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required/>
                <label for="nombre">Nombres</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">account_box</i>
                <input type="text" id="apellido" name="apellido" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required/>
                <label for="apellido">Apellidos</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">assignment_ind</i>
                <input type="text" id="apodo" name="apodo" maxlength="100" class="validate" required/>
                <label for="apodo">Apodo</label>
            </div>
            <!--Validacion pattern para correo-->
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">email</i>
                <input type="text" id="correo" name="correo" placeholder="Ingrese correo"  class="validate" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required/>
                <label for="dui_cliente">Correo</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">phone</i>
                <input type="text" id="telefono" name="telefono" placeholder="00000000" pattern="[2,6,7]{1}[0-9]{3}[0-9]{4}" class="validate" required/>
                <label for="telefono">Teléfono</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">place</i>
                <input type="text" id="direccion" name="direccion" class="validate" required/>
                <label for="direccion">Direccion</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">domain</i>
                <input type="text" id="ciudad" name="ciudad" class="validate" pattern="[A-Za-z]{}" required/>
                <label for="ciudad">Ciudad</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">domain</i>
                <input type="text" id="codigo_postal" name="codigo_postal" class="validate" required/>
                <label for="codigo_postal">Codigo postal</label>
            </div>
           <!--Validacion pattern para password-->
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">security</i>
                <input type="password" id="contra" name="contra" class="validate" pattern=".{8,}" title="Eight or more characters" required/>
                <label for="contra">Clave</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">security</i>
                <input type="password" id="contra2" name="contra2" class="validate" pattern=".{8,}" title="Eight or more characters" required/>
                <label for="contra2">Confirmar clave</label>
            </div>
            <div class="input-field col s12 m6">
                <select class="browser-default validate" id="genero" name="genero" required>
                    <option value="" disabled selected>⠀⠀⠀Seleccione Genero</option>
                    <option value="Masculino">⠀⠀⠀⠀Masculino</option>
                    <option value="Femenino">⠀⠀⠀⠀Femenino</option>
                </select>
                <i class="material-icons prefix">wc</i>
                <label for="genero"></label>
            </div>
            <div class="input-field col s12 m6">
                <select class="browser-default" id="departamento" name="departamento" required>
                    <option value="" disabled selected>⠀⠀⠀⠀Seleccione Departamento</option>
                    <option value="San Salvador">⠀⠀San Salvador</option>
                    <option value="San Miguel">⠀⠀San Miguel</option>
                    <option value="Santa Ana">⠀⠀Santa Ana</option>
                    <option value="Sonsonate">⠀⠀Sonsonate</option>
                    <option value="Cabañas">⠀⠀Cabañas</option>
                    <option value="Chalatenango">⠀⠀Chalatenango</option>
                </select>
                <i class="material-icons prefix">location_city</i>
                <label for="departamento"></label>
            </div>
            <label class="center-align col s12">
                <input type="checkbox" id="condicion" name="condicion" required/>
                <span>Acepto <a href="#terminos" class="modal-trigger">términos y condiciones</a></span>
            </label>
        </div>
        <div class="row center-align">
            <div class="col s12">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Registrar"><i class="material-icons">send</i></button>
            </div>
        </div>
    </form>
</div>

<!-- Importación del archivo para que funcione el reCAPTCHA. Para más información https://developers.google.com/recaptcha/docs/v3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LdBzLQUAAAAAJvH-aCUUJgliLOjLcmrHN06RFXT"></script>

<?php
Commerce::footerTemplate('cliente.js');
?>