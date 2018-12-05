<?php if(isset($menu)): ?>
<ul class="menu">
	<?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $menuElement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li class="menu-item">
		<?php
			$link = format_link($menuElement);
			$hasChildren = sizeof($menuElement["children"]) > 0 ? 1 : 0;
		?>
		<?php if(isset($link)): ?>
				<a href="<?php echo e($link["url"]); ?>" id="<?php echo e($link["id"]); ?>" class="<?php echo e($link["class"]); ?>" ><?php echo e($link["name"]); ?></a>

				<?php if(sizeof($menuElement["children"]) > 0 ): ?>
					<ul class="menu-children">
						<?php $__currentLoopData = $menuElement["children"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$childLink = format_link($child)
							?>
							<?php if(isset($childLink)): ?>
								<li class"menu-child">
									<a href="<?php echo e($childLink["url"]); ?>" id="<?php echo e($childLink["id"]); ?>" class="<?php echo e($childLink["class"]); ?>" <?php if(isset($childLink["target"])): ?> target="_blank" <?php endif; ?> ><?php echo e($childLink["name"]); ?></a>
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
