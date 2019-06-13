
<div class="custom-modal no-buttons" id="new-content-modal">
  <div class="modal-background"></div>


    <div class="modal-container">

      <div class="modal-header">
        <h2></h2>

        <div class="modal-buttons">
          <a class="btn btn-default close-button-modal close-btn" >
            <i class="fa fa-times"></i>
          </a>
        </div>
      </div>

      <div class="modal-content">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

              <h3 class="card-title"><?php echo e(Lang::get('architect::contents.new')); ?></h3>
              <h6><?php echo e(Lang::get('architect::contents.select_list')); ?></h6>


              <div class="grid-items">
                <div class="row">

                    <?php if(has_roles([ROLE_ADMIN])): ?>
                  <div class="col-xs-3">
                    <a href="<?php echo e(route('contents.page.create')); ?>">
                      <div class="grid-item">
                        <i class="fa fa-file-o"></i>
                        <p class="grid-item-name">
                          <?php echo e(Lang::get('architect::fields.page')); ?>

                        </p>
                      </div>
                    </a>
                  </div>
                    <?php endif; ?>

                    <?php $__currentLoopData = Modules\Architect\Entities\Typology::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typology): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xs-3">
                          <a href="<?php echo e(route('contents.create', $typology)); ?>">
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

        <div class="modal-footer">
          <a href="" class="btn btn-default close-btn" > <?php echo e(Lang::get('architect::fields.cancel')); ?> </a>
        </div>

      </div>
  </div>
</div>
