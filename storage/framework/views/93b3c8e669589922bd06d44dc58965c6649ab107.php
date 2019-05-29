<?php if(isset($field['value'])): ?>
  <div id="carousel-full" class="carousel slide <?php echo e(isset($field['settings']['htmlClass']) ? $field['settings']['htmlClass'] : ''); ?>" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php $__currentLoopData = $field['value']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li data-target="#carousel-full" data-slide-to="<?php echo e($index); ?>" class="<?php echo e($index == 0 ? 'active' : ''); ?>"></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </ol>

      <div class="carousel-inner" role="listbox">

        <?php $__currentLoopData = $field['value']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $__env->make('turisme::partials.widgets.'.strtolower($field['widget']),
            [
              "field" => $widget,
              "settings" => $field['settings'],
              "class" => $index == 0 ? 'active' : ''
            ]
          , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
      <?php if(count($field['value']) > 1): ?>
        <a class="left carousel-control" href="#carousel-full" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel-full" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
      <?php endif; ?>
  </div>
<?php endif; ?>
