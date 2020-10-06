
<?php
require_once('../../Core/Helpers/dashboard.php');
Dashboard::headerTemplate('Administrar usuarios');
?>

<?php
include('../../core/helpers/inactividadpriv.php'); 
?>

		<!--contenido de la pagina-->
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-account"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En este apartado se pueden agregar y modificar los administradores que se ingresan en el sistema.
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			
				<!--Redireccion local-->
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewadmin" class="mdl-tabs__tab is-active">NUEVO</a>
				<a href="#tabListadmin" class="mdl-tabs__tab">LISTA</a>
			</div>
			<div class="mdl-tabs__panel is-active" id="tabNewadmin">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Nuevo administrador
							</div>
							<div class="full-width panel-content">
									<!--Formulario para poder agregar un administrador-->
								<form method="post" id="save-form" autocomplete="off">
								<input class="hide" type="text" id="id_administrador" name="id_administrador"/>
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--12-col">
									        <legend class="text-condensedLight"><i class="zmdi zmdi-border-color"></i> &nbsp; DATOS DEL ADMINISTRADOR</legend><br>
									    </div>

									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input  id="nombre" type="text" name="nombre" class=" mdl-textfield__input validate" required>
												<label class="mdl-textfield__label" for="nombre">Nombre</label>	
											</div>
									    </div>
										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input  id="apellido" type="text" name="apellido" class="mdl-textfield__input validate" required>
												<label class="mdl-textfield__label" for="apellido">Apellido</label>
											</div>
										</div>

										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="correo" type="email" name="correo" class="mdl-textfield__input validate" required>
												<label class="mdl-textfield__label" for="correo">E-mail</label>
											</div>
										</div>
										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
													<input id="usuario" type="text" name="usuario" class="mdl-textfield__input validate" required>
													<label class="mdl-textfield__label" for="usuario">Usuario</label>
												</div>
										</div>
										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="clave_usuario" type="password" name="clave_usuario" class="mdl-textfield__input validate" required>
												<label class="mdl-textfield__label" for="clave_usuario">Contraseña</label>
											</div>
										</div>

										<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input id="confirmar_clave" type="password" name="confirmar_clave" class="mdl-textfield__input validate" required>
												<label class="mdl-textfield__label" for="confirmar_clave">Confirmar contraseña</label>
											</div>
										</div>
											
											

									</div>
									<p class="text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="btn-addAdmin">
											<i class="zmdi zmdi-plus"></i>
										</button>
										<div class="mdl-tooltip" for="btn-addAdmin">Agregar administrador</div>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mdl-tabs__panel" id="tabListadmin">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-success text-center tittles">
								Lista de administradores
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
								<!--Boton para generar reporte-->
								<a href="../../Core/Reports/Dashboard/administrador.php"  class="  mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-addAdmin3" ><i class="zmdi zmdi-assignment-o"></i> </a>
								<div class="mdl-tooltip" for="btn-addAdmin3">Reporte de administradores</div>
								<div class="table-responsive">
					<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
						<thead>
							<tr>
								<th class="mdl-data-table__cell--non-numeric">Apellido</th>
								<th>Nombre</th>
								<th>Correo</th>	
								<th>Usuario</th>
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
	
	
		<!--Venatana emergente administradores-->
		<dialog class="mdl-dialog center mdl-cell--12-col-phone" >
			<div class="mdl-dialog__content ">
			   <div class="full-width panel-tittle bg-info text-center tittles  mdl-cell--12-col-phone">
				   Actualizar administrador
			   </div>
			   <form method="post" autocomplete="off">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<legend class="text-condensedLight"><i class="zmdi zmdi-border-color"></i> &nbsp; DATOS DEL ADMINISTRADOR</legend><br>
					</div>
					<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="NameAdmin">
							<label class="mdl-textfield__label" for="NameAdmin">Nombre</label>
							<span class="mdl-textfield__error">Error al agregar nombre</span>
						</div>
					</div>
					<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="LastNameAdmin">
							<label class="mdl-textfield__label" for="LastNameAdmin">Apellido</label>
							<span class="mdl-textfield__error">Error al agregar apellido</span>
						</div>
					</div>
					<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="email" id="emailAdmin">
							<label class="mdl-textfield__label" for="emailAdmin">E-mail</label>
							<span class="mdl-textfield__error">Error al agregar correo</span>
						</div>	
						</div>
						<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="password" id="passwordAdmin">
								<label class="mdl-textfield__label" for="passwordAdmin">Contraseña</label>
								<span class="mdl-textfield__error">Error al agregar contraseña</span>
							</div>
						</div>

						<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-z0-9áéíóúÁÉÍÓÚ]*(\.[0-9]+)?" id="UserNameAdmin">
								<label class="mdl-textfield__label" for="UserNameAdmin">Usuario</label>
								<span class="mdl-textfield__error">Error al agregar usuario</span>
							</div>
						</div>

				</div>
				</form>
			</div>
			<div class="mdl-dialog__actions mdl-dialog__actions--full-width">
				<a href="" class="btn"><button type="button" class="mdl-button mdl-button mdl-js-button mdl-button--primary ">Actualizar</button></a> 
				<a href="" class="btn"><button  class="mdl-button mdl-js-button mdl-button--accent  ">Cerrar</button></a>
			   
			</div>
		</dialog>


		<?php
		Dashboard::footerTemplate('administrador.js');
		?>
