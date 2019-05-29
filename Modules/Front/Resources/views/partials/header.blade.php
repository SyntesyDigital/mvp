<!-- HEADER -->
<header>
<!-- CORPO i IDIOMES -->
	<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="corporatiu"><a href="{{route('home')}}">
						<img src="{{asset('modules/architect/images/client-logo.jpg')}}" height="40" alt=""/></a>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-4 pull-right">
					<div class="idiomes">
						@include("front::partials.languages")
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
				<form class="col-md-12 buscar" method="GET" action="{{route('front.search')}}">
					<input type="text" name="q" placeholder="Entrez le mot que vous recherchez...">
				</form>
				<!-- end buscador -->

				@include('front::partials.menu_header',[
					"menu" => get_menu('header')
				])

		<ul class="nav navbar-nav navbar-right col-md-3 col-sm-12 col-xs-12">

			<li class="boto-search">Buscar </li>
		</ul>
	</div><!-- /.nav-collapse -->
	</nav>
</div>
</header><!-- end HEADER -->

@push('javascripts')
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
@endpush
