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

										<?php if(Auth::check()): ?>
											<?php if(Auth::user()->hasRole('candidate')): ?>
												<li class="nav-item">
													<a class="nav-link btn btn-soft-gray" href="<?php echo e(route('candidate.index')); ?>"><i class="fa fa-user-circle-o"></i> Mon Espace
														<span class="sr-only">(current)</span>
													</a>
												</li>
											<?php endif; ?>
											<?php if(Auth::user()->hasRole('enterprise')): ?>
												<li class="nav-item">
													<a class="nav-link btn btn-soft-gray" href="#"><i class="fa fa-user-circle-o"></i> Mon Espace
														<span class="sr-only">(current)</span>
													</a>
												</li>
											<?php endif; ?>
											<?php if(Auth::user()->hasRole('admin')): ?>
												<li class="nav-item">
													<a class="nav-link btn btn-soft-gray" href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-user-circle-o"></i> Espace Admin
														<span class="sr-only">(current)</span>
													</a>
												</li>
											<?php endif; ?>
											<li class="nav-item">
												<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
														<?php echo e(csrf_field()); ?>

													<button class="nav-link btn btn-dark-gray btn-logout" type="submit" ><i class="fa fa-sign-out"></i> Deconnexion</button>
												</form>
											</li>
										<?php else: ?>

											<li class="nav-item">
												<a class="nav-link btn btn-soft-gray application-btn" href="#">Espace Candidat
													<span class="sr-only">(current)</span>
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link btn btn-dark-gray application-btn" href="#">Espace Enterprise</a>
											</li>
										<?php endif; ?>

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
									<?php echo $__env->make('bwo::partials.menu',
										["menu" => get_menu('header')]
									, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div><!-- /.nav-collapse -->
					</nav>
			</div>
			</div>
			<div class="logo-container">
				<div class="corporatiu">
					<a href="<?php echo e(route('home')); ?>">
						<img id="logo-big" src="<?php echo e(asset('modules/bwo/images/logo.jpg')); ?>" alt="BWO Intérim"/>
						<img id="logo-resp" src="<?php echo e(asset('modules/bwo/images/logo-resp.jpg')); ?>" alt="BWO Intérim"/>
					</a>
				</div>
			</div>

		</div>
	</div>


</header><!-- end HEADER -->

<?php $__env->startPush('javascripts'); ?>

<?php $__env->stopPush(); ?>
