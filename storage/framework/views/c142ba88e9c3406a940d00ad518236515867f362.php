<?php

$element_types = \Modules\Extranet\Entities\Element::TYPES;
?>

<?php $__env->startSection('content'); ?>
  <div class="container grid-page">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">

      <div class="page-title">
        <h1>Éléments</h1>
      </div>

      <div class="grid-items">
        <div class="row">
          <?php $__currentLoopData = $element_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xs-3">
                <a href="<?php echo e(route('extranet.elements.type_index', $element_type["identifier"])); ?>">
                  <div class="grid-item">
                      <i class="fa <?php echo e($element_type["icon"]); ?>"></i>
                      <p class="grid-item-name">
                          <?php echo e($element_type["name"]); ?>

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


<?php $__env->startPush('javascripts'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>