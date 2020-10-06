<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Administrar marcas');
?>
		
		
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-assignment-o"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En este apartado se pueden administrar las marcas de las camisetas que se manejan.
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-success text-center tittles">
								Lista de marcas
							</div>
							<div class="full-width panel-content">
				
								<form  method="post" id="search-form">
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
								<th class="mdl-data-table__cell--non-numeric">Marca</th>
								<th>Logo</th>
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
		
		<!-- modal crar marca -->
		
		<dialog class="mdl-dialog" id="crtdialog">
			<h4 class="mdl-dialog__title">Crear Talla</h4>
			<div class="mdl-dialog__content">
			<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-content">
								<form  method="post" id="crtform" enctype="multipart/form-data" >
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--12-col">
									        <legend class="text-condensedLight"><i class="zmdi zmdi-border-color"></i> &nbsp; Datos de la marca</legend><br>
									    </div>
									   
									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet mdl-cell--12-col">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="nombre1" name="nombre1" type="text" class="mdl-textfield__input validate" pattern="[a-zA-Z0-9#ñÑáÁéÉíÍóÓúÚ\s\,\:\;\.\-\+]{1,15}" maxlenght="15" required >
												<label class="mdl-textfield__label" for="nombre1">Marca</label>
											</div>
										</div>
										
										<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet" id="bnt-tl"><div class="mdl-tooltip" for="bnt-tl">"Seleccione una imagen de al menos 500x500"</div>
											
												<input id="archivo_categoria1" type="file" name="archivo categoria1" accept=".gift, .jpg, .png">
											
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


		<!-- modal actualizar marca -->
		<dialog class="mdl-dialog" id="uptdialog">
			<h4 class="mdl-dialog__title">Actualizar Marca</h4>
			<div class="mdl-dialog__content">
			<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-content">
								<form  method="post" id="uptform" enctype="multipart/form-data" >
								<input class="hide" type="text" id="id_marca2" name="id_marca2"/>
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--12-col">
									        <legend class="text-condensedLight"><i class="zmdi zmdi-border-color"></i> &nbsp; Datos de la marca</legend><br>
									    </div>
									   
									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="nombre2" name="nombre2" type="text" class="mdl-textfield__input validate" pattern="[a-zA-Z0-9#ñÑáÁéÉíÍóÓúÚ\s\,\:\;\.\-\+]{1,15}" maxlenght="15" required >
												<label class="mdl-textfield__label" for="nombre2">Marca</label>
											</div>
										</div>
										
										<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet" id="bnt-tl"><div class="mdl-tooltip" for="bnt-tl">"Seleccione una imagen de al menos 500x500"</div>
											
												<input id="archivo_categoria2" type="file" name="archivo categoria2" accept=".gift, .jpg, .png">
											
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
		Dashboard::footerTemplate('marcas.js');
	?>
