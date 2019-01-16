<!-- FOOTER -->
<footer>
	<!-- Col 2 -->
	<div class="horizontal-inner-container">
			<div class="footer-logo" style="background-image:url('<?php echo e(asset('modules/bwo/images/footer-logo.jpg')); ?>')">
			</div>

			<div class="footer-info">
				<div class="first-line-footer">
					<?php echo $__env->make('bwo::partials.menu',
						["menu" => get_menu('footer')]
					, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div class="second-line-footer">
					<div class="footer-social">
						<a href="https://www.facebook.com/" ><i class="fa fa-facebook"></i></a>
						<a href="https://www.linkedin.com"><i class="fa fa-linkedin"></i></a>
						<a href="http://www.viadeo.com/"><i class="fa fa-viadeo"></i></a>
					</div>
					<div class="footer-copyright">
						<a href="#">COPYRIGHT &#169; 2018 BWO</a>
						<?php echo $__env->make('bwo::partials.menu_simple',
							["menu" => get_menu('footer_2')]
						, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				</div>
			</div>
			<br clear="all">
	</div>
	<!-- end Col 2 -->
</footer><!-- END FOOTER -->
