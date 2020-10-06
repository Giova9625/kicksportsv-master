
<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Administrar productos');
?>

		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-store"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En este apartado se podran ingresar los distintos productos con las que se trabaja la empresa.
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

								<!-- Enlace para generar un reporte en formato PDF -->
								<a href="../../Core/Reports/Dashboard/productos.php"  class="  mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-addAdmin" > <i class="zmdi zmdi-assignment-o"></i> </a>
								<div class="mdl-tooltip" for="btn-addAdmin">Reporte productos por marca</div>
								<!-- Enlace para generar un reporte en formato PDF -->
								<a href="../../Core/Reports/Dashboard/precioproductos.php"  class="  mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-addAdmin1" ><i class="zmdi zmdi-assignment-o"></i> </a>
								<div class="mdl-tooltip" for="btn-addAdmin1">Reporte precio de los producto</div>
								
								<div class="table-responsive">
					<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
						<thead>
							<tr>
								<th class="mdl-data-table__cell--non-numeric">Imagen</th>
								<th>Producto</th>
								<th>Descripcion</th>
								<th>Precio</th>
								<th>Marca</th>	
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



		<!--Ventana modal crear producto-->
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
 
		<!--Venatana modal actualizar producto-->


		<dialog class="mdl-dialog" id="uptdialog">
      <h4 class="mdl-dialog__title">Actualizar Producto</h4>
      <div class="mdl-dialog__content">
        
	  <div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-content">
								<form method="post" id="uptform" enctype="multipart/form-data">
								<input class="hide" type="text" id="id_producto2" name="id_producto2">
									
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="producto2" type="text" name="producto2" class="mdl-textfield__input validate" required>
												<label class="mdl-textfield__label" for="producto2">Nombre del producto</label>
												
											</div>
										</div>

										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<textarea id="descripcion2" name="descripcion2" class="mdl-textfield__input validate" type="text" rows= "3" ></textarea>
												<label class="mdl-textfield__label" for="descripcion2">Descripcion</label>
											</div>
										</div>
									
										<div class="mdl-cell mdl-cell---col mdl-cell--6-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="precio2" type="number" name="precio2" class="mdl-textfield__input validate" max="999.99" min="0.01" step="any" required>
												<label class="mdl-textfield__label" for="precio2">Precio</label>
											</div>
										</div>
										
										<div class="mdl-cell mdl-cell--6-col">
											<div class="mdl-textfield mdl-js-textfield">
												<select class="mdl-textfield__input"  id="marca2" name="marca2">
												</select>
												<label class="mdl-textfield__label" for="marca2">Marca</label>
											</div>
										</div>
										
										<div class="mdl-cell mdl-cell--12-col">
									        <legend class="text-condensedLight"><i class="zmdi zmdi-border-color"></i> &nbsp; SELECCIONAR IMAGEN</legend><br>
									    </div>
									
										
										<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet" id="btn-tool"><div class="mdl-tooltip" for="btn-tool">"Seleccione una imagen de al menos 500x500"</div>
												<input  id="archivo_producto2" type="file" name="archivo_producto2" accept=".gift, .jpg, .png" >
											
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
		Dashboard::footerTemplate('productos.js');
		?>