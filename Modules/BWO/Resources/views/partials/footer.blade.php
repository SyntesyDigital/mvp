<!-- FOOTER -->
<footer>
	<!-- Col 2 -->
	<div class="horizontal-inner-container">
			<div class="footer-logo" style="background-image:url('{{asset('modules/bwo/images/footer-logo.jpg')}}')">
			</div>

			<div class="footer-info">
				<div class="first-line-footer">
					@include ('bwo::partials.menu',
						["menu" => get_menu('footer')]
					)
				</div>
				<div class="second-line-footer">
					<div class="footer-social">
						<a href="https://://www.facebook.com/BWO-Agence-demploi-772528346229866" ><i class="fa fa-facebook"></i></a>
						<a href="https://www.linkedin.com/company/bwo"><i class="fa fa-linkedin"></i></a>
						<a href="https://www.viadeo.com/fr/company/bwo/"><i class="fa fa-viadeo"></i></a>
					</div>
					<div class="footer-copyright">
						<a href="#">COPYRIGHT &#169; @php echo date("Y") @endphp BWO</a>
						@include ('bwo::partials.menu_simple',
							["menu" => get_menu('footer_2')]
						)
					</div>
				</div>
			</div>
			<br clear="all">
	</div>
	<!-- end Col 2 -->
</footer><!-- END FOOTER -->
