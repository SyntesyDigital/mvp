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
		{!! display_menu('header') !!}

 		<!-- buscador -->
		<form class="col-md-12 buscar">
			<input type="text" placeholder="Introdueix el mot que cerques (TEXT)">
		</form>
		<!-- end buscador -->

		@include('turisme::partials.menu')

		<ul class="nav navbar-nav navbar-right col-md-3 col-sm-12 col-xs-12">

		<li class="link-twitter"><a href="">@BarcelonaTurism</a></li>
			<li class="boto-search">Buscar</li>
		</ul>
	</div><!-- /.nav-collapse -->
	</nav>
</div>
</header><!-- end HEADER -->
