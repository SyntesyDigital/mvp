<!-- HEADER -->
<header>
<!-- CORPO i IDIOMES -->
	<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-3 col-xs-6">
					<div class="corporatiu"><a href="{{route('home')}}"><img src="{{asset('modules/turisme/images/logo-corporatiu-barcelona-turisme.png')}}" alt="Turisme Barcelona"/></a></div>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-4 pull-right">
					<div class="idiomes">
						@include("turisme::partials.languages")
					</div>
				</div>
			</div>
	</div>
	<!-- END CORPO I IDIOMES -->
	<!-- MENU I SEARCH -->
	<div class="container">
	<nav class="navbar">
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
			<span class="sr-only">Menu</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

	</div>

	<div class="collapse navbar-collapse js-navbar-collapse">
	 <!-- buscador -->
								<form class="col-md-12 buscar">
							<input type="text" placeholder="Introdueix el mot que cerques (TEXT)">
										 </form>
	<!-- end buscador -->

		<ul class="nav navbar-nav menu-general">
			<li class="dropdown mega-dropdown active">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Travel Trade</a>
				<ul class="dropdown-menu mega-dropdown-menu">
					<li  class="col-sm-8">
						<ul>
							<li class="col-sm-4">
								<a href="{{route('content.show',['slug' => 'por-que-barcelona-razon-ejemplo'])}}">Por qué Barcelona?</a>
							</li>
							<li class="col-sm-4">
								<a href="{{route('content.show',['slug' => 'productos-turisticos'])}}">Productos turísticos</a>
							</li>
							<li class="col-sm-4">
								<a href="{{route('content.show',['slug' => 'catalogo-de-productos'])}}">Catálogo de productos</a>
							</li>

							<li class="col-sm-4">
								<a href="{{route('content.show',['slug' => 'faq'])}}">FAQ</a>
							</li>
						</ul>
					</li>
					<li class="col-sm-4 image">
						<p class="image"><img src="modules/turisme/images/img-medium.png" alt=""></p>
						<p class="intro">Mauris sed tristique dui. Proin non odio luctus, tristique diam id, malesuada arcu. </p>

					</li>
				</ul>
			</li>
					<li class="dropdown mega-dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Media Center</a>
				<ul class="dropdown-menu mega-dropdown-menu">
					<li  class="col-sm-8">
						<ul>
							<li class="col-sm-4">
								<a href="#">Sala de premsa</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Estadístiques</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Publicacions</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Apps</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Banc d'imatges</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Vídeos</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Cartografia</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Imatge Corporativa</a>
							</li>
						</ul>
					</li>
					<li class="col-sm-4 image">
						<p class="image"><img src="modules/turisme/images/img-medium.png" alt=""></p>
						<p class="intro">Mauris sed tristique dui. Proin non odio luctus, tristique diam id, malesuada arcu. </p>

					</li>
				</ul>
			</li>
					<li class="dropdown mega-dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">COrporate</a>
				<ul class="dropdown-menu mega-dropdown-menu">
					<li  class="col-sm-8">
						<ul>
							<li class="col-sm-4">
								<a href="#">Informació Corporativa</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Programes</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Directòri de Membres</a>
							</li>
							<li class="col-sm-4">
								<a href="#">Fes-te membre</a>
							</li>
						</ul>
					</li>
					<li class="col-sm-4 image">
						<p class="image"><img src="images/img-medium.png" alt=""></p>
						<p class="intro">Mauris sed tristique dui. Proin non odio luctus, tristique diam id, malesuada arcu. </p>

					</li>
				</ul>
			</li>
			<li class="">
				<a href="#">Blog</a>
			</li>

			</ul>

				<ul class="nav navbar-nav navbar-right col-md-3 col-sm-12 col-xs-12">

				<li class="link-twitter"><a href="">@BarcelonaTurism</a></li>
				<li class="boto-search">Buscar</li>
			</ul>
	</div><!-- /.nav-collapse -->
	</nav>
</div>
</header><!-- end HEADER -->
