<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('Detalles del producto');
?>

<?php
include('../../core/helpers/inactividad.php'); 
?>

<!-- Contenedor para mostrar el detalle del producto seleccionado previamente -->
<div class="container">
    <!-- Título para la página web -->
    <h4 class="center indigo-text" id="title">Detalles del producto</h4>
    <div class="row" id="detalle">
        <!-- Componente Horizontal Card -->
        <div class="card horizontal">
            <div class="card-image">
                <img id="imagen_producto" src="../../resources/img/prueba.png">
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <h3 id="producto" class="header"></h3>
                    <p id="descripcion"></p>
                    <p>Precio (US$) <b id="precio"></b></p>
                </div>
                <div class="card-action">
                    <!-- Formulario de cantidad para agregar el producto al carrito de compras -->
                    <form method="post" id="shopping-form" autocomplete="off">
                        <!-- Campos ocultos para asignar los datos del producto -->
                        <input type="number" id="id_producto" name="id_producto" class="hide"/>
                        <input type="number" id="cost" name="cost" step="0.01" class="hide"/>
                        <div class="row center">
                            <div class="input-field col s12 m6">
                            <!--combobox-->
                                <select class="browser-default" id="talla" name="talla" required>
                                </select>
                                <label for="talla"></label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">list</i>
                                <input type="number" id="cantidad" name="cantidad" min="1" class="validate" required/>
                                <label for="cantidad">Cantidad</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <button type="submit" class="btn waves-effect waves-light cyan darken-3" ><i class="material-icons left">add_shopping_cart</i> Añadir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
Commerce::footerTemplate('detalle.js');
?>