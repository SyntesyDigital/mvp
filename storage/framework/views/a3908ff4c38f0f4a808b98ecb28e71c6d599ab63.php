<?php if(isset($menu)): ?>
	<ul class="nav navbar-nav mr-auto">
		<?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $menuElement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<?php
			$link = format_link($menuElement);
			$hasChildren = sizeof($menuElement["children"]) > 0 ? 1 : 0;
		?>

		<li class="nav-item <?php echo e(Request::is($link['request_url'].'*') ? 'active' : ''); ?> <?php echo e(sizeof($menuElement["children"]) > 0 ? 'dropdown' : ''); ?>">

			<?php if(isset($link)): ?>
					<a href="<?php echo e($link["url"]); ?>" id="<?php echo e($link["id"]); ?>" class="nav-link  <?php echo e($hasChildren ? 'dropdown-toggle' : ''); ?> <?php echo e($link["class"]); ?>" <?php if($hasChildren): ?>data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"<?php endif; ?>><?php echo e($link["name"]); ?></a>

					<?php if(sizeof($menuElement["children"]) > 0 ): ?>
          <ul class="dropdown-menu">
            <?php $__currentLoopData = $menuElement["children"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$childLink = format_link($child)
							?>
							<?php if(isset($childLink)): ?>
								<li>
									<a href="<?php echo e($childLink["url"]); ?>" id="<?php echo e($childLink["id"]); ?>" class="<?php echo e($childLink["class"]); ?>" <?php echo e(isset($childLink["target"]) ? 'target=_blank' : ''); ?> ><?php echo e($childLink["name"]); ?></a>
								</li>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</ul>
					<?php endif; ?>

			<?php endif; ?>
		</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
<?php endif; ?>
