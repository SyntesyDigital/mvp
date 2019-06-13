aaaaaaaaaaaaaaaaaa
<?php $__env->startSection('content'); ?>
    <div id="element-form"
      fields=<?php echo e(base64_encode(json_encode($fields,true))); ?>

      model=<?php echo e(base64_encode(json_encode($model,true))); ?>

      <?php if((isset($element)) && $element): ?>element=<?php echo e(base64_encode($element->toJson())); ?><?php endif; ?>
    ></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugins'); ?>
    <?php echo e(Html::script('/modules/architect/plugins/bootbox/bootbox.min.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/architect.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
<script>
var routes = {
  'typologies' : "<?php echo e(route('typologies')); ?>",
  'showTypology' : "<?php echo e(route('typologies.show',['id' => ':id'])); ?>"
};
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>