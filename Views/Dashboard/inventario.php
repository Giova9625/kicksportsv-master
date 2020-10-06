
<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Administrar existencias');
?>

<?php
include('../../core/helpers/inactividadpriv.php'); 
?>
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-truck"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En este apartado se pueden observar los productos existencias y tallas dentro de la tienda.
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
								<th class="mdl-data-table__cell--non-numeric">Producto</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Precio</th>
								<th>talla</th>
								<th>Genero</th>
								<th>Cantidad</th>
								<th>Editar</th>
							</tr>
						</thead>
						<tbody id="tbody-rows">
						</tbody>
					</table>
				</div>
			</div>
		</div>

			<!--ventana modal crear existencias/inventario-->
			<dialog class="mdl-dialog" id="crtdialog">
      <h4 class="mdl-dialog__title">Crear Producto</h4>
      <div class="mdl-dialog__content">
        
	  <div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-content">
								<form method="post" id="crtform" enctype="multipart/form-data" autocomplete="off">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="producto1" type="text" name="producto1" class="mdl-textfield__input validate" required>
												<label class="mdl-textfield__label" for="producto1">Nombre del producto</label>
												
											</div>
										</div>

										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<textarea id="descripcion1" name="descripcion1" class="mdl-textfield__input validate" type="text" rows= "3" ></textarea>
												<label class="mdl-textfield__label" for="descripcion1">Descripcion</label>
											</div>
										</div>
									
										<div class="mdl-cell mdl-cell---col mdl-cell--6-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="precio1" type="number" name="precio1" class="mdl-textfield__input validate" max="999.99" min="0.01" step="any" required>
												<label class="mdl-textfield__label" for="precio1">Precio</label>
											</div>
										</div>
										
										<div class="mdl-cell mdl-cell--6-col">
											<div class="mdl-textfield mdl-js-textfield">
												<select class="mdl-textfield__input"  id="marca1" name="marca1">
												</select>
												<label class="mdl-textfield__label" for="marca1">Marca</label>
											</div>
										</div>
										
										<div class="mdl-cell mdl-cell--12-col">
									        <legend class="text-condensedLight"><i class="zmdi zmdi-border-color"></i> &nbsp; SELECCIONAR IMAGEN</legend><br>
									    </div>
									
										
										<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet" id="btn-tool"><div class="mdl-tooltip" for="btn-tool">"Seleccione una imagen de al menos 500x500"</div>
												<input  id="archivo_producto1" type="file" name="archivo_producto1" accept=".gift, .jpg, .png" required>
											
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


	
	<?php
		Dashboard::footerTemplate('inventario.js');
	?>