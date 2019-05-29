<?php $__env->startSection('content'); ?>
  <div class="container grid-page">
    <div class="row">
      <div class="col-md-offset-2 col-md-8">

        <div class="page-title">
          <h1><?php echo e(Lang::get('architect::tipology.tipologies')); ?></h1> <a href="<?php echo e(route('typologies.create')); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; <?php echo e(Lang::get('architect::tipology.add')); ?></a>
        </div>

        <div class="grid-items">
          <div class="row">
              <?php $__currentLoopData = $typologies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typology): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xs-3">
                    <a href="<?php echo e(route('typologies.show', $typology)); ?>">
                      <div class="grid-item">
                          <i class="fa <?php echo e($typology->icon); ?>"></i>
                          <p class="grid-item-name">
                              <?php echo e($typology->name); ?>

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