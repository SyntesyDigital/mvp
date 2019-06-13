<?php

$element_type_array = \Modules\Extranet\Entities\Element::TYPES[$element_type];
?>

<?php $__env->startSection('content'); ?>
  <div class="container grid-page">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">

      <div class="page-title">
        <h1>
          <i class="<?php echo e($element_type_array['icon']); ?>"></i> <?php echo e($element_type_array['name']); ?>

          <a href="#" class="btn btn-primary add-element"><i class="fa fa-plus-circle"></i> &nbsp; Ajouter <?php echo e($element_type_array['name']); ?></a>
        </h1>
      </div>

      <div class="grid-items">
        <div class="row">
          <div class="col-xs-3 dashed">
              <a href="#" class="add-element">
                <div class="grid-item">
                    <i class="fa fa-plus"></i>
                    <p class="grid-item-name">
                        Ajouter <?php echo e($element_type_array['name']); ?>

                    </p>
                </div>
              </a>
          </div>
          <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xs-3">
                <a href="<?php echo e(route('extranet.elements.typeIndex', $element["identifier"])); ?>">
                  <div class="grid-item">
                      <i class="fa <?php echo e($element["icon"]); ?>"></i>
                      <p class="grid-item-name">
                          <?php echo e($element["name"]); ?>

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

<?php echo $__env->make('extranet::elements.modal-models', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascripts'); ?>
  <script>
    $(function(){

      $(".add-element").click(function(e){
        e.preventDefault();
        TweenMax.to($("#modal-models"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
      });

      $(document).on('click',"#modal-models .close-btn",function(e){
        e.preventDefault();
        TweenMax.to($("#modal-models"),0.5,{opacity:0,display:"none",ease:Power2.easeInOut});
      });

    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>