<?php $__env->startSection('content'); ?>
    <div id="typology-form"
    <?php if((isset($typology)) && $typology): ?>typology=<?php echo e(base64_encode($typology->toJson())); ?><?php endif; ?>
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