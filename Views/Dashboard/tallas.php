
<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Administrar tallas');
?>

<?php
include('../../core/helpers/inactividadpriv.php'); 
?>
		
		
		
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-developer-board"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En este apartado se pueden administrar las tallas de las camisetas que se manejan.
				</p>
			</div>
		</section>
		
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-success text-center tittles">
								Lista de noticias
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
								<button onclick="openCreateModal()" type="button" class="mdl-button">Crear</button>
							
								<div class="table-responsive">
					<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
						<thead>
							<tr>
								<th class="mdl-data-table__cell--non-numeric">Talla</th>
								<th>Descripcion</th>
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
		</div>

	
	
	
	<!-- modal crear talla -->

	<dialog class="mdl-dialog" id="crtdialog">
		<h4 class="mdl-dialog__title">Crear Talla</h4>
      	<div class="mdl-dialog__content">
		  <div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-content">
								<form method="post" id="crtform">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="talla1" name="talla1"  type="text" class="mdl-textfield__input validate" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,4}" maxlenght="4" required>
												<label class="mdl-textfield__label" for="talla1">Talla</label>
											</div>
									    </div>

										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<textarea id="descripcion1" name="descripcion1" class="mdl-textfield__input validate" pattern="[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s]{1,45}"  maxlength="45" type="text" rows= "3" ></textarea>
												<label class="mdl-textfield__label" for="description1">Descripcion de la talla</label>
											</div>
										</div>
		
									   
									</div>
									<p class="text-center">
									<div class="mdl-dialog__actions ">
        									<button type="submit" class="mdl-button">Crear</button>
        									<button onclick="dialog1.close();" type="button" class="mdl-button">Cancelar</button>
      								</div>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	</dialog>



	<!-- modal actualizar talla-->
	<dialog class="mdl-dialog" id="uptdialog">
		<h4 class="mdl-dialog__title">Actualizar Talla</h4>
      	<div class="mdl-dialog__content">
		  <div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-content">
								<form method="post" id="uptform">
								<input class="hide" type="text" id="id_talla2" name="id_talla2">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="talla2" name="talla2"  type="text" class="mdl-textfield__input validate" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,4}" maxlenght="4" required>
												<label class="mdl-textfield__label" for="talla2">Talla</label>
											</div>
									    </div>

										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<textarea id="descripcion2" name="descripcion2" class="mdl-textfield__input validate" type="text" pattern="[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s]{1,45}"  maxlength="45" rows= "3" ></textarea>
												<label class="mdl-textfield__label" for="description2">Descripcion de la talla</label>
											</div>
										</div>
		
									   
									</div>
									<p class="text-center">
									<div class="mdl-dialog__actions ">
        									<button type="submit" class="mdl-button">Actualizar</button>
        									<button onclick="dialog2.close();" type="button" class="mdl-button">Cancelar</button>
      								</div>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	</dialog>
	






		
	<?php
		Dashboard::footerTemplate('tallas.js');
	?>
