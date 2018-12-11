<?php $__env->startSection('content'); ?>
<div class="container grid-page">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">

      <div class="page-title">
        <h1><?php echo e(Lang::get('architect::settings.title')); ?></h1>
        <h3><?php echo e(Lang::get('architect::settings.subtitle')); ?></h3>
      </div>

      <div class="grid-items">
        <div class="row">
            <?php $__currentLoopData = config('settings'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xs-3">
                    <a href="<?php echo e(route($setting["route"])); ?>">
                      <div class="grid-item">
                          <i class="fa <?php echo e($setting["icon"]); ?>"></i>
                          <p class="grid-item-name">
                              <?php echo e($setting["label"]); ?>

                          </p>
                      </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>

    </div>
  </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>