
<div class="custom-modal model-modal" id="new-model-modal">
  <div class="modal-background"></div>


    <div class="modal-container">

      <div class="modal-header">
        <h2><?php echo e(Lang::get('extranet::models.select')); ?></h2>

        <div class="modal-buttons">
          <a class="btn btn-default close-button-modal close-btn" >
            <i class="fa fa-times"></i>
          </a>
        </div>
      </div>

      <div class="modal-content">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 table">
              <div class="table-header">
                <div class="cell first-column"><?php echo e(Lang::get('extranet::models.name')); ?></div>
              </div>
              <?php
                $models = config('models');
              ?>
              <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="table-row">
                  <div class="cell first-column"><?php echo e($key); ?></div>
                  <div class="cell second-column"><a href="<?php echo e(route('extranet.models.create',$key)); ?>"><i class="fa fa-plus"></i><?php echo e(Lang::get('extranet::models.add_simple')); ?></a></div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
          </div>
        </div>

        <div class="modal-footer">
          <a href="" class="btn btn-default close-btn" > <?php echo e(Lang::get('architect::fields.cancel')); ?> </a>
        </div>

      </div>
  </div>
</div>
