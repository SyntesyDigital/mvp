<?php $__env->startSection('content'); ?>
<div id="content-form"
languages="<?php echo e(base64_encode(Modules\Architect\Entities\Language::getAllCached())); ?>"
tags="<?php echo e(isset($tags) ? base64_encode($tags->toJson()) : null); ?>"
categories="<?php echo e(isset($categories) ? base64_encode(json_encode($categories)) : null); ?>"
fields="<?php echo e(isset($fields) ? base64_encode($fields->toJson()) : null); ?>"
page="<?php echo e(isset($page) ? base64_encode(json_encode($page, true)) : null); ?>"
pages="<?php echo e(isset($pages) ? base64_encode(json_encode($pages,true)) : null); ?>"
settings="<?php echo e(isset($settings) ? base64_encode($settings) : null); ?>"
<?php if(isset($typology)): ?> typology="<?php echo e(base64_encode($typology->toJson())); ?>" <?php endif; ?>
<?php if(isset($content)): ?> content="<?php echo e(base64_encode($content->toJson())); ?>" <?php endif; ?>
></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugins'); ?>
    <?php echo e(Html::script('/modules/architect/plugins/dropzone/dropzone.min.js')); ?>

    <?php echo e(HTML::style('/modules/architect/plugins/dropzone/dropzone.min.css')); ?>

    <?php echo e(Html::script('/modules/architect/plugins/datatables/datatables.min.js')); ?>

    <?php echo e(HTML::style('/modules/architect/plugins/datatables/datatables.min.css')); ?>

    <?php echo e(Html::script('/modules/architect/plugins/bootbox/bootbox.min.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/libs/datatabletools.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/architect.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
<script>
var routes = {
  'contents' : "<?php echo e(route('contents')); ?>",
  'medias.data' : "<?php echo e(route('medias.data')); ?>",
  'medias.index' : '<?php echo e(route('medias.index')); ?>',
  'medias.store' : '<?php echo e(route('medias.store')); ?>',
  'medias.show' : '<?php echo e(route('medias.show')); ?>',
  'medias.delete' : '<?php echo e(route('medias.delete')); ?>',
  'medias.update' : '<?php echo e(route('medias.update')); ?>',
  'contents.data' : '<?php echo e(route('contents.modal.data')); ?>',
  'showContent' : "<?php echo e(route('contents.show',['id' => ':id'])); ?>",
  'contents.page.create' : "<?php echo e(route('contents.page.create')); ?>",
  'contents.create' : "<?php echo e(route('contents.create',['typology' => ':id'])); ?>",
  'previewContent' : ASSETS+"preview/:id",
  'pagelayouts.data' : '<?php echo e(route('pagelayouts.modal.data')); ?>'
};
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>