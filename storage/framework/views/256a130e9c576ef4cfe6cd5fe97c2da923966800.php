<ul>

	<?php
		$supportedLocales = LaravelLocalization::getSupportedLocales();
		$routeAttributes = !isset($error500) && isset($routeAttributes) ? $routeAttributes : [];
		$routeName = isset($error500) ? 'home' : Request::route()->getName();

		//FIXME put this as cache
		$languages = Modules\Architect\Entities\Language::pluck('iso','id');

	?>

	<?php if(isset($content)): ?>

		<?php
				$contentUrls = $content->urls->toArray();
				$formatedContentUrls = [];
				foreach($contentUrls as $url){
					$formatedContentUrls[$languages[$url['language_id']]] = $url['url'];
				}

		?>

		<?php $__currentLoopData = $supportedLocales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li <?php if(App::getLocale() == $localeCode): ?> class="current" <?php endif; ?>>

				<a
						<?php if(!isset($formatedContentUrls[$localeCode])): ?> class="undefined" <?php endif; ?>
						rel="alternate"
						hreflang="<?php echo e($localeCode); ?>"
						href="<?php echo e(isset($formatedContentUrls[$localeCode]) ? $formatedContentUrls[$localeCode] : route('language-not-found')); ?>">
	          <?php echo e($properties['native']); ?>

	      </a>

			</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<?php else: ?>

		<?php $__currentLoopData = $supportedLocales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li <?php if(App::getLocale() == $localeCode): ?> class="current" <?php endif; ?>>
				<a
						rel="alternate"
						hreflang="<?php echo e($localeCode); ?>"
						href="<?php echo e(LaravelLocalization::getURLFromRouteNameTranslated($localeCode,"routes.".$routeName,$routeAttributes)); ?>">
	          <?php echo e($properties['native']); ?>

	      </a>

			</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<?php endif; ?>

</ul>
