<!-- HEADER -->
<header>
	<!-- CORPO i IDIOMES -->
				<div class="row row-header">
					<div class=" logo-container">
						<a href="<?php echo e(route('home')); ?>">
							<img src="<?php echo e(asset('modules/architect/images/logo.png')); ?>" alt=""/>
						</a>
					</div>
					<div class="right-part-header">
						<?php if(null !== Auth::user()): ?>
							<div class="menu-container">
								<div class="menu">
									<button id="sidebar-button" class="navbar-toggle" type="button">
										<span class="sr-only">Menu</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<div class="user-info">
									<div class="button-header-container"><a href="" class="btn btn-header"><i class="fa fa-sign-out"></i> <p class="button-text">Déconnecter</p></a></div>
									<?php if(Auth::user()->role == 1): ?>
										<div class="button-header-container"><a href="" class="btn btn-header"><i class="fa fa-cog"></i> <p class="button-text">Espace Admin</p></a></div>
									<?php endif; ?>
									<p class="user-name">Bonjour, <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?></p>
								</div>
							</div>
						<?php endif; ?>
					</div>



					<!--div class="col-md-3 col-sm-4 col-xs-4 pull-right">
						<div class="idiomes">
							<?php echo $__env->make("front::partials.languages", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div-->
				</div>
	<!-- END CORPO I IDIOMES -->
	<!-- MENU I SEARCH -->

</header><!-- end HEADER -->

<?php $__env->startPush('javascripts'); ?>
<script>
	$(function(){
		$("#sidebar-button").click(function(e){
			e.preventDefault();
			if($('#sidebar').hasClass('collapsed')){
				$('#sidebar').removeClass('collapsed');
				$('.content-wrapper').removeClass('collapsed');
				$('.sidebar-text').fadeIn();
				$('.logo-container').removeClass('collapsed');
			}else{
				$('#sidebar').addClass('collapsed');
				$('.content-wrapper').addClass('collapsed');
				$('.sidebar-text').fadeOut("fast");
				$('.logo-container').addClass('collapsed');
			}
		});

	});
</script>
<?php $__env->stopPush(); ?>
