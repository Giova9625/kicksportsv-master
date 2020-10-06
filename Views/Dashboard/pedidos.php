
<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Administrar pedidos');
?>

<?php
include('../../core/helpers/inactividadpriv.php'); 
?>
	<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-store"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En este apartado se podran observar los distintos pedidos realizados
				</p>
			</div>
		</section>
			
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-success text-center tittles">
								Lista de pedidos
							</div>
							<div class="full-width panel-content">
				
								<form  method="post" id="search-form" autocomplete="off">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
									<label class="mdl-button mdl-js-button mdl-button--icon" for="search">
									<i class="zmdi zmdi-search"></i>
									</label>
									<div class="mdl-textfield__expandable-holder">
									<input class="mdl-textfield__input" id="search" type="text" name="search" id="sample6">
									<label class="mdl-textfield__label" for="search"></label>
									</div>
									<button type="submit" class="  mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-search"><i class="zmdi zmdi-check"></i></button>
									<div class="mdl-tooltip" for="btn-search">Buscar</div>
								</div>		
								</form>
								<!-- Enlace para generar un reporte en formato PDF -->
								<a target="_blank" href="../../Core/Reports/Dashboard/Pedidocliente.php"  class="  mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-addAdmin4" ><i class="zmdi zmdi-assignment-o"></i> </a>
								<div class="mdl-tooltip" for="btn-addAdmin4">Reporte pedidos por cliente</div>
								
							
								<a target="_blank" href="../../Core/Reports/Dashboard/pedidoF.php"  class="  mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-addAdmin5" ><i class="zmdi zmdi-assignment-o"></i> </a>
								<div class="mdl-tooltip" for="btn-addAdmin5">Reporte pedidos por fecha</div>

								<div class="table-responsive">
					<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
						<thead>
							<tr>
								<th>Codigo pedido</th>
								<th class="mdl-data-table__cell--non-numeric">Cliente</th>
								<th>Estado</th>	
								<th>Opciones</th>
							</tr>
							
						</thead>
						<tbody id="tbody-rows">
   						</tbody>
					</table>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>





<?php
Dashboard::footerTemplate('pedidos.js');
?>



	