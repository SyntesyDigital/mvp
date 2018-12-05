<!-- FOOTER -->
<footer>
	<!-- Col 2 -->
	<div class="dark-grey">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="list-items programes">
            <h3>{{translate('FOOTER_TITLE_1')}}</h3>

						@include('turisme::partials.menu',[
							"menu" => get_menu('footer programes')
						])
			</div>
		  </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="list-items links">
            <h3>{{translate('FOOTER_TITLE_2')}}</h3>

						@include('turisme::partials.menu',[
							"menu" => get_menu('footer links')
						])
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<!-- end Col 2 -->
</footer><!-- END FOOTER -->
