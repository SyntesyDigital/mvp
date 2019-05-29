
<?php if($node['type'] == "row"): ?>
    <div id="<?php echo e(isset($node['settings']['htmlId']) ? $node['settings']['htmlId'] : ''); ?>" class="row <?php echo e(isset($node['settings']['htmlClass']) ? $node['settings']['htmlClass'] : ''); ?>">
      <?php if($node['settings']['hasContainer']): ?>
        <div class="container">
          <div class="row">
      <?php endif; ?>
<?php endif; ?>


<?php if($node['type'] == "col"): ?>
    <div id="<?php echo e(isset($node['settings']['htmlId']) ? $node['settings']['htmlId'] : ''); ?>" class="<?php echo e($node['colClass']); ?> <?php echo e(isset($node['settings']['htmlClass']) ? $node['settings']['htmlClass'] : ''); ?>">
<?php endif; ?>



<?php if($node['type'] == "item"): ?>
  <?php if(isset($node['field'])): ?>

    <?php if(isset($node['field']['type']) && ( $node['field']['type'] == "widget" || $node['field']['type'] == "widget-list") ): ?>

      <?php if ($__env->exists('turisme::partials.widgets.'.strtolower($node['field']['label']),
        [
          "field" => $node['field'],
        ]
      )) echo $__env->make('turisme::partials.widgets.'.strtolower($node['field']['label']),
        [
          "field" => $node['field'],
        ]
      , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php else: ?>

      <?php if(isset($node['field']['type']) && isset($node['field']['value'])): ?>

        <?php if ($__env->exists('turisme::partials.fields.'.$node['field']['type'],
          [
            "field" => $node['field'],
            "settings" => $node['field']['settings'],
          ]
        )) echo $__env->make('turisme::partials.fields.'.$node['field']['type'],
          [
            "field" => $node['field'],
            "settings" => $node['field']['settings'],
          ]
        , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endif; ?>

    <?php endif; ?>

  <?php endif; ?>
<?php endif; ?>


<?php if(isset($node['children'])): ?>
    <?php $__currentLoopData = $node['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('turisme::partials.node', [
            'node' => $n
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php if($node['type'] == "box"): ?>
        </div>
    </div>
<?php endif; ?>


<?php if($node['type'] == "row" || $node['type'] == "col"): ?>
      <?php if(isset($node['settings']['hasContainer']) && $node['settings']['hasContainer']): ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
<?php endif; ?>
