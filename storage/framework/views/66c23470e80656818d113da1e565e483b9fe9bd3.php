<?php if(isset($menu)): ?>
	<?php
		$menuReferences = [
			0 => 'menu travel trade',
			1 => 'menu media center',
			2 => 'menu corporate'
		];
	?>

	<ul class="nav navbar-nav menu-general">
		<?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $menuElement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<?php
			$link = format_link($menuElement);
			$hasChildren = sizeof($menuElement["children"]) > 0 ? 1 : 0;
		?>

		<li class="dropdown mega-dropdown <?php echo e(Request::is($link['request_url'].'*') ? 'active' : ''); ?>">

			<?php if(isset($link)): ?>
					<a href="<?php echo e($link["url"]); ?>" id="<?php echo e($link["id"]); ?>" class="<?php echo e($hasChildren ? 'dropdown-toggle' : ''); ?> <?php echo e($link["class"]); ?>" <?php if($hasChildren): ?>data-toggle="dropdown"<?php endif; ?>><?php echo e($link["name"]); ?></a>

					<?php if(sizeof($menuElement["children"]) > 0 ): ?>
						<ul class="dropdown-menu mega-dropdown-menu">
							<li  class="col-sm-8">
								<ul>
									<?php $__currentLoopData = $menuElement["children"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php
											$childLink = format_link($child)
										?>
										<?php if(isset($childLink)): ?>
											<li class="col-sm-4">
												<a href="<?php echo e($childLink["url"]); ?>" id="<?php echo e($childLink["id"]); ?>" class="<?php echo e($childLink["class"]); ?>" <?php echo e(isset($childLink["target"]) ? 'target=_blank' : ''); ?> ><?php echo e($childLink["name"]); ?></a>
											</li>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</li>
							<?php if(isset($menuReferences[$index])): ?>
								<li class="col-sm-4 image">
									<!-- React MenuBanner -->
									<div id="menu_banner" name="<?php echo e($menuReferences[$index]); ?>">
									</div>

								</li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>

			<?php endif; ?>
		</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
<?php endif; ?>
