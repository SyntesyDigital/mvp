<!-- HEADER -->
<header>
<!-- CORPO i IDIOMES -->
	<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-3 col-xs-6">
					<div class="corporatiu"><a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('modules/turisme/images/logo-corporatiu-barcelona-turisme.png')); ?>" alt="Turisme Barcelona"/></a></div>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-4 pull-right">
					<div class="idiomes">
						<?php echo $__env->make("turisme::partials.languages", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

	<div id="main-menu" class="collapse navbar-collapse js-navbar-collapse">

		 		<!-- buscador -->
				<form class="col-md-12 buscar" method="GET" action="<?php echo e(route('front.search')); ?>">
					<input type="text" name="q" placeholder="Introdueix el mot que cerques (TEXT)">
				</form>
				<!-- end buscador -->

				<?php echo $__env->make('turisme::partials.menu_header',[
					"menu" => get_menu('header')
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<ul class="nav navbar-nav navbar-right col-md-3 col-sm-12 col-xs-12">

		<li class="link-twitter">
				<?php
					$twitter = [
						"es" => "",
						"fr" => ""
					];
				?>
				<a href="<?php echo e($twitter[App::getLocale()]); ?>" target="_blank">@twitter</a>
			</li>
			<li class="boto-search">Buscar </li>
		</ul>
	</div><!-- /.nav-collapse -->
	</nav>
</div>
</header><!-- end HEADER -->

<?php $__env->startPush('javascripts'); ?>
<script>
	$(function(){
		$(".boto-search").click(function(e){
			e.preventDefault();
			$("form.buscar input").removeClass('has-error');

			if($("form.buscar").css('display') != "block"){
				$("form.buscar").css({display:'block'});
			}
			else {
				if($("form.buscar input").val() != ""){
					$("form.buscar").submit();
				}
				else {
					$("form.buscar input").addClass('has-error');
				}
			}
		});

		$(document).mouseup(function(e){
		    var container = $("#main-menu");

		    if (!container.is(e.target) && container.has(e.target).length === 0){
		        $("form.buscar").css({display:'none'});
		    }
		});
	});
</script>
<?php $__env->stopPush(); ?>
