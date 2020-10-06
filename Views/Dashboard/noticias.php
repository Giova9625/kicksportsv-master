
<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Administrar noticias');
?>
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-image-alt"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En este apartado se pueden administrar las diferentes noticias que se mostraran en el Slider de la pagina principal.
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
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
								<th class="mdl-data-table__cell--non-numeric">Titulo</th>
								<th>Descripcion</th>
								<th>Imagen</th>	
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
	
	

	<!-- emergente crear noticia -->

    <dialog class="mdl-dialog" id="crtdialog">
			<h4 class="mdl-dialog__title">Crear Noticia</h4>
			<div class="mdl-dialog__content">
			<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-content">
								<form method="post" id="crtform" enctype="multipart/form-data" autocomplete="off">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--12-col">
									        <legend class="text-condensedLight"><i class="zmdi zmdi-border-color"></i> &nbsp; Datos de noticias</legend><br>
									    </div>
									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="titulo_noticia1" name="titulo_noticia1"  type="text" class="mdl-textfield__input validate" required>
												<label class="mdl-textfield__label" for="titulo_noticia1">Titulo</label>
											</div>
									    </div>
									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<textarea id="descripcion_noticia1" name="descripcion_noticia1" class="mdl-textfield__input validate" type="text" rows= "3" ></textarea>
												<label class="mdl-textfield__label" for="description_noticia1">Descripcion</label>
											</div>
										</div>

										<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet" id="btn-tool"><div class="mdl-tooltip" for="btn-tool">"Seleccione una imagen de al menos 500x500"</div>
												<input  id="archivo_categoria1" type="file" name="archivo_categoria1" accept=".gift, .jpg, .png">
											
										</div>
									</div>
									<p class="text-center">
									        <button type="submit" class="mdl-button">Crear</button>
        									<button onclick="dialog1.close();" type="button" class="mdl-button">Cancelar</button>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	</dialog>





	
	<!-- emergente actualizar noticia -->
		
	<dialog class="mdl-dialog" id="uptdialog">
			<h4 class="mdl-dialog__title">Actualizar Noticia</h4>
			<div class="mdl-dialog__content">
			<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-content">
								<form method="post" id="uptform" enctype="multipart/form-data">
								<input class="hide" type="text" id="id_noticia2" name="id_noticia2"/>
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--12-col">
									        <legend class="text-condensedLight"><i class="zmdi zmdi-border-color"></i> &nbsp; Datos de noticias</legend><br>
									    </div>
									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="titulo_noticia2" name="titulo_noticia2"  type="text" class="mdl-textfield__input validate" required>
												<label class="mdl-textfield__label" for="titulo_noticia2">Titulo</label>
											</div>
									    </div>
									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<textarea id="descripcion_noticia2" name="descripcion_noticia2" class="mdl-textfield__input validate" type="text" rows= "3" ></textarea>
												<label class="mdl-textfield__label" for="description_noticia2">Descripcion</label>
											</div>
										</div>

										<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet" id="btn-tool"><div class="mdl-tooltip" for="btn-tool">"Seleccione una imagen de al menos 500x500"</div>
												<input  id="archivo_categoria2" type="file" name="archivo_categoria2" accept=".gift, .jpg, .png">
											
										</div>
									</div>
									<p class="text-center">
									        <button type="submit" class="mdl-button">Crear</button>
        									<button onclick="dialog2.close();" type="button" class="mdl-button">Cancelar</button>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	</dialog>


		
	<?php
		Dashboard::footerTemplate('noticias.js');
		?>