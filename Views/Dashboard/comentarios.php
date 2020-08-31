
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Comentarios</title>
	<title>Productos</title>
	<link rel="stylesheet" href="../../Resources/Css/normalize.css">
	<link rel="stylesheet" href="../../Resources/Css/sweetalert2.css">
	<link rel="stylesheet" href="../../Resources/Css/material.min.css">
	<link rel="stylesheet" href="../../Resources/Css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../../Resources/Css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="../../Resources/Css/main.css">

</head>
<body>
	<!-- Notifications area -->
	
	<!-- navLateral -->
	<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> KickSportSV 
			</div>
			<figure class="full-width navLateral-body-tittle-menu">
				<div>
					<img src="../../Resources/Img/avatar-male.png" alt="Avatar" class="img-responsive">
				</div>
				<figcaption>
					<span>
						Henryayala@gmail.com<br>
						<small>Administrador</small>
					</span>
				</figcaption>
			</figure>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">
					<li class="full-width">
						<a href="Principal.html" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
							<div class="navLateral-body-cr">
								INICIO
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-case"></i>
							</div>
							<div class="navLateral-body-cr">
								ADMINISTRAR
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="marcas.html" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-assignment-o"></i>
									</div>
									<div class="navLateral-body-cr">
										MARCAS
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="tallas.html" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-developer-board"></i>
									</div>
									<div class="navLateral-body-cr">
										TALLAS
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="comentarios.html class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-comment-alt-text"></i>
									</div>
									<div class="navLateral-body-cr">
										COMENTARIOS
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="noticias.html" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-image-alt"></i>
									</div>
									<div class="navLateral-body-cr">
										NOTICIAS
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-face"></i>
							</div>
							<div class="navLateral-body-cr">
								USUARIOS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="administrador.html" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-account"></i>
									</div>
									<div class="navLateral-body-cr">
										ADMINISTRADORES
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="cliente.html" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-accounts"></i>
									</div>
									<div class="navLateral-body-cr">
										CLIENTES
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="productos.html" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-store"></i>
							</div>
							<div class="navLateral-body-cr">
								PRODUCTOS
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="pedidos.html" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
							<div class="navLateral-body-cr">
								PEDIDOS
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="inventario.html" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-truck"></i>
							</div>
							<div class="navLateral-body-cr">
								INVENTARIO
							</div>
						</a>
					</li>
					
				</ul>
			</nav>
		</div>
	</section>
	<!-- pageContent -->
	<section class="full-width pageContent">
		<!-- navBar -->
		<div class="full-width navBar">
			<div class="full-width navBar-options">
				<i class="zmdi zmdi-swap btn-menu" id="btn-menu"></i>	
				<div class="mdl-tooltip" for="btn-menu">Ocultar / Mostrar MENU</div>
				<nav class="navBar-options-list">
					<ul class="list-unstyle">
						
						<li class="btn-exit" id="btn-exit">
							<i class="zmdi zmdi-power"></i>
							<div class="mdl-tooltip" for="btn-exit">Cerrar Sesion</div>
						</li>
						<li class="text-condensedLight noLink" ><small>Henryayala@gmail.com</small></li>
						<li class="noLink">
							<figure>
								<img src="../../Resources/Img/avatar-male.png" alt="Avatar" class="img-responsive">
							</figure>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-card"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En este apartado se podran mostrar y ocultar los distintos comentarios de un producto .
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			
			
			
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<form action="#">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
								<label class="mdl-button mdl-js-button mdl-button--icon" for="searchProduct">
									<i class="zmdi zmdi-search"></i>
								</label>
								<div class="mdl-textfield__expandable-holder">
									<input class="mdl-textfield__input" type="text" id="searchProduct">
									<label class="mdl-textfield__label"></label>
								</div>
							</div>
						</form>
					
						<div class="full-width text-center" style="padding: 30px 0;">
							<div class="mdl-card mdl-shadow--2dp full-width product-card">
								<div class="mdl-card__title">
									<img src="../../Resources/Img/city.jpg" alt="product" class="img-responsive">
								</div>
								<div class="mdl-card__supporting-text">
									<div class="table-responsive">
									<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
									<thead>
										<tr>
											<th class="mdl-data-table__cell--non-numeric">Cliente</th>
											<th>Comentario</th>
											<th>Fecha</th>
											<th>Hora</th>
											<th>Calificacion</th>
											<th>Ocultar</th>
					
										</tr>
									</thead>

									<tbody>
										<tr>
											<td class="mdl-data-table__cell--non-numeric">Angelo</td>
											<td>muy buen producto</td>
											
											<td>2020/02/11</td>
											<td>8:45PM</td>
											<td><i class="zmdi zmdi-star"><small>4</small></i></td>
											<td><button class="btn-ocultar_comentario mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-ocultar_comentario" ><i class="zmdi zmdi-eye-off"></i></button></td>										</tr>

									</tbody>

									</table>
									</div>
								</div>
								<div class="mdl-card__actions mdl-card--border">
									Camiseta Manchester C 19/20
									
								</div>
							</div>
							<div class="mdl-card mdl-shadow--2dp full-width product-card">
								<div class="mdl-card__title">
									<img src="../../Resources/Img/juve.jpg" alt="product" class="img-responsive">
								</div>
								<div class="mdl-card__supporting-text">
									<div class="table-responsive">
										<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
										<thead>
											<tr>
												<th class="mdl-data-table__cell--non-numeric">Cliente</th>
												<th>Comentario</th>
												<th>Fecha</th>
												<th>Hora</th>
												<th>Calificacion</th>
												<th>Ocultar</th>
						
											</tr>
										</thead>
	
										<tbody>
											<tr>
												<td class="mdl-data-table__cell--non-numeric">Fernando</td>
												<td>Gran calidad</td>
												
												<td>2020/01/22</td>
												<td>10:45AM</td>
												<td><i class="zmdi zmdi-star"><small>5</small></i></td>
												<td><button class="btn-ocultar_comentario mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-ocultar_comentario" ><i class="zmdi zmdi-eye-off"></i></button></td>											</tr>
	
										</tbody>
	
										</table>
										</div>
								</div>
								<div class="mdl-card__actions mdl-card--border">
									Camiseta Juventus 19/20
									
								</div>
							</div>
							<div class="mdl-card mdl-shadow--2dp full-width product-card">
								<div class="mdl-card__title">
									<img src="../../Resources/Img/psg.jpg" alt="product" class="img-responsive">
								</div>
								<div class="mdl-card__supporting-text">
									<div class="table-responsive">
										<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
										<thead>
											<tr>
												<th class="mdl-data-table__cell--non-numeric">Cliente</th>
												<th>Comentario</th>
												<th>Fecha</th>
												<th>Hora</th>
												<th>Calificacion</th>
												<th>Ocultar</th>
						
											</tr>
										</thead>
	
										<tbody>
											<tr>
												<td class="mdl-data-table__cell--non-numeric">Luis</td>
												<td>Precios muy altos</td>
												
												<td>2020/03/01</td>
												<td>23:00AM</td>
												<td><i class="zmdi zmdi-star"><small>1</small></i></td>
												<td><button class="btn-ocultar_comentario mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-ocultar_comentario" ><i class="zmdi zmdi-eye-off"></i></button></td>											</tr>
	
										</tbody>
	
										</table>
										</div>
								</div>
								<div class="mdl-card__actions mdl-card--border">
									Camiseta PSG 19/20
									
								</div>
							</div>
							<div class="mdl-card mdl-shadow--2dp full-width product-card">
								<div class="mdl-card__title">
									<img src="../../Resources/Img/bvb.jpg" alt="product" class="img-responsive">
								</div>
								<div class="mdl-card__supporting-text">
									<div class="table-responsive">
										<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
										<thead>
											<tr>
												<th class="mdl-data-table__cell--non-numeric">Cliente</th>
												<th>Comentario</th>
												<th>Fecha</th>
												<th>Hora</th>
												<th>Calificacion</th>
												<th>Ocultar</th>
						
											</tr>
										</thead>
	
										<tbody>
											<tr>
												<td class="mdl-data-table__cell--non-numeric">Angela</td>
												<td>Ahora me vere com gran fanatico</td>
												
												<td>2020/01/10</td>
												<td>06:45AM</td>
												<td><i class="zmdi zmdi-star"><small>5</small></i></td>
												<td><button class="btn-ocultar_comentario mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-ocultar_comentario" ><i class="zmdi zmdi-eye-off"></i></button></td>											</tr>
	
										</tbody>
	
										</table>
										</div>
								</div>
								<div class="mdl-card__actions mdl-card--border">
									Camiseta BVB 19/20
									
								</div>
							</div>
							<div class="mdl-card mdl-shadow--2dp full-width product-card">
								<div class="mdl-card__title">
									<img src="../../Resources/Img/madrid.jpg" alt="product" class="img-responsive">
								</div>
								<div class="mdl-card__supporting-text">
									<div class="table-responsive">
										<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
										<thead>
											<tr>
												<th class="mdl-data-table__cell--non-numeric">Cliente</th>
												<th>Comentario</th>
												<th>Fecha</th>
												<th>Hora</th>
												<th>Calificacion</th>
												<th>Ocultar</th>
						
											</tr>
										</thead>
	
										<tbody>
											<tr>
												<td class="mdl-data-table__cell--non-numeric">Fernando</td>
												<td>Hay mejores tiendas</td>
												
												<td>2020/02/22</td>
												<td>21:00PM</td>
												<td><i class="zmdi zmdi-star"><small>5</small></i></td>
												<td><button class="btn-ocultar_comentario mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn-ocultar_comentario" ><i class="zmdi zmdi-eye-off"></i></button></td>
											</tr>
	
										</tbody>
	
										</table>
										</div>
								</div>
								<div class="mdl-card__actions mdl-card--border">
									Camiseta Real Madrid 19/20
									
								</div>
							</div>
						</div>
					</div>
				</div>
			
		</div>
	</section>
	<script src="../../Resources/Js/jquery-3.4.1.min.js"></script>
	<script>window.jQuery || document.write('<script src="../../Resources/Js/jquery-3.4.1.min.js"><\/script>')</script>
	<script src="../../Resources/Js/material.min.js" ></script>
	<script src="../../Resources/Js/sweetalert2.min.js" ></script>
	<script src="../../Resources/Js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="../../Resources/Js/mainn.js" ></script>
</body>
</html>