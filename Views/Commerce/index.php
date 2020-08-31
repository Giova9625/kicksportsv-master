<?php
require_once('../../Core/Helpers/Commerce.php');
Commerce::headerTemplate('Tienda de camisetas KickSportsv');
?>

<!-- Slider con indicadores, altura de 400px y una duración entre transiciones de 6 segundos -->
<div class="slider" id="slider">
    <ul class="slides">
        <li>
            <img src="../../Resources/Img/camisetas3.jpg" alt="Primera foto">
            <div class="caption center-align">
                <h2>La mejor tienda de camisetas</h2>
                <h4>Diseños y tallas para cada cliente.</h4>
            </div>
        </li>
        <li>
            <img src="../../resources/img/s2.jpg" alt="Segunda foto">
            <div class="caption left-align">
                <h2>¿Buscas camisetas deportivas?</h2>
                <h4>¡En KickSportsv las encontraras!</h4>
            </div>
        </li>
        <li>
            <img src="../../resources/img/camisetas.jpg" alt="Tercera foto">
            <div class="caption right-align">
                <h2>Todo nuestro catalogo de calidad</h2>
                <h4>Camisetas de tus equipos favoritos y mucho mas</h4>
            </div>
        </li>
        <li>
            <img src="../../resources/img/camisetas2.jpg" alt="Cuarta foto">
            <div class="caption center-align">
                <h2>Registrate gratis</h2>
                <h4>Equipate como un campeon</h4>
            </div>
        </li>
    </ul>
</div>

<div class="container">
    <!-- Título para la página web -->
    <h4 class="center indigo-text" id="title">Nuestras Marcas</h4>
    <!-- Fila para mostrar las categorías disponibles -->
    <div class="row" id="productos"></div>
</div>

<?php
Commerce::footerTemplate('index.js');
?>