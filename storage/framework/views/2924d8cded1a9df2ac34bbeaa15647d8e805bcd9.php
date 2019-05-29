<?php $__env->startSection('content'); ?>


<div class="container leftbar-page">

  <?php echo $__env->make('architect::partials.content-nav',['typologies' => $typologies], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <div class="col-xs-offset-2 col-xs-10 page-content">

    <h3 class="card-title"><?php echo e(Lang::get('architect::fields.tags')); ?></h3>
    <a href="<?php echo e(route('tags.create')); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; <?php echo e(Lang::get('architect::tag.add')); ?></a>

    <table class="table" id="table-tags" data-url="<?php echo e(route('tags.data')); ?>">
        <thead>
           <tr>
               <th><?php echo e(Lang::get('architect::fields.name')); ?></th>
               <th></th>
           </tr>
        </thead>
        <tfoot>
           <tr>
               <th></th>
               <th></th>
           </tr>
        </tfoot>
    </table>

  </div>

</div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('plugins'); ?>
    <?php echo e(Html::script('/modules/architect/plugins/datatables/datatables.min.js')); ?>

    <?php echo e(HTML::style('/modules/architect/plugins/datatables/datatables.min.css')); ?>

    <?php echo e(Html::script('/modules/architect/plugins/bootbox/bootbox.min.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/libs/datatabletools.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/architect.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
<script>
    architect.tags.init({
        'table' : $('#table-tags'),
        'urls': {
            'index' : '<?php echo e(route('contents.data')); ?>',
            'show' : '<?php echo e(route('contents.show')); ?>',
            'delete' : '<?php echo e(route('contents.delete')); ?>',
        }
    })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>