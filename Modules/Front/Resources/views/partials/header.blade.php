<!-- HEADER -->
<header>
	<!-- CORPO i IDIOMES -->
				<div class="row row-header">
					<div class="col-md-3 col-sm-4 col-xs-6 logo-container">
						<a href="{{route('home')}}">
							<img src="{{asset('modules/architect/images/logo.png')}}" alt=""/>
						</a>
					</div>
					<div class="col-md-9 col-sm-8 col-xs-6 right-part-header">
						<div class="menu-container">
							<div class="menu">
								<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
									<span class="sr-only">Menu</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="user-info">
								<div class="button-logout-container"><a href="btn btn-logout"><i class="fa fa-sign-out"></i> Déconnecter</a></div>
								<p class="user-name">Bonjour, John Doe</p>
							</div>
						</div>
						<div class="user-container">
							</div>
					</div>



					<!--div class="col-md-3 col-sm-4 col-xs-4 pull-right">
						<div class="idiomes">
							@include("front::partials.languages")
						</div>
					</div-->
				</div>
	<!-- END CORPO I IDIOMES -->
	<!-- MENU I SEARCH -->

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
