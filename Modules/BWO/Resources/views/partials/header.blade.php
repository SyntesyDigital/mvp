<!-- HEADER -->
<header>
<!-- CORPO i IDIOMES -->
	<div class="container-fluid">
		<div class="row">
			<div class="menus">
				<div class="navbar-menu navbar-menu-user">
					<nav class="navbar">
						<div class="navbar-header navbar-header-user">
							<button id="btn-user-menu" class="navbar-toggle" type="button" data-toggle="collapse" data-target="#user-menu">
									<i class="fa fa-user"></i>
							</button>
						</div>

						<div id="user-menu" class="collapse navbar-collapse js-navbar-collapse">
									<ul class="navbar-nav mr-auto buttons-nabvar">

										@if(Auth::check())
											@if(Auth::user()->hasRole('candidate'))
												<li class="nav-item">
													<a class="nav-link btn btn-soft-gray" href="{{route('candidate')}}"><i class="fa fa-user-circle-o"></i> Mon Espace
														<span class="sr-only">(current)</span>
													</a>
												</li>
											@endif
											@if(Auth::user()->hasRole('enterprise'))
												<li class="nav-item">
													<a class="nav-link btn btn-soft-gray" href="#"><i class="fa fa-user-circle-o"></i> Mon Espace
														<span class="sr-only">(current)</span>
													</a>
												</li>
											@endif
											@if(Auth::user()->hasRole('admin'))
												<li class="nav-item">
													<a class="nav-link btn btn-soft-gray" href="{{route('dashboard')}}"><i class="fa fa-user-circle-o"></i> Espace Admin
														<span class="sr-only">(current)</span>
													</a>
												</li>
											@endif
											<li class="nav-item">
												<form id="logout-form" action="{{ route('logout') }}" method="POST">
														{{csrf_field()}}
													<button class="nav-link btn btn-dark-gray btn-logout" type="submit" ><i class="fa fa-sign-out"></i> Deconnexion</button>
												</form>
											</li>
										@else

											<li class="nav-item">
												<a class="nav-link btn btn-soft-gray application-btn" href="#">Espace Candidat
													<span class="sr-only">(current)</span>
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link btn btn-dark-gray application-btn" href="#">Espace Enterprise</a>
											</li>
										@endif

									</ul>
						</div><!-- /.nav-collapse -->
					</nav>
				</div>
				<div class="navbar-menu navbar-menu-main">
					<nav class="navbar">
						<div class="navbar-header navbar-header-main">
							<button id="btn-main-menu" class="navbar-toggle" type="button" data-toggle="collapse" data-target="#main-menu">
								<i class="fa fa-bars"></i>
							</button>
						</div>

						<div id="main-menu" class="collapse navbar-collapse js-navbar-collapse">
									@include ('bwo::partials.menu')
						</div><!-- /.nav-collapse -->
					</nav>
			</div>
			</div>
			<div class="logo-container">
				<div class="corporatiu">
					<a href="{{route('home')}}">
						<img id="logo-big" src="{{asset('modules/bwo/images/logo.jpg')}}" alt="BWO Intérim"/>
						<img id="logo-resp" src="{{asset('modules/bwo/images/logo-resp.jpg')}}" alt="BWO Intérim"/>
					</a>
				</div>
			</div>

		</div>
	</div>


</header><!-- end HEADER -->

@push('javascripts')

@endpush
