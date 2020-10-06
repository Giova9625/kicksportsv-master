<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Clientes');
?>

<?php
include('../../core/helpers/inactividadpriv.php'); 
?>

		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-accounts"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En este apartado se podran observar y eliminar los clientes registrados en el sistema.
				</p>
			</div>
		</section>
		<div class="full-width divider-menu-h"></div>
		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
				<div class="table-responsive">
					<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
						<thead>
							<tr>
								<th class="mdl-data-table__cell--non-numeric">Nombre</th>
								<th>Apellido</th>
								<th>Apodo</th>
								<th>Correo</th>
								<th>Direccion</th>
								<th>Departamento</th>
								<th>Telefono</th>
								<th>Genero</th>
								<th>Ciudad</th>
								<th>Codigo_postal</th>
								<th>Eliminar</th>
								
								
							</tr>
							
						</thead>
						<tbody id="tbody-rows">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<?php
Dashboard::footerTemplate('cliente.js');
?>