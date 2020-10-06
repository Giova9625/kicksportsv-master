

<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Bienvenido');
?>

<?php
include('../../core/helpers/inactividadpriv.php'); 
?>



		<section class="full-width text-center" style="padding: 40px 0;">
			<h3 class="text-center tittles">MENU</h3>
			<!-- Tiles -->
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						<br>
						<small>Administradores</small>
					</span>
				</div>
				<i class="zmdi zmdi-account tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						<br>
						<small>Clientes</small>
					</span>
				</div>
				<i class="zmdi zmdi-accounts tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						<br>
						<small>Marcas</small>
					</span>
				</div>
				<i class="zmdi zmdi-assignment-o tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						<br>
						<small>Noticias</small>
					</span>
				</div>
				<i class="zmdi zmdi-image-alt tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						<br>
						<small>Productos</small>
					</span>
				</div>
				<i class="zmdi zmdi-store tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						<br>
						<small>Pedidos</small>
					</span>
				</div>
				<i class="zmdi zmdi-shopping-cart tile-icon"></i>
			</article>
		</section>

		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--6-col-desktop">
        		<canvas id="chart"></canvas>
    		</div>

			<div class="mdl-cell mdl-cell--6-col-desktop">
        		<canvas id="chart3"></canvas>
    		</div>

			<div class="mdl-cell mdl-cell--6-col-desktop">
        		<canvas id="chart4"></canvas>
    		</div>

			<div class="mdl-cell mdl-cell--6-col-desktop">
        		<canvas id="chart5"></canvas>
    		</div>

			<div class="mdl-cell mdl-cell--12-col-desktop">
        		<canvas id="chart2"></canvas>
    		</div>
		</div>

		<script type="text/javascript" src="../../Resources/Js/chart.js"></script>
		
		<?php
		Dashboard::footerTemplate('principal.js');
		?>