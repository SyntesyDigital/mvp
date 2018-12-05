<!-- HEADER -->
<header>
<!-- CORPO i IDIOMES -->
	<div class="container-fluid">
		<div class="row">
			<div class="menus">
				<div class="navbar-menu navbar-menu-user">
					<nav class="navbar">
						<div class="navbar-header navbar-header-user">
							<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#user-menu">
								<span class="sr-only">Menu</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<div id="user-menu" class="collapse navbar-collapse js-navbar-collapse">
									<ul class="navbar-nav mr-auto">
										<li class="nav-item">
											<a class="nav-link btn btn-soft-gray" href="#">Espace Candidat <span class="sr-only">(current)</span></a>
										</li>
										<li class="nav-item">
											<a class="nav-link btn btn-dark-gray" href="#">Espace Enterprise</a>
										</li>
									</ul>
						</div><!-- /.nav-collapse -->
					</nav>
				</div>
				<div class="navbar-menu navbar-menu-main">
				<nav class="navbar">
					<div class="navbar-header navbar-header-main">
						<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#main-menu">
							<span class="sr-only">Menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div id="main-menu" class="collapse navbar-collapse js-navbar-collapse">
								<ul class="navbar-nav mr-auto">
									<li class="nav-item active">
										<a class="nav-link" href="#">OFFRES <span class="sr-only">(current)</span></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">ACTUALITÉS</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">ENTERPRISES</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">BWO</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">CONTACT</a>
									</li>
								</ul>
					</div><!-- /.nav-collapse -->
				</nav>
			</div>
			</div>
			<div class="logo-container">
				<div class="corporatiu"><a href="{{route('home')}}"><img src="{{asset('modules/bwo/images/logo.jpg')}}" alt="BWO Intérim"/></a></div>
			</div>

		</div>
	</div>
</header><!-- end HEADER -->

@push('javascripts')

@endpush
